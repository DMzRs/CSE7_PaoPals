<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Styles/orderSuccessPage.css?v=<?php echo time(); ?>">
    <title>PaoPals</title>
</head>

<body>
    <?php include '../Templates/navBar.php'; ?>
    <section class="mainContainer">
        <div class="checkIcon">
            <img src="../Images/Icon/checkLogo.png" alt="success">
        </div>
        <div class="header">
            <h1>Thank you for your purchase!</h1>
            <h2>Your order will be arriving soon.<br>
            Sit tight and Relax...</h2>
        </div>
        <div class="secondHeader">
            <h1>Order Summary</h1>
        </div>
        <div class="orderContainer">
            <div class="table-containerS">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Total Units Sold</th>
                            <th>Total Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr class="mainRow">
                                <td><img src="../Images/products/sample_1.png" alt="picture"></td>
                                <td>136</td>
                                <td>P2715912587</td>
                            </tr>
                            <tr>
                                <td colspan="2">Total:</td>
                                <td>₱380</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="backToHome">
            <button class="backToHomebtn"><h1>Back to Home</h1></button>
        </div>
    </section>
</body>
</html>