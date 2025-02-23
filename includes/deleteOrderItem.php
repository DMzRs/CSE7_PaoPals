<?php
session_start();
include '../includes/dbhc.inc.php';

if (!isset($_SESSION['customerLoggedIn'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$customerId = $_SESSION['customerId'];
$orderItemId = $_POST['orderItemId'];

try {
    $stmt = $pdo->prepare("SELECT oi.orderItemId 
                           FROM OrderItem oi 
                           JOIN `Order` o ON oi.orderId = o.orderId 
                           WHERE oi.orderItemId = ? AND o.customerId = ? AND o.status = 'Pending'");
    $stmt->execute([$orderItemId, $customerId]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        $stmt = $pdo->prepare("DELETE FROM OrderItem WHERE orderItemId = ?");
        $stmt->execute([$orderItemId]);
        echo json_encode(['success' => true, 'message' => 'Item removed']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found']);
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error deleting item']);
}
?>