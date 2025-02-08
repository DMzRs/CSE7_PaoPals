<?php
session_start();

// Check if the user is logged in and is a customer
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'customer') {
    header('Location: ../MainPages/login.php');
    exit;
}

// Database connection
include_once '../includes/dbhc.inc.php';

// Customer ID from session
$customerId = $_SESSION['userId'];
$customer = null;

try {
    $stmt = $pdo->prepare("SELECT * FROM Customer WHERE customerId = :customerId");
    $stmt->execute(['customerId' => $customerId]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Error fetching customer info: ' . $e->getMessage());
}

// Initialize variables to store form input values and errors
$firstName = $customer['customerFirstName'];
$lastName = $customer['customerLastName'];
$email = $customer['customerEmail'];
$contactNumber = $customer['customerContactNumber'];
$success = false;
$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    // Retrieve form data
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contactNumber = preg_replace('/\D+/', '', $_POST['contactNumber'] ?? '');
    $currentPassword = trim($_POST['currentPassword'] ?? '');
    $newPassword = trim($_POST['newPassword'] ?? '');
    $confirmPassword = trim($_POST['confirmPassword'] ?? '');

    // Validate required fields (non-password)
    if (empty($firstName)) $errors[] = 'First Name is required.';
    if (empty($lastName)) $errors[] = 'Last Name is required.';
    if (empty($email)) $errors[] = 'Email is required.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email format.';
    if (empty($contactNumber)) $errors[] = 'Contact Number is required.';

    // Validate password changes if new password is provided
    if (!empty($newPassword)) {
        // Check current password
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

        // Validate new password and confirm password
        if (empty($confirmPassword)) {
            $errors[] = 'Confirm Password is required.';
        } elseif ($newPassword !== $confirmPassword) {
            $errors[] = 'New password and confirm password do not match.';
        }
        if (strlen($newPassword) < 8) {
            $errors[] = 'New Password must be at least 8 characters long.';
        }
    }

    // Check email uniqueness (if changed)
    if ($email !== $customer['customerEmail']) {
        try {
            $stmtCheckEmail = $pdo->prepare("SELECT 1 FROM Customer WHERE customerEmail = :email");
            $stmtCheckEmail->execute(['email' => $email]);
            if ($stmtCheckEmail->fetchColumn()) {
                $errors[] = 'Email address is already registered.';
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
                customerContactNumber = :contactNumber";

            $params = [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'contactNumber' => $contactNumber,
                'customerId' => $customerId
            ];

            if (!empty($newPassword)) {
                $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                $sql .= ", customerPassword = :password";
                $params['password'] = $hashedNewPassword;
            }

            $sql .= " WHERE customerId = :customerId";
            $params['customerId'] = $customerId;

            $stmtUpdate = $pdo->prepare($sql);
            $stmtUpdate->execute($params);

            // Refresh customer data
            $stmtRefresh = $pdo->prepare("SELECT * FROM Customer WHERE customerId = :customerId");
            $stmtRefresh->execute(['customerId' => $customerId]);
            $customer = $stmtRefresh->fetch(PDO::FETCH_ASSOC);

            $success = true;
        } catch (PDOException $e) {
            $errors[] = 'Database error updating customer information.';
        }
    }
}
