<?php 
session_start();
include_once '../includes/dbhc.inc.php';

// Check admin access
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    header('Location: ../MainPages/login.php');
    exit;
}

// Include dashboard backend logic
include_once '../includes/mainDashboard.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../AdminStyles/mainDashboard.css?v=<?= time(); ?>">
    <title>PaoPals</title>
</head>
<body>
    <?php include '../Templates/navBarAdmin.php'; ?>

    <section class="main-container">
        <div class="header-container">
            <h1>Welcome, <?= htmlspecialchars($_SESSION['userName'] ?? 'Admin') ?></h1>
        </div>
        <div class="first-container">
            <div class="tab-container">
                <a class="dashboard active" href="mainDashboard.php">Dashboard</a>
                <a class="products" href="productPage.php">Products</a>
                <a class="inventory" href="inventoryPage.php">Inventory</a>
                <a class="feedbacks" href="feedbackPage.php">Feedbacks</a>
            </div>
            <div class="dashBoard-container">
                <h1 class="dashboardHeader">Dashboard</h1>
                <div class="main-content">
                    <div class="totalIncome">
                        <h2>Siopao</h2>
                        <h1>₱<?= number_format($totalIncome, 2) ?></h1>
                    </div>
                    <div class="orderCount">
                        <h2>Order Count</h2>
                        <h1><?= number_format($orderCount) ?></h1>
                    </div>
                    <div class="customerCount">
                        <h2>Total Customers</h2>
                        <h1><?= number_format($customerCount) ?></h1>
                    </div>
                </div>
                <div class="mostPopular-container">
                    <h1>Most Popular Items</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Menu Items</th>
                                <th>Orders</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bestSellingProducts as $index => $product): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($product['productName']) ?></td>
                                    <td><?= number_format($product['totalSold']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>