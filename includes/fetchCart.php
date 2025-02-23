<?php
session_start();
include '../includes/dbhc.inc.php';

$customerId = $_SESSION['customerId'] ?? 0;

$stmt = $pdo->prepare("
    SELECT 
        oi.orderItemId, 
        p.productName, 
        p.productImage, 
        oi.quantity, 
        oi.unitPrice 
    FROM OrderItem oi
    JOIN Product p ON oi.productId = p.productId
    JOIN `Order` o ON oi.orderId = o.orderId
    WHERE o.customerId = ? AND o.status = 'Pending'
");
$stmt->execute([$customerId]);
$orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ensure unitPrice is returned as a float
foreach ($orderItems as &$item) {
    $item['unitPrice'] = (float) $item['unitPrice']; // Explicitly cast to float
}

echo json_encode($orderItems);
?>
