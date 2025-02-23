<?php
include '../includes/dbhc.inc.php';
session_start();

if (!isset($_SESSION['customerLoggedIn']) || !isset($_SESSION['customerId'])) {
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit;
}

$customerId = $_SESSION['customerId'];

$query = "
    SELECT oi.productId, p.productName, oi.quantity, (oi.quantity * oi.unitPrice) AS totalPrice, o.orderDate
    FROM OrderItem oi
    JOIN `Order` o ON oi.orderId = o.orderId
    JOIN Product p ON oi.productId = p.productId
    JOIN Payment py ON o.orderId = py.orderId  -- Ensures we only fetch completed orders
    WHERE o.customerId = ? 
    ORDER BY o.orderDate DESC
";

$stmt = $pdo->prepare($query);
$stmt->execute([$customerId]);

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($orders) {
    echo json_encode(["success" => true, "orders" => $orders]);
} else {
    echo json_encode(["success" => true, "orders" => []]); // Return an empty array to trigger the "No Orders" message
}
?>
