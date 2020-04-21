DROP DATABASE IF EXISTS DWPDB;
CREATE DATABASE DWPDB;
USE DWPDB;

-- CREATE TABLES
CREATE TABLE Products (
    ProductID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name varchar(255) NOT NULL,
    Price double(10,2) NOT NULL,
    Description varchar(255) NULL
);


CREATE TABLE Users (
    UserID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name varchar(255) NOT NULL,
    Email varchar(25) NOT NULL
);

CREATE TABLE Orders (
    OrderID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    UserID int NOT NULL,
    FOREIGN KEY(UserID) REFERENCES Users(UserID)
    
);




-- MODIFY TABLES
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




