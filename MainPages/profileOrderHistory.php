<?php 
include '../Templates/navBar.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Styles/profileOrderHistory.css?v=<?php echo time(); ?>">
    <title>PaoPals - Order History</title>
</head>
<body>
    <section class="main-container">
        <div class="header-container">
            <h1>YOUR ACCOUNT</h1>
            <h2>Order History</h2>
        </div>
        <div class="first-container">
            <div class="tab-container">
                <a class="profileEdit" href="profilePage.php">Account Info</a>
                <a class="orderHistory active" href="profileOrderHistory.php">Order History</a>
            </div>
            <div class="history-container">
                <h3>Your Past Orders</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Items Ordered</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="order-history-body">
                        <!-- Order history will be dynamically inserted here -->
                    </tbody>
                </table>
                <h2 id="no-orders-message" style="display: none; text-align: center; color: gray;">
                    You do not have any saved orders.
                </h2>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("../includes/fetchOrderHistory.php")
                .then(response => response.json())
                .then(data => {
                    const orderTableBody = document.getElementById("order-history-body");
                    const noOrdersMessage = document.getElementById("no-orders-message");

                    orderTableBody.innerHTML = ""; // Clear existing rows

                    if (data.success) {
                        if (data.orders.length === 0) {
                            noOrdersMessage.style.display = "block"; // Show "No Orders" message
                        } else {
                            noOrdersMessage.style.display = "none"; // Hide "No Orders" message
                            data.orders.forEach(order => {
                                orderTableBody.innerHTML += `
                                    <tr>
                                        <td>${order.productName}</td>
                                        <td>${order.quantity}</td>
                                        <td>₱${parseFloat(order.totalPrice).toFixed(2)}</td>
                                        <td>${new Date(order.orderDate).toLocaleDateString()}</td>
                                    </tr>
                                `;
                            });
                        }
                    } else {
                        noOrdersMessage.style.display = "block";
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error("Error fetching order history:", error);
                    document.getElementById("no-orders-message").style.display = "block";
                });
        });
    </script>
</body>
</html>
