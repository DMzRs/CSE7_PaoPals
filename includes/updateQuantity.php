<?php
session_start();
include '../includes/dbhc.inc.php';

if (!isset($_SESSION['customerLoggedIn'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$customerId = $_SESSION['customerId'];
$orderItemId = $_POST['orderItemId'];
$delta = (int)$_POST['delta'];

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("SELECT oi.quantity, o.orderId 
                           FROM OrderItem oi 
                           JOIN `Order` o ON oi.orderId = o.orderId 
                           WHERE oi.orderItemId = ? AND o.customerId = ? AND o.status = 'Pending'");
    $stmt->execute([$orderItemId, $customerId]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        $newQuantity = $item['quantity'] + $delta;
        if ($newQuantity < 1) {
            $stmt = $pdo->prepare("DELETE FROM OrderItem WHERE orderItemId = ?");
            $stmt->execute([$orderItemId]);
        } else {
            $stmt = $pdo->prepare("UPDATE OrderItem SET quantity = ? WHERE orderItemId = ?");
            $stmt->execute([$newQuantity, $orderItemId]);
        }
        echo json_encode(['success' => true, 'message' => 'Quantity updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found']);
    }

    $pdo->commit();
} catch (PDOException $e) {
    $pdo->rollBack();
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error updating quantity']);
}
?>