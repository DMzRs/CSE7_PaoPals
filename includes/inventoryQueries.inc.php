<?php
include_once 'dbhc.inc.php';

// Fetch products for restock dropdown
try {
    $stmt = $pdo->query("SELECT productId, productName FROM Product ORDER BY productName");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $products = [];
    echo "<div class='alert alert-danger'>Database error: " . $e->getMessage() . "</div>";
}

// Fetch Stock In data
try {
    $stmt = $pdo->query("
        SELECT 
            p.productName,
            p.productCategory,
            s.quantity,
            s.remainingQuantity,
            s.dateCreated,
            s.expirationDate,
            s.status
        FROM StockIn s
        JOIN Product p ON s.productId = p.productId
        ORDER BY s.dateCreated DESC
    ");
    $stockInData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $stockInData = [];
    echo "<div class='alert alert-danger'>Database error: " . $e->getMessage() . "</div>";
}

// Fetch Stock Out data
try {
    $stmt = $pdo->query("
        SELECT 
            p.productName,
            p.productCategory,
            so.quantity,
            so.dateUsed,
            so.cause
        FROM StockOut so
        JOIN StockIn si ON so.stockInId = si.stockInId
        JOIN Product p ON si.productId = p.productId
        ORDER BY so.dateUsed DESC
    ");
    $stockOutData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $stockOutData = [];
    echo "<div class='alert alert-danger'>Database error: " . $e->getMessage() . "</div>";
}
