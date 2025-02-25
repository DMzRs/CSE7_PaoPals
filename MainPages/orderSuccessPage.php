<?php
include '../includes/orderDataProcessor.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="../Styles/orderSuccessPage.css?v=<?php echo time(); ?>">
    <title>PaoPals</title>
</head>
<body>
    <?php include '../Templates/navBar.php'; ?>
    <section class="mainContainer">
        <div class="checkIcon">
            <img src="../Images/Icon/checkLogo.png" alt="success">
        </div>
        <div class="header">
            <h1>Thank you for your purchase!</h1>
            <h2>Your order will be arriving soon.<br> Sit tight and Relax...</h2>
        </div>
        <div class="secondHeader">
            <h1>Order Summary</h1>
        </div>
        <div class="orderContainer">
            <div class="table-containerS">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($orderItems)): ?>
                            <?php foreach ($orderItems as $item): ?>
                                <tr class="mainRow">
                                    <td><img src="../Images/products/<?php echo htmlspecialchars($item['productImage']); ?>" alt="picture"></td>
                                    <td><?php echo htmlspecialchars($item['productName']); ?> x <?php echo $item['quantity']; ?></td>
                                    <td>₱<?php echo number_format($item['subTotal'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2">Total:</td>
                                <td>₱<?php echo number_format($totalCost, 2); ?></td>
                            </tr>
                        <?php else: ?>
                            <tr><td colspan="3">No recent orders found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="backToHome">
            <button class="backToHomebtn" onclick="location.href='index.php'"><h1>Back to Home</h1></button>
        </div>
    </section>
</body>
</html>
