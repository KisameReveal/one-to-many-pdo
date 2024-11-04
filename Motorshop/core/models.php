<?php  

function insertCustomer($pdo, $first_name, $last_name, $phone_number, $email) {
    $sql = "INSERT INTO Customers (FirstName, LastName, PhoneNumber, Email) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $phone_number, $email]);

    if ($executeQuery) {
        return true;
    }
}

function updateCustomer($pdo, $first_name, $last_name, $phone_number, $email, $customer_id) {
    $sql = "UPDATE Customers
            SET FirstName = ?, 
                LastName = ?, 
                PhoneNumber = ?, 
                Email = ?
            WHERE CustomerID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $phone_number, $email, $customer_id]);
    
    if ($executeQuery) {
        return true;
    }
}

function deleteCustomer($pdo, $customer_id) {
    // Delete related services first
    $sqlDeleteServices = "DELETE FROM Services WHERE CustomerID = ?";
    $stmtServices = $pdo->prepare($sqlDeleteServices);
    $stmtServices->execute([$customer_id]);

    // Now delete the customer
    $sql = "DELETE FROM Customers WHERE CustomerID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id]);

    if ($executeQuery) {
        return true;
    }
}


function getAllCustomers($pdo) {
    $sql = "SELECT * FROM Customers";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getCustomerByID($pdo, $customer_id) {
    $sql = "SELECT * FROM Customers WHERE CustomerID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}


function insertService($pdo, $customer_id, $service_date, $service_type, $cost, $description) {
    $sql = "INSERT INTO Services (CustomerID, ServiceDate, ServiceType, Cost, Description) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id, $service_date, $service_type, $cost, $description]);
    
    if ($executeQuery) {
        return true;
    }
}

function getServicesByCustomer($pdo, $customer_id) {
    $stmt = $pdo->prepare("SELECT ServiceID, ServiceType, ServiceDate, Cost, Description FROM services WHERE CustomerID = ?");
    $stmt->execute([$customer_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getServiceByID($pdo, $service_id) {
    $sql = "SELECT * FROM Services WHERE ServiceID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$service_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

function updateService($pdo, $service_date, $service_type, $cost, $description, $service_id) {
    $sql = "UPDATE Services
            SET ServiceDate = ?,
                ServiceType = ?,
                Cost = ?,
                Description = ?
            WHERE ServiceID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$service_date, $service_type, $cost, $description, $service_id]);

    return $executeQuery; // Return true or false based on execution success
}

function deleteService($pdo, $service_id) {
    $sql = "DELETE FROM Services WHERE ServiceID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$service_id]);

    if ($executeQuery) {
        return true;
    }
}

?>
