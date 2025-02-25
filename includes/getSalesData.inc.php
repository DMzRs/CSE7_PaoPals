<?php
include_once '../includes/dbhc.inc.php'; 

function getSalesData() {
    global $pdo;
    try {
        $stmt = $pdo->query("
            SELECT DATE(s.saleDate) AS saleDate, 
                   SUM(oI.quantity) AS totalUnitsSold, 
                   SUM(p.paymentTotalCost) AS totalSales
            FROM Sales s
            JOIN `Order` o ON s.orderId = o.orderId
            JOIN Payment p ON s.paymentId = p.paymentId
            JOIN OrderItem oI ON o.orderId = oI.orderId
            GROUP BY DATE(s.saleDate)
            ORDER BY saleDate DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Database error: ' . $e->getMessage());
        return [];
    }
}

?>
