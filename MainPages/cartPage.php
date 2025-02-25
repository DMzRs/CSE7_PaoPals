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
        <div class="header">
            <h1>Your Order Cart <img src="../Images/Icon/orderCart_icon.png" alt="Order Cart"></h1>
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
        <div class="order-containers"></div>
        <div class="total-cost-container">
            <div class="totalCostTitle">
                <h2>Total Cost:</h2>
            </div>
            <div class="totalCost">
                <h2>₱0.00</h2>
            </div>
        </div>
        <div class="buttons">
            <button class="continueOrder" onclick="location.href='menuPage.php'">
                <h2>Continue Order</h2>
            </button>
            <button class="checkOut" id="checkoutButton">
                <h2>Checkout</h2>
            </button>
        </div>

        <div id="checkOutModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Checkout</h2>
                <form id="checkoutForm">
                    <div class="form-group">
                        <label>Payment Method:</label>
                        <select id="paymentMethod" required>
                            <option value="">Select method</option>
                            <option value="gcash">GCash</option>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                        </select>
                    </div>

                    <!-- Card Section -->
                    <div id="cardSection" class="form-group" style="display:none;">
                        <label>Card Number:</label>
                        <input type="number" name="cardNumber" placeholder="Enter card number">
                    </div>

                    <!-- Cash Section -->
                    <div id="cashSection" class="form-group" style="display:none;">
                        <label>Cash Amount ₱</label>
                        <input type="number" id="cashAmount" name="cashAmount" placeholder="Enter cash amount" step="0.01">
                        <label>Change: </label>
                        <span id="cashChange">₱0.00</span>
                    </div>

                    <!-- GCash Section -->
                    <div id="gcashSection" class="form-group" style="display:none;">
                        <label>GCash Number:</label>
                        <input type="number" name="gcashNumber" placeholder="Enter GCash number">
                    </div>

                    <button class="buttonZ" type="submit">Submit Payment</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        // Dynamic Cart Loading
        async function loadCart() {
            const response = await fetch('../includes/fetchCart.php');
            const data = await response.json();

            const orderContainers = document.querySelector('.order-containers');
            orderContainers.innerHTML = data.length ? '' : `
    <div class="titleEmpty">
        <h1>Your Cart is Empty</h1>
        <h3>Your cart is currently empty! Start adding your favorite siopao and treats from our menu to enjoy a delicious meal today!</h3>
    </div>
    
`;


            data.forEach(item => {
                const orderItem = document.createElement('div');
                orderItem.className = 'order-container';
                orderItem.innerHTML = `
                    <div class="orderName"><h2>${item.productName}</h2></div>
                    <div class="orderImg"><img src="../Images/products/${item.productImage}" alt="${item.productName}"></div>
                    <div class="orderPrice"><h2>₱${item.unitPrice.toFixed(2)}</h2></div>
                    <div class="orderQuantity">
                        <button class="reduceQuantity" data-id="${item.orderItemId}"><img src="../Images/Icon/deduct_icon.png" alt="deduct" ></button>
                        <h2>${item.quantity}</h2>
                        <button class="increaseQuantity" data-id="${item.orderItemId}"><img src="../Images/Icon/add_icon.png" alt="add"></button>
                    </div>
                    <div class="orderTotalPrice"><h2>₱${(item.quantity * item.unitPrice).toFixed(2)}</h2></div>
                    <div class="orderDelete"><button class="deleteOrder" ><img src="../Images/Icon/deleteOrder_icon.png" alt="deleteOrder" data-id="${item.orderItemId}"></button></div>
                `;
                orderContainers.appendChild(orderItem);
            });

            attachEventListeners();
            updateTotalCost();
        }

        function attachEventListeners() {
            document.querySelectorAll('.increaseQuantity').forEach(btn => btn.addEventListener('click', incrementQuantity));
            document.querySelectorAll('.reduceQuantity').forEach(btn => btn.addEventListener('click', decrementQuantity));
            document.querySelectorAll('.deleteOrder').forEach(btn => btn.addEventListener('click', deleteItem));
        }

        function incrementQuantity(e) {
            const itemId = e.target.closest('button').dataset.id; // Ensures we get the button's data-id
            updateQuantity(itemId, 1);
        }

        function decrementQuantity(e) {
            const itemId = e.target.closest('button').dataset.id; // Ensures we get the button's data-id
            updateQuantity(itemId, -1);
        }

        async function updateQuantity(itemId, delta) {
            const response = await fetch('../includes/updateQuantity.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `orderItemId=${itemId}&delta=${delta}`
            });
            const data = await response.json();
            if (data.success) {
                loadCart();
            } else {
                alert(data.message);
            }
        }

        function deleteItem(e) {
            const itemId = e.target.dataset.id;
            fetch('../includes/deleteOrderItem.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `orderItemId=${itemId}`
                })
                .then(() => loadCart())
                .catch(() => alert('Error deleting item'));
        }

        function updateTotalCost() {
            let total = 0;
            document.querySelectorAll('.orderTotalPrice h2').forEach(el => {
                total += parseFloat(el.textContent.replace('₱', ''));
            });
            document.querySelector('.totalCost h2').textContent = `₱${total.toFixed(2)}`;
        }

        //Check out handling

        document.getElementById('checkoutForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const paymentMethod = document.getElementById('paymentMethod').value;
            const totalCost = parseFloat(document.querySelector('.totalCost h2').textContent.replace('₱', ''));

            // Validate GCash number
            if (paymentMethod === "gcash") {
                const gcashNumber = document.querySelector('input[name="gcashNumber"]').value.trim();
                const gcashPattern = /^09\d{9}$/; // Starts with 09 + 9 digits

                if (!gcashPattern.test(gcashNumber)) {
                    alert("Invalid GCash number. It must start with '09' and be exactly 11 digits long.");
                    return;
                }
            }

            // Validate Cash Payment
            if (paymentMethod === "cash") {
                const cashAmountInput = document.getElementById('cashAmount');
                const cashAmount = parseFloat(cashAmountInput.value);

                if (isNaN(cashAmount) || cashAmount < totalCost) {
                    alert("Insufficient cash. Please enter a valid amount.");
                    cashAmountInput.focus(); // Focus input field for user to correct
                    return;
                }
            }

            // Validate Card Number
            if (paymentMethod === "card") {
                const cardNumber = document.querySelector('input[name="cardNumber"]').value.trim();
                const cardPattern = /^\d{16}$/; // Exactly 16 digits

                if (!cardPattern.test(cardNumber)) {
                    alert("Invalid card number. It must be exactly 16 digits long.");
                    return;
                }
            }

            // Proceed with checkout if all validations pass
            const response = await fetch('../includes/completeOrder.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `paymentMethod=${paymentMethod}&totalCost=${totalCost}`
            });

            const data = await response.json();
            if (data.success) {
                alert(data.message);
                location.href = '../MainPages/orderSuccessPage.php';
            } else {
                alert(data.message);
            }
        });




        const paymentMethod = document.getElementById('paymentMethod');
        const cardSection = document.getElementById('cardSection');
        const cashSection = document.getElementById('cashSection');
        const gcashSection = document.getElementById('gcashSection');

        paymentMethod.addEventListener('change', function() {
            cardSection.style.display = 'none';
            cashSection.style.display = 'none';
            gcashSection.style.display = 'none';

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

        // Calculate and display cash change
        document.getElementById('cashAmount').addEventListener('input', function() {
            const cashAmount = parseFloat(this.value);
            const totalCost = parseFloat(document.querySelector('.totalCost h2').textContent.replace('₱', ''));

            if (!isNaN(cashAmount) && cashAmount >= totalCost) {
                document.getElementById('cashChange').textContent = `₱${(cashAmount - totalCost).toFixed(2)}`;
            } else {
                document.getElementById('cashChange').textContent = '₱0.00';
            }
        });


        // Modal Handling
        const modal = document.getElementById('checkOutModal');
        document.getElementById('checkoutButton').addEventListener('click', () => modal.style.display = 'block');
        modal.querySelector('.close').addEventListener('click', () => modal.style.display = 'none');
        modal.addEventListener('click', (e) => e.target === modal && (modal.style.display = 'none'));

        // Initial Load
        document.addEventListener('DOMContentLoaded', loadCart);
    </script>
</body>

</html>