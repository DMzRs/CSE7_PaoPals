<?php
//Para rani sa admin password need hashing

$plainTextPassword = 'dmferrer'; // Replace with your actual password

// DM = dmferrer
// Mendoza = mendoza1234
// Murillo = leanmurillo


// Generate a hashed password using Bcrypt (default algorithm)
$hashedPassword = password_hash($plainTextPassword, PASSWORD_DEFAULT);

// Display the hashed password
echo "Hashed Password: " . $hashedPassword . "\n";
