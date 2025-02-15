<?php
session_start();

include_once 'dbhc.inc.php';

$errors = [];
$success = false;

// Process Add Stock form
if (isset($_POST['addStock'])) {
    $productName = trim($_POST['productName']);
    $category = trim($_POST['category']);
    $productPrice = (float)$_POST['productPrice'];
    $dateArrived = $_POST['dateArrived'];
    $expiryDate = trim($_POST['expiryDate']);
    $stockQuantity = (int)$_POST['stockQuantity'];
    $imageFile = $_FILES['imagefile'];

    if (empty($productName)) $errors[] = 'Product name is required.';
    if (empty($category)) $errors[] = 'Category is required.';
    if (empty($_FILES['imagefile']['name'])) $errors[] = 'Product image is required.';
    if (empty($dateArrived)) $errors[] = 'Date created is required.';
    if (empty($expiryDate)) $errors[] = 'Expiry date is required.';
    if ($stockQuantity <= 0) $errors[] = 'Stock quantity must be positive.';
    if ($productPrice <= 0) $errors[] = 'Product price must be positive.';

    $targetDir = '../Images/products/';
    $fileName = time() . '_' . basename($imageFile['name']);
    $targetFile = $targetDir . $fileName;

    if (!move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
        $errors[] = 'Error uploading product image.';
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO Product (productName, productCategory, productImage, productPrice)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$productName, $category, $fileName, $productPrice]);
            $productId = $pdo->lastInsertId();

            $stmt = $pdo->prepare("
                INSERT INTO Inventory (productId, dateCreated, expirationDate, stockQuantity)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$productId, $dateArrived, $expiryDate, $stockQuantity]);

            $success = true;
        } catch (PDOException $e) {
            $errors[] = 'Database error: ' . $e->getMessage();
        }
    }
}

// Process Restock form
elseif (isset($_POST['restock'])) {
    $productId = (int)$_POST['productId'];
    $quantity = (int)$_POST['qtyRestock'];
    $restockDate = $_POST['restockDate'];
    $expiryDate = trim($_POST['newExpDate']);

    if ($quantity <= 0) $errors[] = 'Restock quantity must be positive.';
    if (strtotime($expiryDate) < time()) $errors[] = 'Expiry date cannot be in the past.';

    $stmt = $pdo->prepare("SELECT productId FROM Product WHERE productId = ?");
    $stmt->execute([$productId]);
    if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
        $errors[] = 'Product not found.';
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO Inventory (productId, dateCreated, expirationDate, stockQuantity)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$productId, $restockDate, $expiryDate, $quantity]);

            $success = true;
        } catch (PDOException $e) {
            $errors[] = 'Database error: ' . $e->getMessage();
        }
    }
}

// Store messages
if ($success) {
    $_SESSION['message'] = ['type' => 'success', 'text' => 'Operation successful!'];
} else {
    $_SESSION['message'] = ['type' => 'danger', 'text' => implode('\n', $errors)];
}

// Redirect back
header('Location: ../AdminPAges/inventoryPage.php');
exit;
?>