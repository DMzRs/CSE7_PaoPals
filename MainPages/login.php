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
    <link rel="stylesheet" href="../Styles/login.css?v=<?php echo time(); ?>">
    <title>Login Page</title>
</head>
<body>
    <section class="logo">
        <img src="../Images/Logo/PaoPals_BigLogo.png" alt="logo">
    </section>
    <section class="main-container">
        <div class="intro-container">
            <h1>Sign In</h1>
            <h3>Welcome to Paopals! Sign in to order delicious siopao, manage your account, and enjoy seamless service!</h3>
        </div>
        <div class="login-form-container">
            <form action="">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required autocomplete="off">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <div class="btnContainer">
                    <div class="checkboxContainer">
                    <input type="checkbox" id="showPassword" name="showPassword">
                    <label for="showPassword">Show Password</label>
                    </div>
                    <div>
                    <button name="signIn" class="signIn">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="create-acc-container">
                <div>
                    <h1>Want to create an account?</h1>
                </div>
                <div>
                    <button class="createbtn" onclick="location.href='createAccount.php'">Create an Account</button>
                </div>
        </div>
    </section>
</body>
</html>