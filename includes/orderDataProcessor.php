<?php
session_start();
include 'dbhc.inc.php';

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