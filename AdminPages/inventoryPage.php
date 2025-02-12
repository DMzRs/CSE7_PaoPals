<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../AdminStyles/inventoryPage.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>PaoPals</title>
</head>
<body>
    <?php include '../Templates/navBarAdmin.php'; ?>

    <section class="main-container">
        <div class="header-containerS">
            <h1>James Oliver Mendoza</h1>
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
                <!-- Button trigger modal -->
                    <button type="button" class="addStockBtn" data-bs-toggle="modal" data-bs-target="#addStocksModal">
                    Add Stocks
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addStocksModal" tabindex="-1" aria-labelledby="addStocksModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addStocksModalLabel">Add Stocks</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="modalForms" action="">
                                <div>
                                    <label for="file">Choose Product Image:</label><br>
                                    <input type="file" name="file" id="file">
                                </div>
                                <div>
                                    <label for="productName">Product Name:</label>
                                    <input class="inputS" type="text" id="productName" name="productName">
                                </div>
                                <div>
                                    <label for="category">Category:</label>
                                    <select name="category" id="category">
                                        <option value="Siopao">Siopao</option>
                                        <option value="Drinks">Drinks</option>
                                        <option value="Desserts">Desserts</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="dateArrived">Date Arrived:</label>
                                    <input type="date" id="dateArrived" name="dateArrived">
                                </div>
                                <div>
                                    <label for="expiryDate">Expiration Date:</label>
                                    <input type="date" id="expiryDate" name="expiryDate">
                                </div>
                                <div>
                                    <label for="stockQuantity">Quantity:</label>
                                    <input class="inputS" type="text" id="stockQuantity" name="stockQuantity">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="table-containerS">
                    <table>
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
                            <tr>
                                <td>Pork Asado Siopao</td>
                                <td>Siopao</td>
                                <td>1</td>
                                <td>2/05/2025</td>
                                <td>2/08/2025</td>
                                <td>Expired</td>
                            </tr>
                            <tr>
                                <td>Pork Asado Siopao</td>
                                <td>Siopao</td>
                                <td>1</td>
                                <td>2/05/2025</td>
                                <td>2/08/2025</td>
                                <td>Available</td>
                            </tr>
                        </tbody>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>