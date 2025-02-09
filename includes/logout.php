<?php
session_start();

// Unset all session variables and destroy the session
session_unset();
session_destroy();

// Redirect to login page
header('Location: ../MainPages/login.php');
exit;
?>