<?php
// includes/mainDashboard.inc.php
global $pdo;

// Initialize dashboard metrics
$totalIncome = 0;
$orderCount = 0;
$customerCount = 0;
$bestSellingProducts = [];

try {
    // Calculate Total Income
    $stmt = $pdo->query("SELECT SUM(paymentTotalCost) FROM Payment");
    $totalIncome = $stmt->fetchColumn();

    // Calculate Order Count
    $stmt = $pdo->query("SELECT COUNT(orderId) FROM `Order`");
    $orderCount = $stmt->fetchColumn();

    // Calculate Customer Count
    $stmt = $pdo->query("SELECT COUNT(customerId) FROM Customer");
    $customerCount = $stmt->fetchColumn();

    // Get Best Selling Products
    $stmt = $pdo->query("
        SELECT 
            p.productName,
            SUM(oi.quantity) AS totalSold
        FROM OrderItem oi
        JOIN Product p ON oi.productId = p.productId
        GROUP BY oi.productId, p.productName
        ORDER BY totalSold DESC
        LIMIT 8
    ");
    $bestSellingProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
}
