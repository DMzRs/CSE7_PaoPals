<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Styles/contactUsPage.css?v=<?php echo time(); ?>">
    <title>PaoPals</title>
</head>
<body>
    <?php include '../Templates/navBar.php'; ?>
    <section class="mainContainer">
        <div class="header">
            <h1>Tell us your feedback!</h1>
        </div>
        <div class="first-container">
            <div class="form-container">
            <form action="">
                <input class="inputs" type="text" id="name" name="name" placeholder="Your Name" required>
                <input class="inputs" type="email" id="email" name="email" placeholder="Your Email" required>
                <input class="inputs" type="text" id="subject" name="subject" placeholder="Subject" required>
                <textarea class="inputs" rows="20" cols="50" id="feedback" name="feedback" placeholder="Enter your feedback" required style="resize: none;"></textarea>
                <button class="submitBtn">Submit</button>
            </form>
            </div>
            <div class="img-container">
                <img src="../Images/Logo/chefContactUs_logo.png" alt="chef">
            </div>
        </div>
        <div class="contactUs-container">
            <div>
                <h1>Contact Us</h1>
            </div>
            <div class="contactDetails-container">
                <div class="hotline">
                <h2><img src="../Images/Icon/hotline_icon.png" alt="hotline"> Hotline</h2>

                    <h3>#8-44-44</h3>
                </div>
                <div class="email">
                <h2><img src="../Images/Icon/email_icon.png" alt="email"> Email</h2>

                    <h3>feedback@papls.com</h3>
                </div>
                <div class="address">
                <h2><img src="../Images/Icon/address_icon.png" alt="address"> Address</h2>
                    <h3>UM Matina, Davao City</h3>
                </div>
            </div>
        </div>
    </section>
</body>
</html>