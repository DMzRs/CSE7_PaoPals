<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../AdminStyles/salesPage.css?v=<?= time(); ?>">
    <title>PaoPals</title>
</head>

<body>
    <?php include '../Templates/navBarAdmin.php'; ?>
    <section class="main-container">
        <div class="header-containerS">
            <h1>Welcome, <?= htmlspecialchars($_SESSION['userName'] ?? 'Admin') ?></h1>
        </div>
        <div class="first-container">
            <div class="tab-container">
                <a class="dashboard" href="mainDashboard.php">Dashboard</a>
                <a class="products" href="productPage.php">Products</a>
                <a class="inventory" href="inventoryPage.php">Inventory</a>
                <a class="sales" href="salesPage.php">Sales</a>
                <a class="feedbacks" href="feedbackPage.php">Feedbacks</a>
            </div>
            <div class="sales-container">
                <h1 class="salesHeader">Sales</h1>
                <div class="table-containerS">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total Units Sold</th>
                                <th>Total Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>September 21, 2025</td>
                                    <td>136</td>
                                    <td>P2715912587</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>