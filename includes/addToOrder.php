<?php
session_start();
include '../includes/dbhc.inc.php';

// Ensure the user is logged in
if (!isset($_SESSION['customerId'])) {
    echo json_encode(["success" => false, "message" => "Please log in to order."]);
    exit();
}

$customerId = $_SESSION['customerId'];
$productId = $_POST['productId'] ?? null;

if (!$productId) {
    echo json_encode(["success" => false, "message" => "Invalid product."]);
    exit();
}

try {
    // Get product price
    $stmt = $pdo->prepare("SELECT productPrice FROM Product WHERE productId = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo json_encode(["success" => false, "message" => "Product not found."]);
        exit();
    }

    $unitPrice = $product['productPrice'];

    // Check if there's an existing pending order (Assuming `orderStatus` exists)
    // 🔹 Check if there's an existing pending order
    $orderQuery = $pdo->prepare("SELECT orderId FROM `Order` WHERE customerId = ? AND status = 'Pending' LIMIT 1");
    $orderQuery->execute([$customerId]);
    $order = $orderQuery->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        $orderId = $order['orderId'];
    } else {
        // 🔹 Create a new pending order if none exists
        $createOrder = $pdo->prepare("INSERT INTO `Order` (customerId, status, orderDate) VALUES (?, 'Pending', NOW())");
        $createOrder->execute([$customerId]);
        $orderId = $pdo->lastInsertId();
    }


    // Check if product is already in the order
    $existingItemQuery = $pdo->prepare("SELECT orderItemId, quantity FROM OrderItem WHERE orderId = ? AND productId = ?");
    $existingItemQuery->execute([$orderId, $productId]);
    $existingItem = $existingItemQuery->fetch(PDO::FETCH_ASSOC);

    if ($existingItem) {
        // Update quantity
        $newQuantity = $existingItem['quantity'] + 1;
        $updateOrderItem = $pdo->prepare("UPDATE OrderItem SET quantity = ? WHERE orderItemId = ?");
        $updateOrderItem->execute([$newQuantity, $existingItem['orderItemId']]);
    } else {
        // Insert new item
        $insertOrderItem = $pdo->prepare("INSERT INTO OrderItem (orderId, productId, quantity, unitPrice) VALUES (?, ?, 1, ?)");
        $insertOrderItem->execute([$orderId, $productId, $unitPrice]);
    }

    echo json_encode(["success" => true, "message" => "Added to order!"]);
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage()); // Log error
    echo json_encode(["success" => false, "message" => "An error occurred. Please try again."]);
}
