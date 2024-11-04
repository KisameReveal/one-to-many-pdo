<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

// Insert new customer
if (isset($_POST['insertCustomerBtn'])) {
    $query = insertCustomer($pdo, $_POST['firstName'], $_POST['lastName'], 
        $_POST['phoneNumber'], $_POST['email']);

    if ($query) {
        header("Location: ../index.php");
        exit; // Always exit after a redirect
    } else {
        echo "Customer insertion failed"; // Consider redirecting to an error page instead
    }
}

// Edit existing customer
if (isset($_POST['editCustomerBtn'])) {
    $customer_id = $_GET['customer_id'] ?? null; // Use null coalescing to avoid undefined index notice

    if ($customer_id) {
        $query = updateCustomer($pdo, $_POST['firstName'], $_POST['lastName'], 
            $_POST['phoneNumber'], $_POST['email'], $customer_id);

        if ($query) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Customer update failed"; // Consider redirecting to an error page instead
        }
    } else {
        echo "Customer ID is missing.";
    }
}

// Delete customer
if (isset($_POST['deleteCustomerBtn'])) {
    $customer_id = $_GET['customer_id'] ?? null;

    if ($customer_id) {
        $query = deleteCustomer($pdo, $customer_id);

        if ($query) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Customer deletion failed"; // Consider redirecting to an error page instead
        }
    } else {
        echo "Customer ID is missing.";
    }
}

// Insert service
if (isset($_POST['insertServiceBtn'])) {
    $customer_id = $_GET['customer_id'] ?? null; // Make sure to retrieve this correctly
    $service_date = $_POST['serviceDate'];
    $service_type = $_POST['serviceType'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];

    if ($customer_id) {
        // Insert the service into the database
        $result = insertService($pdo, $customer_id, $service_date, $service_type, $cost, $description);

        if ($result) {
            // Redirect back to view services page after successful insertion
            header("Location: ../viewservices.php?customer_id=" . $customer_id);
            exit; // Always exit after a redirect
        } else {
            echo "Error adding service."; // Consider redirecting to an error page instead
        }
    } else {
        echo "Customer ID is missing.";
    }
}

// Edit service
if (isset($_POST['editServiceBtn'])) {
    // Validate and sanitize input
    $service_id = htmlspecialchars($_GET['service_id']);
    $customer_id = htmlspecialchars($_GET['customer_id']);
    $serviceDate = $_POST['serviceDate'];
    $serviceType = $_POST['serviceType'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];

    // Update the service in the database
    $stmt = $pdo->prepare("UPDATE services SET ServiceDate = ?, ServiceType = ?, Cost = ?, Description = ? WHERE ServiceID = ?");
    $stmt->execute([$serviceDate, $serviceType, $cost, $description, $service_id]);

    // Redirect back to viewservices.php after successful update
    header("Location: ../viewservices.php?customer_id=" . $customer_id);
    exit();
}

// Delete service
if (isset($_POST['deleteServiceBtn'])) {
    if (isset($_POST['service_id']) && isset($_POST['customer_id'])) {
        $service_id = $_POST['service_id'];
        $customer_id = $_POST['customer_id'];
        $query = deleteService($pdo, $service_id);

        if ($query) {
            header("Location: ../viewservices.php?customer_id=" . $customer_id);
            exit;
        } else {
            echo "Service deletion failed";
        }
    } else {
        echo "Invalid request. Missing service or customer ID.";
    }
}

?>
