<?php
session_start();

// Include database connection
include_once '../includes/dbhc.inc.php';

// Check admin access
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    header('Location: ../MainPages/login.php');
    exit;
}

$errors = [];
$success = false;

// Helper function to redirect with messages
function redirectWithMessage($success, $message, $url)
{
    $_SESSION['message'] = [
        'type' => $success ? 'success' : 'danger',
        'text' => $message
    ];
    header('Location: ' . $url);
    exit;
}

// Process Add Stock form
if (isset($_POST['addStock'])) {
    // Retrieve form data
    $productName = trim($_POST['productName']);
    $category = trim($_POST['category']);
    $productPrice = trim($_POST['productPrice']);
    $dateCreated = $_POST['dateArrived'];
    $expiryDate = trim($_POST['expiryDate']);
    $quantity = (int)$_POST['stockQuantity'];
    $imageFile = $_FILES['imagefile'];

    // Validation
    if (empty($productName)) $errors[] = 'Product name is required.';
    if (empty($category)) $errors[] = 'Category is required.';
    if (empty($_FILES['imagefile']['name'])) $errors[] = 'Product image is required.';
    if (empty($dateCreated)) $errors[] = 'Date created is required.';
    if (empty($expiryDate)) $errors[] = 'Expiry date is required.';
    if ($quantity <= 0) $errors[] = 'Stock quantity must be positive.';
    if ($productPrice <= 0) $errors[] = 'Product price must be positive.';
    if (strtotime($expiryDate) < strtotime($dateCreated)) $errors[] = 'Expiry date cannot be before date created.';

    // Handle image upload
    $targetDir = '../Images/products/';
    $fileName = time() . '_' . basename($imageFile['name']);
    $targetFile = $targetDir . $fileName;

    if (!move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
        $errors[] = 'Error uploading product image.';
    }

    if (empty($errors)) {
        try {
            // Insert into Product
            $stmt = $pdo->prepare("
                INSERT INTO Product (productName, productCategory, productImage, productPrice)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$productName, $category, $fileName, $productPrice]);
            $productId = $pdo->lastInsertId();

            // Insert into StockIn
            $stmt = $pdo->prepare("
                INSERT INTO StockIn (productId, quantity, remainingQuantity, dateCreated, expirationDate, status)
                VALUES (?, ?, ?, ?, ?, 'Available')
            ");
            $stmt->execute([$productId, $quantity, $quantity, $dateCreated, $expiryDate]);

            redirectWithMessage(true, 'Product added successfully.', '../AdminPages/inventoryPage.php');
        } catch (PDOException $e) {
            $errors[] = 'Database error: ' . $e->getMessage();
        }
    }
}

// Process Restock form
if (isset($_POST['restock'])) {
    // Retrieve form data
    $productId = (int)$_POST['productId'];
    $quantity = (int)$_POST['qtyRestock'];
    $dateCreated = $_POST['restockDate'];
    $expiryDate = trim($_POST['newExpDate']);

    // Validation
    if ($quantity <= 0) $errors[] = 'Restock quantity must be positive.';
    if (empty($dateCreated)) $errors[] = 'Restock date is required.';
    if (empty($expiryDate)) $errors[] = 'New expiry date is required.';
    if (strtotime($expiryDate) < strtotime($dateCreated)) $errors[] = 'Expiry date cannot be before restock date.';

    if (empty($errors)) {
        try {
            // Insert into StockIn
            $stmt = $pdo->prepare("
                INSERT INTO StockIn (productId, quantity, remainingQuantity, dateCreated, expirationDate, status)
                VALUES (?, ?, ?, ?, ?, 'Available')
            ");
            $stmt->execute([$productId, $quantity, $quantity, $dateCreated, $expiryDate]);

            redirectWithMessage(true, 'Product restocked successfully.', '../AdminPages/inventoryPage.php');
        } catch (PDOException $e) {
            $errors[] = 'Database error: ' . $e->getMessage();
        }
    }
}

// Handle remaining errors
if (!empty($errors)) {
    redirectWithMessage(false, implode('<br>', $errors), '../AdminPages/inventoryPage.php');
}
