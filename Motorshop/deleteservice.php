<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

// Check if the required parameters are present
if (!isset($_GET['service_id']) || !isset($_GET['customer_id'])) {
    echo "Invalid request. Missing service or customer ID.";
    exit; // Stop further execution
}

// Continue with fetching and deleting the service
$service_id = $_GET['service_id'];
$customer_id = $_GET['customer_id'];

// Fetch service details for confirmation or deletion logic here
$getServiceByID = getServiceByID($pdo, $service_id); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Service</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Are you sure you want to delete this service?</h1>
    <div class="container" style="border-style: solid; height: 400px;">
        <h2>Service Date: <?php echo htmlspecialchars($getServiceByID['ServiceDate']); ?></h2>
        <h2>Service Type: <?php echo htmlspecialchars($getServiceByID['ServiceType']); ?></h2>
        <h2>Cost: <?php echo htmlspecialchars($getServiceByID['Cost']); ?></h2>
        <h2>Description: <?php echo htmlspecialchars($getServiceByID['Description']); ?></h2>
        <h2>Customer ID: <?php echo htmlspecialchars($getServiceByID['CustomerID']); ?></h2>

        <div class="deleteBtn" style="float: right; margin-right: 10px;">
            <form action="core/handleForms.php" method="POST">
                <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($_GET['service_id']); ?>">
                <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($_GET['customer_id']); ?>">
                <input type="submit" name="deleteServiceBtn" value="Delete">
            </form>
        </div>
    </div>
</body>
</html>
