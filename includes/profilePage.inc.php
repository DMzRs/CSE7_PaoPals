<?php
session_start();
include_once '../includes/dbhc.inc.php';
include_once '../includes/session.php'; // Include the session logic

// Redirect unauthorized users
if (!isAuthenticated()) {
    header('Location: ../MainPages/login.php');
    exit;
}

// Get customer ID from session
$customerId = getCustomerId();
$customer = null;
$errors = [];
$success = false;

try {
    $stmt = $pdo->prepare("SELECT * FROM Customer WHERE customerId = :customerId");
    $stmt->execute(['customerId' => $customerId]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    // If customer data is not found, redirect to login
    if (!$customer) {
        header('Location: ../MainPages/login.php');
        exit;
    }
} catch (PDOException $e) {
    die('Error fetching customer data: ' . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    // Collect form data
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contactNumber = preg_replace('/\D+/', '', $_POST['contactNumber'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $currentPassword = trim($_POST['currentPassword'] ?? '');
    $newPassword = trim($_POST['newPassword'] ?? '');

    // Validate required fields
    if (empty($firstName)) $errors[] = 'First Name is required.';
    if (empty($lastName)) $errors[] = 'Last Name is required.';
    if (empty($email)) $errors[] = 'Email is required.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email format.';
    if (empty($contactNumber)) $errors[] = 'Contact Number is required.';
    if (empty($address)) $errors[] = 'Address is required.';

    // Validate password changes if new password is provided
    if (!empty($newPassword)) {
        if (empty($currentPassword)) {
            $errors[] = 'Current Password is required to change your password.';
        } else {
            try {
                $stmtVerify = $pdo->prepare("SELECT customerPassword FROM Customer WHERE customerId = :customerId");
                $stmtVerify->execute(['customerId' => $customerId]);
                $hashedCurrentPassword = $stmtVerify->fetchColumn();

                if (!password_verify($currentPassword, $hashedCurrentPassword)) {
                    $errors[] = 'Current Password is incorrect.';
                }
            } catch (PDOException $e) {
                $errors[] = 'Database error verifying current password.';
            }
        }

        if (strlen($newPassword) < 8) {
            $errors[] = 'New Password must be at least 8 characters long.';
        }
    }

    // Check email uniqueness if changed
    if ($email !== $customer['customerEmail']) {
        try {
            $stmtCheckEmail = $pdo->prepare("SELECT 1 FROM Customer WHERE customerEmail = :email AND customerId != :customerId");
            $stmtCheckEmail->execute(['email' => $email, 'customerId' => $customerId]);
            if ($stmtCheckEmail->fetchColumn()) {
                $errors[] = 'Email is already registered.';
            }
        } catch (PDOException $e) {
            $errors[] = 'Database error checking email.';
        }
    }

    // Update customer information if no errors
    if (empty($errors)) {
        try {
            $sql = "UPDATE Customer 
                    SET customerFirstName = :firstName, 
                        customerLastName = :lastName,
                        customerEmail = :email,
                        customerContactNumber = :contactNumber,
                        customerAddress = :address";

            $params = [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'contactNumber' => $contactNumber,
                'address' => $address,
                'customerId' => $customerId
            ];

            if (!empty($newPassword)) {
                $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                $sql .= ", customerPassword = :password";
                $params['password'] = $hashedNewPassword;
            }

            $sql .= " WHERE customerId = :customerId";

            $stmtUpdate = $pdo->prepare($sql);
            $stmtUpdate->execute($params);

            // Refresh customer data
            $stmtRefresh = $pdo->prepare("SELECT * FROM Customer WHERE customerId = :customerId");
            $stmtRefresh->execute(['customerId' => $customerId]);
            $customer = $stmtRefresh->fetch(PDO::FETCH_ASSOC);

            $success = true;
        } catch (PDOException $e) {
            $errors[] = 'Error updating profile: ' . $e->getMessage();
        }
    }
}
?>
