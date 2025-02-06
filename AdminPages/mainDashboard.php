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
                <h1>Dashboard</h1>
                <a class="menu" href="mainDashboard.php">Menu</a>
                <a class="inventory" href="inventoryPage.php">Inventory</a>
                <a class="feedbacks" href="feedbackPage.php">Feedbacks</a>
            </div>
            <div class="menu-container">
                <h1 class="menuHeader">Menu</h1>
                <h3 class="categoryHeader">Category</h3>
                <div class="categories">
                    <div class="siopao">
                        <img src="../Images/Siopao/sample_1.png" alt="siopao">
                        <h2>Siopao</h2>
                    </div>
                    <div class="drinks">
                        <img src="../Images/Drinks/drink1.png" alt="drink">
                        <h2>Drinks</h2>
                    </div>
                    <div class="desserts">
                        <img src="../Images/Desserts/dessert1.png" alt="dessert">
                        <h2>Desserts</h2>
                    </div>
                </div>
                <!-- or pwede pud i if else nimo ang category so per click ana ang format sugod 
                 product-container class -->
                <div class="product-container">
                    <h1>Siopao</h1>
                    <div class="items-container">
                        <div class="item-container">
                            <!-- kaning class na container mao ni ang pang back-end pag mag add ug element sa php
                             dapat same format automatic nana mag 4 items per row -->
                            <div class="container">
                            <img src="../Images/Siopao/sample_1.png" alt="siopao">
                            <h2>Siopao</h2>
                            <div>
                                <h2>₱90.00</h2>
                                <h2>Stocks: 99</h2>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>