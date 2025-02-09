<?php
// Initialize error messages and form data
$firstName = $lastName = $email = $contactNumber = $address = $password = '';
$errors = [];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['createAccount'])) {
    // Retrieve and sanitize form data
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $contactNumber = preg_replace('/[^0-9]/', '', $_POST['contactNumber'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validate input fields
    if (empty($firstName)) {
        $errors[] = "First name is required.";
    }
    if (empty($lastName)) {
        $errors[] = "Last name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        // Check if email is already registered
        try {
            $stmt = $pdo->prepare("SELECT customerEmail FROM Customer WHERE customerEmail = :email");
            $stmt->execute([':email' => $email]);
            if ($stmt->fetchColumn()) {
                $errors[] = "Email address is already registered.";
            }
        } catch (PDOException $e) {
            $errors[] = "Database error occurred. Please try again later.";
        }
    }
    if (empty($contactNumber)) {
        $errors[] = "Contact number is required.";
    }
    if (empty($address)) {
        $errors[] = "Address is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // If no errors, proceed to database insertion
    if (empty($errors)) {
        try {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert the new customer record
            $stmt = $pdo->prepare("
                INSERT INTO Customer 
                (customerFirstName, customerLastName, customerEmail, 
                customerContactNumber, customerAddress, customerPassword)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$firstName, $lastName, $email, 
                            $contactNumber, $address, $hashedPassword]);

            // Redirect to the login page upon successful registration
            header('Location: ../MainPages/login.php?account_created=1');
            exit;
        } catch (PDOException $e) {
            $errors[] = "Error creating your account. Please try again later.";
        }
    }
}
?>