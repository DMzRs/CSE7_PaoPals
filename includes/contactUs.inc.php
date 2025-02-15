<?php
session_start();
include_once 'dbhc.inc.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $_POST = array_map('trim', $_POST);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $feedbackText = filter_input(INPUT_POST, 'feedback', FILTER_UNSAFE_RAW);

    $errors = [];
    $formData = [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'feedback' => $feedbackText
    ];

    // Validation
    if (empty($name)) $errors[] = "Name is required.";
    if (empty($email)) $errors[] = "Email is required.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if (empty($subject)) $errors[] = "Subject is required.";
    if (empty($feedbackText)) $errors[] = "Feedback is required.";

    if (empty($errors) && $pdo) {
        try {
            // Prepare SQL statement
            $stmt = $pdo->prepare("INSERT INTO Feedback (name, email, subject, feedbackText) 
                                  VALUES (:name, :email, :subject, :feedback)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':subject' => $subject,
                ':feedback' => $feedbackText
            ]);

            // Success message
            $_SESSION['success'] = "Your feedback has been submitted successfully!";
        } catch (PDOException $e) {
            // Log the error
            error_log("Database Error: " . $e->getMessage());
            $errors[] = "Failed to submit feedback. Please try again later.";
        }
    }

    // Store session data
    $_SESSION['errors'] = $errors;
    $_SESSION['formData'] = $formData;

    // Redirect back to the form
    header("Location: ../MainPages/contactUsPage.php");
    exit();
}