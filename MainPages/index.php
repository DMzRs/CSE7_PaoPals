<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../Styles/mainPage.css?v=<?php echo time(); ?>">
    <title>PaoPals</title>
</head>

<body>
    <?php include '../Templates/navBar.php'; ?>
    <section class="main-container">
        <div class="first-container">
            <div class="p-container">
                <h1>Freshly Steamed Siopao, Every Time!<br>Order Now!</h1>
            </div>
            <div class="car-container">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button hidden type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button hidden type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button hidden type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="2500">
                            <img src="../Images/Siopao/sample_1.png" class="d-block w-100" alt="1">
                        </div>
                        <div class="carousel-item" data-bs-interval="2500">
                            <img src="../Images/Siopao/sample_2.png" class="d-block w-100" alt="2">
                        </div>
                        <div class="carousel-item" data-bs-interval="2500">
                            <img src="../Images/Siopao/sample_3.png" class="d-block w-100" alt="3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" hidden type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" hidden type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="intro-container">
            <h1>Welcome to PaoPals</h1>
            <h3>PaoPals is where authentic flavors and convenience meet. Enjoy freshly steamed Siopao crafted with care and delivered with ease.<br>Order now for a satisfying experience!</h3>
        </div>
        <div class="third-container">
            <h1>Best Sellers</h1>
            <div class="best-seller-container">
                <div class="first-best bs-containers">
                    <img src="../Images/products/sample_1.png" alt="1">
                    <h2>Siopao Name</h2>
                    <button class="orderNowBtn" name="order1">ORDER NOW</button>
                </div>
                <div class="second-best bs-containers">
                    <img src="../Images/products/sample_2.png" alt="2">
                    <h2>Siopao Name</h2>
                    <button class="orderNowBtn" name="order2">ORDER NOW</button>
                </div>
                <div class="third-best bs-containers">
                    <img src="../Images/products/sample_3.png" alt="3">
                    <h2>Siopao Name</h2>
                    <button class="orderNowBtn" name="order3">ORDER NOW</button>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("../includes/fetchBestSellers.php")
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const bestSellerContainer = document.querySelector(".best-seller-container");
                        bestSellerContainer.innerHTML = data.products.map(product => `
                        <div class="bs-containers">
                            <img src="../Images/products/${product.productImage}" alt="${product.productName}">
                            <h2>${product.productName}</h2>
                            <p>₱${parseFloat(product.productPrice).toFixed(2)}</p>
                            <button class="orderNowBtn" data-id="${product.productId}">ORDER NOW</button>
                        </div>
                    `).join("");

                        // Add event listener to order buttons
                        document.querySelectorAll(".orderNowBtn").forEach(button => {
                            button.addEventListener("click", function() {
                                let productId = this.getAttribute("data-id");

                                fetch("../includes/addToOrder.php", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/x-www-form-urlencoded"
                                        },
                                        body: "productId=" + productId
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        alert(data.message);
                                    });
                            });
                        });
                    }
                });
        });
    </script>

</body>

</html>