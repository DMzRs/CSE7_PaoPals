<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../AdminStyles/inventoryPage.css?v=<?php echo time(); ?>">
    <title>PaoPals</title>
</head>
<body>
    <?php include '../Templates/navBarAdmin.php'; ?>

    <section class="main-container">
        <div class="header-container">
            <h1>James Oliver Mendoza</h1>
        </div>
        <div class="first-container">
            <div class="tab-container">
                <a class="dashboard" href="mainDashboard.php">Dashboard</a>
                <a class="products" href="productPage.php">Products</a>
                <a class="inventory" href="inventoryPage.php">Inventory</a>
                <a class="feedbacks" href="feedbackPage.php">Feedbacks</a>
            </div>
            <div class="inventory-container">
                <h1 class="inventoryHeader">Inventory</h1>
                <button class="addStockBtn" name="addStockBtn">Add Stocks</button>
                    <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Date Arrived</th>
                                <th>Expiry Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pork Asado Siopao</td>
                                <td>Siopao</td>
                                <td>1</td>
                                <td>2/05/2025</td>
                                <td>2/08/2025</td>
                            </tr>
                            <tr>
                                <td>Pork Asado Siopao</td>
                                <td>Siopao</td>
                                <td>1</td>
                                <td>2/05/2025</td>
                                <td>2/08/2025</td>
                            </tr>
                        </tbody>
                </div>
            </div>
        </div>
    </section>
</body>
</html>