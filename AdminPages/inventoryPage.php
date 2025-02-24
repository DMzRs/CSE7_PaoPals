<?php
session_start();
include_once '../includes/dbhc.inc.php';
include_once '../includes/inventoryQueries.inc.php';

// Check admin access
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    header('Location: ../MainPages/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../AdminStyles/inventoryPage.css?v=<?= time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <button type="button" class="addStockBtn" id="restock" data-bs-toggle="modal" data-bs-target="#restockModal">
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
                                    <div class="mb-3" style="width: 600px;">
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
                                            <option value="Dessert">Dessert</option>
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
                                    <div class="mb-3" style="width: 400px;">
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
                <!-- Stock In Table -->
                <h1 class="labels">Stock In</h1>
                <div class="table-containerS">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Remaining Quantity</th>
                                <th>Date Created</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stockInData as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['productName']) ?></td>
                                    <td><?= htmlspecialchars($row['productCategory']) ?></td>
                                    <td><?= number_format($row['quantity']) ?></td>
                                    <td><?= number_format($row['remainingQuantity']) ?></td>
                                    <td><?= $row['dateCreated'] ?></td>
                                    <td><?= $row['expirationDate'] ?></td>
                                    <td><?= htmlspecialchars($row['status']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Stock Out Table -->
                <h1 class="labels">Stock Out</h1>
                <div class="table-containerS">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Date Used</th>
                                <th>Cause</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stockOutData as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['productName']) ?></td>
                                    <td><?= htmlspecialchars($row['productCategory']) ?></td>
                                    <td><?= number_format($row['quantity']) ?></td>
                                    <td><?= $row['dateUsed'] ?></td>
                                    <td><?= htmlspecialchars($row['cause']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>