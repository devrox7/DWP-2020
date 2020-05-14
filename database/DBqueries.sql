DROP DATABASE IF EXISTS DWPDB;
CREATE DATABASE DWPDB;
USE DWPDB;


-- CREATE TABLES
CREATE TABLE products (
    ProductID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name varchar(255) NOT NULL,
    Price double(10,2) NOT NULL,
    Description varchar(255) NULL,
    Image text NOT NULL,
    Code varchar(255) NOT NULL,
    Discount int(100)
);


CREATE TABLE roles (
    RoleID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    RoleName varchar(255) NOT NULL
);


CREATE TABLE users (
    UserID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name varchar(255) NOT NULL,
    Address varchar(255) NOT NULL,
    ZIP varchar(255) NOT NULL,
    City varchar(255) NOT NULL,
    Phone varchar(255) NOT NULL,
    Email varchar(255) NOT NULL,
    Password varchar(255) NOT NULL,
    RoleID int DEFAULT 2,
    FOREIGN KEY(RoleID) REFERENCES roles(RoleID)

);


CREATE TABLE orders (
    OrderID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    UserID int NOT NULL,
    FOREIGN KEY(UserID) REFERENCES users(UserID)
);


CREATE TABLE orderEntries (
    OrderID int NOT NULL,
    ProductID int NOT NULL,
    quantity int NOT NULL,
    PRIMARY KEY (OrderID, ProductID)

);


CREATE TABLE offers (
    OfferID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ProductID int NOT NULL,
    Discount int NOT NULL,
    FOREIGN KEY(ProductID) REFERENCES products(ProductID)

);


CREATE TABLE invoice (
    InvoiceID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ProductID int NOT NULL,
    UserID int NOT NULL,
    FOREIGN KEY(ProductID) REFERENCES products(ProductID),
    FOREIGN KEY(UserID) REFERENCES users(UserID)
);


CREATE TABLE company (
    CompanyID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name varchar(255) NOT NULL,
    Description varchar(255) NOT NULL,
    OpeningHours varchar(255) NOT NULL,
    ContactInfo varchar(255) NOT NULL,
    Address varchar(255) NOT NULL
);




-- MODIFY TABLES
ALTER TABLE Users ADD (
    Address varchar(255) NOT NULL,
    ZIP varchar(255) NOT NULL,
    City varchar(255) NOT NULL,
    Phone varchar(255) NOT NULL,
    Password varchar(255) NOT NULL
)

ALTER TABLE Product ADD (
    Image text NOT NULL,
    Code varchar(255) NOT NULL
)

UPDATE Products
SET Image = 'duck01.png', Code ='DS0020'
WHERE ProductID = 1

UPDATE Products
SET Image = 'duck02.png', Code ='DS0021'
WHERE ProductID = 2

ALTER TABLE Products ADD(
    SpecialOffer boolean
)

ALTER TABLE Products ADD(
    SpecialOffer boolean
)


-- INSERT DATA
INSERT INTO roles (RoleName)
VALUES ('admin'), ('customer')

--VIEWS
CREATE VIEW RandomProducts AS
SELECT Name, Price, Description, Image
FROM products
ORDER BY RAND ( )  
LIMIT 3


CREATE VIEW DicountProducts AS
SELECT *
FROM products
WHERE Discount IS NOT NULL








