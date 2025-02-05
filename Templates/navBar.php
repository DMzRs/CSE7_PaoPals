<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Styles/navBar.css?v=<?php echo time(); ?>">
</head>
<body>
    <section class="navbar">
        <div class="main">
            <div class="logo">
                <img src="../Images/Logo/PaoPals_logo.png" alt="logo">
            </div>
            <div class="nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="menuPage.php">Menu</a></li>
                    <li><a href="contactUsPage.php">Contact Us</a></li>
                    <li><a href="">About Us</a></li>
                </ul>
            </div>
            <div class="action">
                <button class="shopNowBtn actions" onclick="location.href='createAccount.php'">SHOP NOW</button>
                <a href=""><img class="actions imgBtns" src="../Images/Icon/username_icon.png" alt="profile"></a>
                <a href="cartPage.php"><img class="actions imgBtns" src="../Images/Icon/cart_icon.png" alt="cart"></a>
            </div>
        </div>
        <div class="block">
            <p></p>
        </div>
        <div class="breadcrumb">
                <img src="../Images/Icon/home_icon.png" alt="home">
        </div>
    </section>
</body>
