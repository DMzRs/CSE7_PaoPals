<?php
// Check if a user is logged in
function isAuthenticated() {
    return isset($_SESSION['customerLoggedIn']);
}
?>