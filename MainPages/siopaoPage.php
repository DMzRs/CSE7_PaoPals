<?php 
include '../Templates/navBar.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/menuPage.css?v=<?php echo time(); ?>">
    <title>PaoPals - Siopao</title>
</head>

<body>
    <section class="main-container">
        <div class="menu-options">
            <h1>Menu</h1>
            <ul>
                <li><h2><a href="../MainPages/menuPage.php">All</a></h2></li>
                <li class="active"><h2><a href="../MainPages/siopaoPage.php">Siopao</a></h2></li>
                <li><h2><a href="../MainPages/drinksPage.php">Drinks</a></h2></li>
                <li><h2><a href="../MainPages/dessertPage.php">Dessert</a></h2></li>
            </ul>
        </div>

        <div class="menu-products">
            <h2 class="product-category">Siopao</h2>
            <div class="products" id="product-list"></div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("../includes/fetchProducts.php?category=Siopao")
                .then(response => response.json())
                .then(data => {
                    const productList = document.getElementById("product-list");
                    productList.innerHTML = data.map(product => `
                        <div class="product-container">
                            <img src="../Images/products/${product.productImage}" alt="${product.productName}">
                            <h2>${product.productName}</h2>
                            <p>Price: ₱${parseFloat(product.productPrice).toFixed(2)}</p>
                            <button class="orderBtn" data-id="${product.productId}">ORDER</button>
                        </div>
                    `).join("");

                    document.querySelectorAll(".orderBtn").forEach(button => {
                        button.addEventListener("click", function () {
                            let productId = this.getAttribute("data-id");

                            fetch("../includes/addToOrder.php", {
                                method: "POST",
                                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                                body: "productId=" + productId
                            })
                            .then(response => response.json())
                            .then(data => {
                                alert(data.message);
                            });
                        });
                    });
                });
        });
    </script>
</body>
</html>
