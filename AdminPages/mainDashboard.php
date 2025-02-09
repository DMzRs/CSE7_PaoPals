

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../AdminStyles/mainDashboard.css?v=<?php echo time(); ?>">
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
            <div class="dashBoard-container">
                <h1 class="dashboardHeader">Dashboard</h1>
                <div class="main-content">
                    <div class="totalIncome">
                        <h2>Siopao</h2>
                        <h1>₱99,999,99</h1>
                    </div>
                    <div class="orderCount">
                        <h2>Order Count</h2>
                        <h1>33,440</h1>
                    </div>
                    <div class="customerCount">
                        <h2>Total Customers</h2>
                        <h1>33,440</h1>
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
                        <!-- ang t body lang ang butangig logic sa pag display table same format -->
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Pork Asado Siopao</td>
                                <td>120</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Bola-bola Siopao</td>
                                <td>95</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Chicken Asado Siopao</td>
                                <td>87</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Beef Asado Siopao</td>
                                <td>76</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Leche Flan</td>
                                <td>66</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Siopao</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Siopao</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Siopao</td>
                                <td>6</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>