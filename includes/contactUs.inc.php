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

    // Input validation
    if (empty($name)) $errors[] = "Name is required.";
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($subject)) $errors[] = "Subject is required.";
    if (empty($feedbackText)) $errors[] = "Feedback is required.";

    if (!empty($errors)) {
        // Store errors and formData for re-display
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $formData;
    } else {
        try {
            // Insert feedback into database
            $stmt = $pdo->prepare("INSERT INTO Feedback (name, email, subject, feedbackText) 
                                  VALUES (:name, :email, :subject, :feedback)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':subject' => $subject,
                ':feedback' => $feedbackText
            ]);
            // Store success message and clear formData
            $_SESSION['success'] = "Your feedback has been submitted successfully!";
            // Remove formData from session as it's no longer needed
            unset($_SESSION['formData']);
        } catch (PDOException $e) {
            // Log database error and provide user feedback
            error_log("Database Error: " . $e->getMessage());
            $errors[] = "Failed to submit feedback. Please try again.";
            $_SESSION['errors'] = $errors;
            $_SESSION['formData'] = $formData;
        }
    }

    // Redirect to prevent form resubmission
    header("Location: ../MainPages/contactUsPage.php");
    exit();
}