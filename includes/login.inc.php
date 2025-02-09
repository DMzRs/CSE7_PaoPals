<?php
session_start();

// Database connection
include_once '../includes/dbhc.inc.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signIn'])) {
    $email = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validate inputs
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // Proceed if validation passes
    if (empty($errors)) {
        try {
            // Check Admin table first
            $stmtAdmin = $pdo->prepare("SELECT adminId, adminName, adminPassword FROM Admin WHERE adminEmail = :email");
            $stmtAdmin->execute([':email' => $email]);
            $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

            if ($admin && password_verify($password, $admin['adminPassword'])) {
                $_SESSION['userRole'] = 'admin';
                $_SESSION['userId'] = $admin['adminId'];
                $_SESSION['userName'] = $admin['adminName'];
                header('Location: ../AdminPages/mainDashboard.php');
                exit;
            }

            // If Admin verification fails, check Customer table
            $stmtCustomer = $pdo->prepare("SELECT customerId, customerFirstName, customerPassword FROM Customer WHERE customerEmail = :email");
            $stmtCustomer->execute([':email' => $email]);
            $customer = $stmtCustomer->fetch(PDO::FETCH_ASSOC);

            if ($customer && password_verify($password, $customer['customerPassword'])) {
                $_SESSION['userRole'] = 'customer';
                $_SESSION['userId'] = $customer['customerId'];
                $_SESSION['userName'] = $customer['customerFirstName'];
                header('Location: ../MainPages/menuPage.php');
                exit;
            }

            // Handle authentication failure
            $errors[] = "Invalid email or password. Please try again.";

        } catch (PDOException $e) {
            $errors[] = "Database error occurred. Please contact support.";
        }
    }
}
?>