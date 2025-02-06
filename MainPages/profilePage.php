<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Styles/profilePage.css?v=<?php echo time(); ?>">
    <title>PaoPals</title>
</head>
<body>
    <?php include '../Templates/navBar.php'; ?>
    <section class="main-container">
        <div class="header-container">
            <h1>YOUR ACCOUNT</h1>
            <h2>Edit your profile</h2>
        </div>
        <div class="first-container">
            <div class="tab-container">
                <a class="profileEdit" href="profilePage.php">Account Info</a>
                <a class="orderHistory" href="profileOrderHistory.php">Order History</a>
            </div>
            <div class="prof-info-container">
                <h3>Your information</h3>
                <form action="">
                    <div>
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" value="Lean" required>
                    </div>
                    <div>
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" value="Murillo" required>
                    </div>
                    <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="murillolean12@gmail.com" required>
                    </div>
                    <div>
                    <label for="contactNumber">Contact Number</label>
                    <input type="text" inputmode="numeric" id="contactNumber" name="contactNumber" value="09671234340" required>
                    </div>
                    <div>
                    <label for="currentPassword">Current Password</label>
                    <input type="password" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div>
                    <label for="newPassword">New Password</label>
                    <input type="password" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="saveBtn">
                    <button name="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>