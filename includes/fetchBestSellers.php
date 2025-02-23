<?php
include '../includes/dbhc.inc.php';

// Query to get top 3 best-selling products based on total quantity sold
$queryBestSellers = "
    SELECT p.productId, p.productName, p.productImage, p.productPrice, SUM(oi.quantity) AS totalSold
    FROM OrderItem oi
    JOIN `Order` o ON oi.orderId = o.orderId
    JOIN Payment py ON o.orderId = py.orderId  -- Ensures only completed orders
    JOIN Product p ON oi.productId = p.productId
    GROUP BY p.productId
    ORDER BY totalSold DESC
    LIMIT 3
";

$stmt = $pdo->prepare($queryBestSellers);
$stmt->execute();
$bestSellers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If fewer than 3 best sellers, fetch any 3 available products instead
if (count($bestSellers) < 3) {
    $queryAvailableProducts = "
        SELECT productId, productName, productImage, productPrice
        FROM Product
        ORDER BY RAND()
        LIMIT 3
    ";
    $stmt = $pdo->prepare($queryAvailableProducts);
    $stmt->execute();
    $bestSellers = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Return data as JSON
echo json_encode(["success" => true, "products" => $bestSellers]);
?>
