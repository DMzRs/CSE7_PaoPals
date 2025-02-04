<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Styles/createAccount.css?v=<?php echo time(); ?>">
    <title>Create Account</title>
</head>
<body>
    <?php include('../Templates/navBar.php'); ?>
    <section class="main-container">
        <div>
            <h1 class="header">Create an Account</h1>
        </div>
        <div class="createAcc-form-container">
            <h2>Already have an account? <a href="login.php">Sign in</a></h2>
            <form class="forms" action="">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName" required>
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName" required>
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" required>
                <label for="contactNumber">Contact Number</label>
                <input type="text" inputmode="numeric" name="contactNumber" id="contactNumber" required>
                <label for="address">Address</label>
                <input type="text" name="address" id="address" required>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <button class="createbtn" name="createAccount">Create an Account</button>
            </form>
        </div>
    </section>
</body>
</html>