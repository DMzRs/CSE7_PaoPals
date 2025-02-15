<?php
session_start();
include_once '../includes/dbhc.inc.php';

// Check if user is logged in as admin
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    header('Location: ../MainPages/login.php');
    exit;
}

// Fetch inventory data for display
try {
    $stmt = $pdo->query("
        SELECT 
            p.productName,
            p.productCategory,
            i.stockQuantity,
            i.dateCreated,
            i.expirationDate,
            i.status
        FROM Inventory i
        JOIN Product p ON i.productId = p.productId
        ORDER BY i.dateCreated DESC
    ");
    $inventoryRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $inventoryRows = [];
}

// Fetch products for restock dropdown
try {
    $stmt = $pdo->query("SELECT productId, productName FROM Product ORDER BY productName");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $products = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../AdminStyles/inventoryPage.css?v=<?= time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>PaoPals</title>
</head>
<body>
    <?php include '../Templates/navBarAdmin.php'; ?>
    <section class="main-container">
        <div class="header-containerS">
            <h1>Welcome, <?= htmlspecialchars($_SESSION['userName'] ?? 'Admin') ?></h1>
        </div>
        <div class="first-container">
            <div class="tab-container">
                <a class="dashboard" href="mainDashboard.php">Dashboard</a>
                <a class="products" href="productPage.php">Products</a>
                <a class="inventory" href="inventoryPage.php">Inventory</a>
                <a class="feedbacks" href="feedbackPage.php">Feedbacks</a>
            </div>
            <div class="inventory-container">
                <h1 class="inventoryHeader">Inventory</h1>
                <div class="modal-buttons">
                    <button type="button" class="addStockBtn" data-bs-toggle="modal" data-bs-target="#addStocksModal">
                        Add Stocks
                    </button>
                    <button type="button" class="addStockBtn" data-bs-toggle="modal" data-bs-target="#restockModal">
                        Restock Product
                    </button>
                </div>
                <!-- Add Stock Modal -->
                <div class="modal fade" id="addStocksModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Product Stock</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="../includes/inventoryPage.inc.php" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">Product Image:</label>
                                        <input type="file" class="form-control" name="imagefile" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Product Name:</label>
                                        <input type="text" class="form-control" name="productName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Category:</label>
                                        <select class="form-select" name="category" required>
                                            <option value="Siopao">Siopao</option>
                                            <option value="Drinks">Drinks</option>
                                            <option value="Desserts">Desserts</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Price:</label>
                                        <input type="number" step="0.01" class="form-control" name="productPrice" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Date Arrived:</label>
                                        <input type="date" class="form-control" name="dateArrived" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Expiration Date:</label>
                                        <input type="date" class="form-control" name="expiryDate" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Quantity:</label>
                                        <input type="number" class="form-control" name="stockQuantity" required>
                                    </div>
                                    <button type="submit" name="addStock" class="btn btn-primary">Add Stock</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Restock Modal -->
                <div class="modal fade" id="restockModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Restock Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="../includes/inventoryPage.inc.php">
                                        <div class="mb-3">
                                            <label class="form-label">Product:</label>
                                            <select class="form-select" name="productId" required>
                                                <?php foreach ($products as $product): ?>
                                                    <option value="<?= $product['productId'] ?>"><?= $product['productName'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Quantity:</label>
                                            <input type="number" class="form-control" name="qtyRestock" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Restock Date:</label>
                                            <input type="date" class="form-control" name="restockDate" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">New Expiry Date:</label>
                                            <input type="date" class="form-control" name="newExpDate" required>
                                        </div>
                                        <button type="submit" name="restock" class="btn btn-primary">Restock</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Inventory Table -->
                <div class="table-containerS">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Date Created</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($inventoryRows as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['productName']) ?></td>
                                    <td><?= htmlspecialchars($row['productCategory']) ?></td>
                                    <td><?= htmlspecialchars($row['stockQuantity']) ?></td>
                                    <td><?= htmlspecialchars($row['dateCreated']) ?></td>
                                    <td><?= htmlspecialchars($row['expirationDate']) ?></td>
                                    <td><?= htmlspecialchars($row['status']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>