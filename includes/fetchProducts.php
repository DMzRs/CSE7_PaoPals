<?php
include '../includes/dbhc.inc.php';

$category = $_GET['category'] ?? null;
$query = "SELECT * FROM Product";
$params = [];

if ($category) {
    $query .= " WHERE productCategory = ?";
    $params[] = $category;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
