<!DOCTYPE html>
<html lang="en">

<head>
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

        <div class="order-containers">
            <!-- Dont change the classname wording -->
        <div class="order-container">
            <!-- Actual Name of the Product Being ordered -->
            <div class="orderName">
                <h2>Sample Product Name</h2>
            </div>
            <!-- Image of the producs being ordered -->
            <div class="orderImg">
                <img src="../Images/products/sample_1.png" alt="product1">
            </div>
            <!-- base price of the item -->
            <div class="orderPrice">
                <h2>₱90.00</h2>
            </div>
            <!-- If the reduceQuantity is clicked it will reduce and vice versa to the increase quantity-->
            <div class="orderQuantity">
                <button name="decreaseQuantity" class="reduceQuantity"><img src="../Images/Icon/deduct_icon.png" alt="deduct"></button>
                <!-- The Quantity -->
                <h2>1</h2>
                <button name="increaseQuantity" class="increaseQuantity"><img src="../Images/Icon/add_icon.png" alt="add"></button>
            </div>
            <!-- Total price item example, 2 siopao (2 * 90) = 180 -->
            <div class="orderTotalPrice">
                <!-- Total Price -->
                <h2>₱90.00</h2>
            </div>
            <!-- If this clicked the order item is deleted -->
            <div class="orderDelete">
                <button name="deleteOrder" style="border: none; cursor: pointer;"><img src="../Images/Icon/deleteOrder_icon.png" alt="deleteOrder"></button>
            </div>
        </div>
        </div>
        
        
        <div class="total-cost-container">
            <div class="totalCostTitle">
                <h2>Total Cost:</h2>
            </div>
            <!-- total cost of all the items -->
            <div class="totalCost">
                <h2>₱90.00</h2>
            </div>
        </div>
        <!-- This virtual only -->
        <div class="buttons">
            <button class="continueOrder" onclick="location.href='menuPage.php'">
                <h2>Continue Order</h2>
            </button>
            <button class="checkOut" id="checkoutButton">
                <h2>Checkout</h2>
            </button>
        </div>

        <!-- The Modal -->
        <div id="checkOutModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Checkout</h2>
                <form id="checkoutForm">
                    <!-- Payment Method Dropdown -->
                    <div class="form-group">
                        <label for="paymentMethod">Payment Method:</label>
                        <select id="paymentMethod" name="paymentMethod">
                            <option value="" selected disabled>Select a method</option>
                            <option value="gcash">GCash</option>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                        </select>
                    </div>

                    <!-- Card Payment Section -->
                    <div id="cardSection" class="form-group" style="display:none;">
                        <label for="cardNumber">Card Number:</label>
                        <input type="text" id="cardNumber" name="cardNumber" placeholder="Enter card number">
                    </div>

                    <!-- Cash Payment Section -->
                    <div id="cashSection" class="form-group" style="display:none;">
                        <label for="cashAmount">Cash Amount:</label>
                        <input type="number" id="cashAmount" name="cashAmount" placeholder="Enter cash amount">
                        <!-- If there is change -->
                        <label for="changeAmount">Change Amount:</label>
                        <input type="number" id="changeAmount" name="changeAmount" placeholder="Enter change amount">
                    </div>

                    <!-- GCash Payment Section -->
                    <div id="gcashSection" class="form-group" style="display:none;">
                        <label for="gcashNumber">GCash Number:</label>
                        <input type="text" id="gcashNumber" name="gcashNumber" placeholder="Enter GCash number">
                    </div>

                    <button class="buttonZ" type="submit">Submit Payment</button>
                </form>
            </div>
        </div>

        <!-- If the Order is EMPTY -->

        <!-- <div class="titleEmpty">
            <h1>Your Cart is Empty</h1>
            <h3>Your cart is currently empty! Start adding your favorite siopao and treats from our menu to enjoy a delicious meal today!</h3>
        </div>
        <div class="orderButton-container">
            <button name="orderNowEmptyCart" onclick="location.href='menuPage.php'">Order Now</button>
        </div> -->

    </section>

    <script>
        // Get modal elements and buttons
        const modal = document.getElementById("checkOutModal");
        const checkoutButton = document.getElementById("checkoutButton");
        const closeModal = document.querySelector(".modal .close");

        // Open modal when checkout button is clicked
        checkoutButton.addEventListener("click", function() {
            modal.style.display = "block";
        });

        // Close modal when close button is clicked
        closeModal.addEventListener("click", function() {
            modal.style.display = "none";
        });

        // Close modal when clicking outside the modal content
        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        // Toggle visible form sections based on payment method
        const paymentMethod = document.getElementById('paymentMethod');
        const cardSection = document.getElementById('cardSection');
        const cashSection = document.getElementById('cashSection');
        const gcashSection = document.getElementById('gcashSection');

        paymentMethod.addEventListener('change', function() {
            // Hide all sections initially
            cardSection.style.display = 'none';
            cashSection.style.display = 'none';
            gcashSection.style.display = 'none';

            // Display the relevant section based on the selected value
            switch (this.value) {
                case 'card':
                    cardSection.style.display = 'block';
                    break;
                case 'cash':
                    cashSection.style.display = 'block';
                    break;
                case 'gcash':
                    gcashSection.style.display = 'block';
                    break;
            }
        });
    </script>
</body>

</html>
