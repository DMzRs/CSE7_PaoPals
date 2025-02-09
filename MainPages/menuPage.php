<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Styles/menuPage.css?v=<?php echo time(); ?>">
    <title>PaoPals</title>
</head>
<body>
    <?php include '../Templates/navBar.php'; ?>

    <section class="main-container">
            <div class="menu-options">
                <h1>Menu</h1>
                <ul>
                    <li><h2><a href="">All</a></h2></li>
                    <li><h2><a href="">Siopao</a></h2></li>
                    <li><h2><a href="">Drinks</a></h2></li>
                    <li><h2><a href="">Dessert</a></h2></li>
                </ul>
            </div>
            <div class="menu-products">
                <h2 class="product-category">Siopao</h2>
                <div class="products">
                    <div class="product-container">
                        <img src="../Images/Siopao/sample_1.png" alt="1">
                        <h2>Siopao Name</h2>
                        <button class="orderBtn">ORDER</button>
                    </div>
                    <div class="product-container">
                        <img src="../Images/Siopao/sample_1.png" alt="1">
                        <h2>Siopao Name</h2>
                        <button class="orderBtn">ORDER</button>
                    </div>
                    <div class="product-container">
                        <img src="../Images/Siopao/sample_1.png" alt="1">
                        <h2>Siopao Name</h2>
                        <button class="orderBtn">ORDER</button>
                    </div>
                    <div class="product-container">
                        <img src="../Images/Siopao/sample_1.png" alt="1">
                        <h2>Siopao Name</h2>
                        <button class="orderBtn">ORDER</button>
                    </div>
                    <div class="product-container">
                        <img src="../Images/Siopao/sample_1.png" alt="1">
                        <h2>Siopao Name</h2>
                        <button class="orderBtn">ORDER</button>
                    </div>
                </div>
                
            </div>
    </section>
</body>
</html>