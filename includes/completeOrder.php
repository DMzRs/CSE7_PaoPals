<?php
session_start();
include '../includes/dbhc.inc.php';

if (!isset($_SESSION['customerLoggedIn']) || !isset($_SESSION['customerId'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$customerId = $_SESSION['customerId'];
$paymentMethod = $_POST['paymentMethod'] ?? '';
$totalCostPosted = (float)$_POST['totalCost'] ?? 0;

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("SELECT orderId FROM `Order` WHERE customerId = ? AND status = 'Pending'");
    $stmt->execute([$customerId]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        throw new PDOException("No pending order found");
    }

    $orderId = $order['orderId'];

    // Fetch order items (including orderItemId)
    $stmt = $pdo->prepare("SELECT oi.orderItemId, oi.productId, oi.quantity, oi.unitPrice 
                           FROM OrderItem oi 
                           WHERE oi.orderId = ?");
    $stmt->execute([$orderId]);
    $orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($orderItems)) {
        throw new PDOException("Order is empty");
    }

    $totalCost = 0;
    foreach ($orderItems as $item) {
        $totalCost += $item['quantity'] * $item['unitPrice'];
    }

    if ($totalCost != $totalCostPosted) {
        error_log("Client attempted to tamper with total cost: {$totalCostPosted} (Server calculation: {$totalCost})");
        throw new PDOException("Total cost mismatch");
    }

    // Update order status
    $stmt = $pdo->prepare("UPDATE `Order` SET status = 'Completed' WHERE orderId = ?");
    $stmt->execute([$orderId]);

    // Record payment (including customerId)
    $stmt = $pdo->prepare("INSERT INTO Payment (orderId, customerId, paymentMethod, paymentTotalCost) 
                           VALUES (?, ?, ?, ?)");
    $stmt->execute([$orderId, $customerId, $paymentMethod, $totalCost]);

    // Deduct stock
    foreach ($orderItems as $item) {
        $productId = $item['productId'];
        $quantity = $item['quantity'];

        while ($quantity > 0) {
            $stmt = $pdo->prepare("SELECT stockInId, remainingQuantity 
                                   FROM StockIn 
                                   WHERE productId = ? AND status = 'Available' 
                                   ORDER BY dateCreated ASC LIMIT 1");
            $stmt->execute([$productId]);
            $stock = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$stock) {
                throw new PDOException("Insufficient stock for product ID $productId");
            }

            $deducted = min($quantity, $stock['remainingQuantity']);
            $newRemaining = $stock['remainingQuantity'] - $deducted;

            $stmt = $pdo->prepare("UPDATE StockIn 
                                   SET remainingQuantity = ?, 
                                       status = IF( ? <= 0, 'Unavailable', 'Available') 
                                   WHERE stockInId = ?");
            $stmt->execute([$newRemaining, $newRemaining, $stock['stockInId']]);

            $stmt = $pdo->prepare("INSERT INTO StockOut (stockInId, quantity, cause, dateUsed) 
                                   VALUES (?, ?, 'Sale', CURDATE())");
            $stmt->execute([$stock['stockInId'], $deducted]);

            $quantity -= $deducted;
        }
    }


    $pdo->commit();

    $stmt = $pdo->prepare("INSERT INTO `Order` (customerId, status, orderDate) VALUES (?, 'Pending', NOW())");
    $stmt->execute([$customerId]);

    echo json_encode([
        'success' => true,
        'message' => 'Order completed successfully. A new pending order has been created.'
    ]);
    
} catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Database Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error completing order: ' . $e->getMessage()]);
}
