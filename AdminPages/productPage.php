<?php
session_start();
include_once '../includes/dbhc.inc.php';

// Ensure admin access
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    header('Location: ../MainPages/login.php');
    exit;
}

$siopaoProducts = [];

try {
    $stmt = $pdo->query("
        SELECT 
            p.productId,
            p.productName,
            p.productImage,
            p.productPrice,
            COALESCE(SUM(si.remainingQuantity), 0) AS stockQuantity
        FROM Product p
        LEFT JOIN StockIn si ON p.productId = si.productId
        WHERE 
            p.productCategory = 'Siopao' 
            AND (si.expirationDate >= CURDATE() OR si.expirationDate IS NULL)
            AND si.status = 'Available'
        GROUP BY 
            p.productId, p.productName, p.productImage, p.productPrice
        ORDER BY p.productName
    ");
    $siopaoProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $siopaoProducts = [];
    error_log('Database error: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../AdminStyles/productPage.css?v=<?php echo time(); ?>">
    <title>PaoPals</title>
</head>

<body>
    <?php include '../Templates/navBarAdmin.php'; ?>

    <section class="main-container">
        <div class="header-container">
            <h1>Welcome, <?= htmlspecialchars($_SESSION['userName'] ?? 'Admin') ?></h1>
        </div>
        <div class="first-container">
            <div class="tab-container">
                <a class="dashboard" href="mainDashboard.php">Dashboard</a>
                <a class="products" href="productPage.php">Products</a>
                <a class="inventory" href="inventoryPage.php">Inventory</a>
                <a class="feedbacks" href="feedbackPage.php">Feedbacks</a>
            </div>
            <div class="menu-container">
                <h1 class="menuHeader">Menu</h1>
                <h3 class="categoryHeader">Category</h3>
                <div class="categories">
                    <div class="siopao">
                        <a href="../AdminPages/productPage.php"><img src="../Images/Siopao/sample_1.png" alt="siopao"></a>
                        <h2>Siopao</h2>
                    </div>
                    <div class="drinks">
                        <a href="../AdminPages/productDrinks.php"><img src="../Images/Drinks/drink1.png" alt="drink"></a>
                        <h2>Drinks</h2>
                    </div>
                    <div class="desserts">
                        <a href="../AdminPages/productDessert.php"><img src="../Images/Desserts/dessert1.png" alt="dessert"></a>
                        <h2>Desserts</h2>
                    </div>
                </div>
                <div class="product-container">
                    <h1>Siopao</h1>
                    <div class="items-container">
                        <?php foreach ($siopaoProducts as $product): ?>
                            <div class="item-container">
                                <div class="container">
                                    <img src="../Images/products/<?= $product['productImage'] ?>" alt="<?= htmlspecialchars($product['productName']) ?>">
                                    <h2><?= htmlspecialchars($product['productName']) ?></h2>
                                    <div>
                                        <h2>₱<?= number_format($product['productPrice'], 2) ?></h2>
                                        <h2>Stocks: <?= number_format($product['stockQuantity']) ?></h2>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>