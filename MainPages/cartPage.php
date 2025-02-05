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
    <link rel="stylesheet" href="../Styles/cartPage.css?v=<?php echo time(); ?>">
    <title>PaoPals</title>
</head>
<body>
    <?php include '../Templates/navBar.php'; ?>

    <section class="mainContainer">
        <!-- Pang if else ni kung naay sulod ang Order Cart -->
        <div class="header">
            <h1>Your Order Cart <img src="../Images/Icon/orderCart_icon.png" alt="order-icon"></h1>
        </div>
        <div class="table-header">
            <div class="name">
                <h2>Name</h2>
            </div>
            <div class="price">
                <h2>Price</h2>
            </div>
            <div class="quantity">
                <h2>Quantity</h2>
            </div>
            <div class="totalPrice">
                <h2>Total Price</h2>
            </div>
        </div>
        <div class="order-container">
            <div class="orderName">
                <h2>Sample Product Name</h2>
            </div>
            <div class="orderImg">
                <img src="../Images/Siopao/sample_1.png" alt="sampleOrder">
            </div>
            <div class="orderPrice">
                <h2>₱90.00</h2>
            </div>
            <div class="orderQuantity">
                    <button class="reduceQuantity"><img src="../Images/Icon/deduct_icon.png" alt="deduct"></button>
                    <h2>1</h2>
                    <button class="increaseQuantity"><img src="../Images/Icon/add_icon.png" alt="add"></button>
            </div>
            <div class="orderTotalPrice">
                <h2>₱90.00</h2>
            </div>
            <div class="orderDelete">
                <img src="../Images/Icon/deleteOrder_icon.png" alt="deleteOrder">
            </div>
        </div>
        <div class="total-cost-container">
            <div class="totalCostTitle">
                <h2>Total Cost:</h2>
            </div>
            <div class="totalCost">
                <h2>₱90.00</h2>
            </div>
        </div>
        <div class="buttons">
            <button class="continueOrder"><h2>Continue Order</h2></button>
            <button class="checkOut"><h2>Checkout</h2></button>
        </div>

        <!-- Kani kung EMPTY -->
        <!-- <div class="titleEmpty">
            <h1>Your Cart is Empty</h1>
            <h3>Your cart is currently empty! Start adding your favorite siopao and treats from our menu to enjoy a delicious meal today!</h3>
        </div>
        <div class="orderButton-container">
            <button name="orderNowEmptyCart" onclick="location.href='menuPage.php'">Order Now</button>
        </div> -->
    </section>
</body>
</html>