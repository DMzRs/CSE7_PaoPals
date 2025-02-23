<?php
include '../includes/dbhc.inc.php';

$category = $_GET['category'] ?? null;
$query = "SELECT p.*, 
                COALESCE(SUM(si.quantity), 0) - COALESCE(SUM(so.quantity), 0) AS remainingStock
         FROM Product p
         LEFT JOIN StockIn si ON p.productId = si.productId
         LEFT JOIN StockOut so ON si.stockInId = so.stockInId -- Corrected join
         GROUP BY p.productId
         HAVING remainingStock > 0";

$params = [];

if ($category) {
    $query = "SELECT p.*, 
                     COALESCE(SUM(si.quantity), 0) - COALESCE(SUM(so.quantity), 0) AS remainingStock
              FROM Product p
              LEFT JOIN StockIn si ON p.productId = si.productId
              LEFT JOIN StockOut so ON si.stockInId = so.stockInId -- Corrected join
              WHERE p.productCategory = ?
              GROUP BY p.productId
              HAVING remainingStock > 0";
    $params[] = $category;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

