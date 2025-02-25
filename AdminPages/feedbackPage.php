<?php
session_start();
// Include database connection
include_once '../includes/dbhc.inc.php';

// Check if user is logged in as admin
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    header('Location: ../MainPages/login.php');
    exit;
}

// Fetch feedbacks using PDO
function getFeedbacks(PDO $pdo)
{
    $sql = "SELECT * FROM Feedback ORDER BY submissionDate DESC";
    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database query failed: " . $e->getMessage());
        return [];
    }
}

$feedbacks = getFeedbacks($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../AdminStyles/feedbackPage.css?v=<?= time(); ?>">
    <title>PaoPals Admin - Feedback</title>
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
                <a class="sales" href="salesPage.php">Sales</a>
                <a class="feedback" href="feedbackPage.php">Feedbacks</a>
            </div>
            <div class="feedback-container">
                <h1 class="feedbackHeader">Feedbacks</h1>
                <div class="feedbacks">
                    <?php if (!empty($feedbacks)): ?>
                        <?php foreach ($feedbacks as $feedback): ?>
                            <div class="message-container">
                                <div class="message">
                                    <div class="message-header">
                                        <strong>From <?= htmlspecialchars($feedback['name']) ?> (<?= htmlspecialchars($feedback['email']) ?>)</strong>
                                        <span class="date"><?= date('m/d/Y', strtotime($feedback['submissionDate'])) ?></span>
                                    </div>
                                    <p><?= nl2br(htmlspecialchars($feedback['feedbackText'])) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-feedbacks">
                            <h3>No Feedbacks Received Yet</h3>
                            <p>Keep an eye out for customer feedback!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</body>

</html>