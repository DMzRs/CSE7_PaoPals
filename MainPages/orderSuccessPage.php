<?php
session_start();
include '../includes/dbhc.inc.php';

if (!isset($_SESSION['customerLoggedIn']) || !isset($_SESSION['customerId'])) {
    header("Location: index.php");
    exit();
}

$customerId = $_SESSION['customerId'];

try {
    $stmt = $pdo->prepare("SELECT o.orderId FROM `Order` o WHERE o.customerId = ? AND o.status = 'Completed' ORDER BY o.orderDate DESC LIMIT 1");
    $stmt->execute([$customerId]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$order) {
        throw new Exception("No completed order found.");
    }

    $orderId = $order['orderId'];
    
    $stmt = $pdo->prepare("SELECT p.productImage, p.productName, oi.quantity, oi.unitPrice, (oi.quantity * oi.unitPrice) AS subTotal 
                           FROM OrderItem oi 
                           JOIN Product p ON oi.productId = p.productId 
                           WHERE oi.orderId = ?");
    $stmt->execute([$orderId]);
    $orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $totalCost = array_sum(array_column($orderItems, 'subTotal'));
} catch (Exception $e) {
    error_log("Error fetching order details: " . $e->getMessage());
    $orderItems = [];
    $totalCost = 0;
}
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
