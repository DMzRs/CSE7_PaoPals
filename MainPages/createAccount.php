<?php
include_once '../includes/dbhc.inc.php';
include_once '../includes/createAccount.inc.php';
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
    <section class="logo">
        <img src="../Images/Logo/PaoPals_BigLogo.png" alt="logo">
    </section>
    <section class="main-container">
        <div>
            <h1 class="header">Create an Account</h1>
        </div>
        <div class="createAcc-form-container">
            <h2>Already have an account? <a href="login.php">Sign in</a></h2>
            <form class="forms" method="POST">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" value="<?= htmlspecialchars($firstName ?? '') ?>" required>
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" value="<?= htmlspecialchars($lastName ?? '') ?>" required>
                <label for="email">Email Address</label>
                <input type="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>
                <label for="contactNumber">Contact Number</label>
                <input type="text" inputmode="numeric" name="contactNumber"
                    value="<?= htmlspecialchars($contactNumber ?? '') ?>" required>
                <label for="address">Address</label>
                <input type="text" name="address" value="<?= htmlspecialchars($address ?? '') ?>" required>
                <label for="password">Password <small>&#40; min 8 characters &#41;</small></label>
                <input type="password" name="password" id="password" required>
                <button class="createbtn" name="createAccount">Create an Account</button>
            </form>
        </div>
    </section>
</body>