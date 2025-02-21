<?php
//Para rani sa admin password need hashing

$plainTextPassword = 'jamesmendoza'; // Replace with your actual password

// Generate a hashed password using Bcrypt (default algorithm)
$hashedPassword = password_hash($plainTextPassword, PASSWORD_DEFAULT);

// Display the hashed password
echo "Hashed Password: " . $hashedPassword . "\n";
