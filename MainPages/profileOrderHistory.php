<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Styles/profileOrderHistory.css?v=<?php echo time(); ?>">
    <title>PaoPals</title>
</head>
<body>
    <?php include '../Templates/navBar.php'; ?>
    <section class="main-container">
        <div class="header-container">
            <h1>YOUR ACCOUNT</h1>
            <h2>Order History</h2>
        </div>
        <div class="first-container">
        <div class="tab-container">
                <a class="profileEdit" href="profilePage.php">Account Info</a>
                <a class="orderHistory" href="profileOrderHistory.php">Order History</a>
            </div>
            <div class="history-container">
                <h3>Your Past Orders</h3>
                        <!-- if walay orders pa ang customer kay ang h2 lang ang mu show up dapat -->
                        <!-- <h2>You do not have any saved orders.</h2> -->
                        <table>
                        <thead>
                        <tr>
                            <th>Items Ordered</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Pork Asado Siopao</td>
                            <td>1</td>
                            <td>₱90.00</td>
                            <td>2/05/2025</td>
                        </tr>
                        <tr>
                            <td>Pork Asado Siopao</td>
                            <td>1</td>
                            <td>₱90.00</td>
                            <td>2/05/2025</td>
                        </tr>
                        <tr>
                            <td>Pork Asado Siopao</td>
                            <td>1</td>
                            <td>₱90.00</td>
                            <td>2/05/2025</td>
                        </tr>
                        </tbody>
                        </table>
                </div>
        </div>
    </section>
</body>
</html>