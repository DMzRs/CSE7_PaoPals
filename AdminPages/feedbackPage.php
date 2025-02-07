<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../AdminStyles/feedbackPage.css?v=<?php echo time(); ?>">
    <title>PaoPals</title>
</head>
<body>
    <?php include '../Templates/navBarAdmin.php'; ?>

    <section class="main-container">
        <div class="header-container">
            <h1>Hello, James Oliver Mendoza</h1>
        </div>
        <div class="first-container">
            <div class="tab-container">
                <a class="dashboard" href="mainDashboard.php">Dashboard</a>
                <a class="products" href="productPage.php">Products</a>
                <a class="inventory" href="inventoryPage.php">Inventory</a>
                <a class="feedback" href="feedbackPage.php">Feedbacks</a>
            </div>
            <div class="feedback-container">
                <h1 class="feedbackHeader">Feedback</h1>
                <div class="feedbacks">
                    <div class="message-container">
                        <!-- same logic dri message class dapat mag sugod ang element insert same format -->
                        <div class="message">
                            <div class="message-header">
                            <strong>From James Oleber</strong>
                            <span class="date">2/05/2025</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit omnis voluptas fugiat hic eaque quisquam optio. Vitae ipsum quos nobis odio, deleniti eius reiciendis harum minus, quaerat dolor ratione consectetur?Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel provident id voluptatum a, sunt, incidunt expedita ullam debitis magni ipsa molestias. Numquam dolorem et doloribus culpa quia consequatur ullam sint.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>