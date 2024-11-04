<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

// Validate GET parameters
if (!isset($_GET['service_id']) || !isset($_GET['customer_id'])) {
    die('Invalid request. Missing service or customer ID.');
}

// Fetch the service details
$service_id = htmlspecialchars($_GET['service_id']);
$customer_id = htmlspecialchars($_GET['customer_id']);
$getServiceByID = getServiceByID($pdo, $service_id);

// Check if the service exists
if (!$getServiceByID) {
    die('Service not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="viewservices.php?customer_id=<?php echo $customer_id; ?>">View All Services</a>
    <h1>Edit the service!</h1>
    
    <form action="core/handleForms.php?service_id=<?php echo $service_id; ?>&customer_id=<?php echo $customer_id; ?>" method="POST">
        <p>
            <label for="serviceDate">Service Date</label> 
            <input type="date" name="serviceDate" value="<?php echo htmlspecialchars($getServiceByID['ServiceDate']); ?>" required>
        </p>
        <p>
            <label for="serviceType">Service Type</label> 
            <input type="text" name="serviceType" value="<?php echo htmlspecialchars($getServiceByID['ServiceType']); ?>" required>
        </p>
        <p>
            <label for="cost">Cost</label> 
            <input type="number" step="0.01" name="cost" value="<?php echo htmlspecialchars($getServiceByID['Cost']); ?>" required>
        </p>
        <p>
            <label for="description">Description</label> 
            <textarea name="description" required><?php echo htmlspecialchars($getServiceByID['Description']); ?></textarea>
        </p>
        <p>
            <input type="submit" name="editServiceBtn" value="Save Changes">
        </p>
    </form>
</body>
</html>
