<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Services</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php">Return to home</a>
    
    <?php 
        // Get the customer ID from the URL
        $customer_id = $_GET['customer_id']; 
        $customer = getCustomerByID($pdo, $customer_id); 
    ?>
    
    <h1>Customer Details</h1>
    <?php if ($customer): ?>
        <h2>Name: <?php echo htmlspecialchars($customer['FirstName'] . ' ' . $customer['LastName']); ?></h2>
        <h3>Phone Number: <?php echo htmlspecialchars($customer['PhoneNumber']); ?></h3>
        <h3>Email: <?php echo htmlspecialchars($customer['Email']); ?></h3>
        <h3>Date Added: <?php echo htmlspecialchars($customer['DateAdded']); ?></h3>
        <!-- Link to handle forms (e.g., adding or editing services) -->
        <a href="core/handleForms.php?customer_id=<?php echo htmlspecialchars($customer_id); ?>" class="button">Add New Service</a>
    <?php else: ?>
        <p>Customer not found.</p>
    <?php endif; ?>

    <h2>Add a New Service</h2>
    <form action="core/handleForms.php?customer_id=<?php echo htmlspecialchars($customer_id); ?>" method="POST">
        <p>
            <label for="serviceDate">Service Date</label> 
            <input type="date" name="serviceDate" required>
        </p>
        <p>
            <label for="serviceType">Service Type</label> 
            <input type="text" name="serviceType" required>
        </p>
        <p>
            <label for="cost">Cost</label> 
            <input type="number" step="0.01" name="cost" required>
        </p>
        <p>
            <label for="description">Description</label> 
            <textarea name="description" required></textarea>
        </p>
        <p>
            <input type="submit" name="insertServiceBtn" value="Add Service">
        </p>
    </form>

    <h2>Services for this Customer</h2>
    <?php $services = getServicesByCustomer($pdo, $customer_id); ?>

    <?php if ($services): ?>
        <div class="services-container">
            <?php foreach ($services as $service): ?>
                <div class="service-card">
                    <strong><?php echo htmlspecialchars($service['ServiceType']); ?></strong><br>
                    <span><?php echo htmlspecialchars($service['ServiceDate']); ?></span><br>
                    <span>Cost: <?php echo htmlspecialchars($service['Cost']); ?></span>
                    <span>Description: <?php echo htmlspecialchars($service['Description']); ?></span> <!-- Add this line -->
                    <div class="service-actions">
                        <a href="editservice.php?service_id=<?php echo $service['ServiceID']; ?>&customer_id=<?php echo $customer_id; ?>">Edit</a>
                        <a href="deleteservice.php?service_id=<?php echo $service['ServiceID']; ?>&customer_id=<?php echo $customer_id; ?>">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No services found for this customer.</p>
    <?php endif; ?>
</body>
</html>
