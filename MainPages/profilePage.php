<?php
session_start();

// Debugging: Uncomment to check session values
// echo "<pre>"; print_r($_SESSION); echo "</pre>"; exit;

// Redirect unauthorized users
if (!isset($_SESSION['customerLoggedIn']) || $_SESSION['customerLoggedIn'] !== true) {
    header('Location: ../MainPages/login.php');
    exit;
}

// Database connection
include_once '../includes/dbhc.inc.php';

// Fetch current user data
$customerId = $_SESSION['customerId'];
$customer = null;

try {
    $stmt = $pdo->prepare("SELECT * FROM Customer WHERE customerId = :customerId");
    $stmt->execute(['customerId' => $customerId]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Error fetching customer data: ' . $e->getMessage());
}

$errors = [];
$success = false;
?>


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
                <?php if ($success): ?>
                    <div class="success-alert">
                        <p>Your profile has been updated successfully!</p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($errors)): ?>
                    <div class="error-alert">
                        <?php foreach ($errors as $error): ?>
                            <p><?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <h3>Your information</h3>
                <form method="POST">
                    <div>
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" value="<?= htmlspecialchars($customer['customerFirstName'] ?? ''); ?>" required>
                    </div>
                    <div>
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" value="<?= htmlspecialchars($customer['customerLastName'] ?? ''); ?>" required>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($customer['customerEmail'] ?? ''); ?>" required>
                    </div>
                    <div>
                        <label for="contactNumber">Contact Number</label>
                        <input type="text" inputmode="numeric" id="contactNumber" name="contactNumber" value="<?= htmlspecialchars($customer['customerContactNumber'] ?? ''); ?>" required>
                    </div>
                    <div class="full-width">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="<?= htmlspecialchars($customer['customerAddress'] ?? ''); ?>" required>
                    </div>
                    <div>
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" name="currentPassword" >
                    </div>
                    <div>
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" name="newPassword" >
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