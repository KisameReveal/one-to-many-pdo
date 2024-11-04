-- Create Customers table (Parent Table)
CREATE TABLE Customers (
    CustomerID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    PhoneNumber VARCHAR(15),
    Email VARCHAR(100),
    DateAdded DATETIME DEFAULT CURRENT_TIMESTAMP  -- New column for date added
);

-- Create Services table (Child Table)
CREATE TABLE Services (
    ServiceID INT PRIMARY KEY AUTO_INCREMENT,
    CustomerID INT,
    ServiceDate DATE NOT NULL,
    ServiceType VARCHAR(50) NOT NULL,
    Cost DECIMAL(10, 2) NOT NULL,
    Description VARCHAR(255),
    DateAdded DATETIME DEFAULT CURRENT_TIMESTAMP,  -- New column for date added
    FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID)
);
