<?php
session_start(); // Ensure the session starts

// Check if a user is logged in
function isAuthenticated() {
    return isset($_SESSION['customerLoggedIn']) && isset($_SESSION['customerId']);
}

// Get the logged-in customer ID
function getCustomerId() {
    return isAuthenticated() ? $_SESSION['customerId'] : null;
}
?>
