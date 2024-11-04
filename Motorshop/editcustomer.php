<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php $getCustomerByID = getCustomerByID($pdo, $_GET['customer_id']); ?>
    <h1>Edit Customer Details</h1>
    <form action="core/handleForms.php?customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">
        <p>
            <label for="firstName">First Name</label> 
            <input type="text" name="firstName" value="<?php echo $getCustomerByID['FirstName']; ?>">
        </p>
        <p>
            <label for="lastName">Last Name</label> 
            <input type="text" name="lastName" value="<?php echo $getCustomerByID['LastName']; ?>">
        </p>
        <p>
            <label for="phoneNumber">Phone Number</label> 
            <input type="text" name="phoneNumber" value="<?php echo $getCustomerByID['PhoneNumber']; ?>">
        </p>
        <p>
            <label for="email">Email</label> 
            <input type="email" name="email" value="<?php echo $getCustomerByID['Email']; ?>">
        </p>
        <p>
            <input type="submit" name="editCustomerBtn" value="Save Changes">
        </p>
    </form>
</body>
</html>
