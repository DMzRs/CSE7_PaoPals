<?php
include '../includes/dbhc.inc.php';

$category = $_GET['category'] ?? null;

$query = "SELECT p.*, 
                COALESCE(SUM(si.remainingQuantity), 0) AS remainingStock
         FROM Product p
         LEFT JOIN StockIn si ON p.productId = si.productId
         GROUP BY p.productId";

$params = [];

if ($category) {
    $query = "SELECT p.*, 
                     COALESCE(SUM(si.remainingQuantity), 0) AS remainingStock
              FROM Product p
              LEFT JOIN StockIn si ON p.productId = si.productId
              WHERE p.productCategory = ?
              GROUP BY p.productId";
    $params[] = $category;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
