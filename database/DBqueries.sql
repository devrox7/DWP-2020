DROP DATABASE IF EXISTS DWPDB_ROXANA;
CREATE DATABASE DWPDB_ROXANA;
USE DWPDB_ROXANA;


-- CREATE TABLES
CREATE TABLE IF NOT EXISTS products(
    ProductID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name varchar(255) NOT NULL,
    Price double(10,2) NOT NULL,
    Description varchar(255) NULL,
    Image text NOT NULL,
    Code varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS offers (
    OfferID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ProductID int NOT NULL,
    Discount int(2) NOT NULL,
    FOREIGN KEY(ProductID) REFERENCES products(ProductID)

);

CREATE TABLE IF NOT EXISTS roles (
    RoleID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    RoleName varchar(255) NOT NULL
);


CREATE TABLE IF NOT EXISTS users (
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


CREATE TABLE IF NOT EXISTS orders (
    OrderID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    UserID int NOT NULL,
    FOREIGN KEY(UserID) REFERENCES users(UserID)
);


CREATE TABLE IF NOT EXISTS orderEntries (
    OrderID int NOT NULL,
    ProductID int NOT NULL,
    quantity int NOT NULL,
    FOREIGN KEY(OrderID) REFERENCES orders(OrderID),
    FOREIGN KEY(ProductID) REFERENCES products(ProductID),
    CONSTRAINT PK_orderEntry PRIMARY KEY (OrderID,ProductID)
);



CREATE TABLE IF NOT EXISTS invoice (
    InvoiceID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    OrderID int NOT NULL,
    FOREIGN KEY(OrderID) REFERENCES orders(OrderID)
);


CREATE TABLE IF NOT EXISTS company (
    CompanyID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name varchar(255) NOT NULL,
    Description text NOT NULL,
    OpeningHours varchar(255) NOT NULL,
    ContactInfo varchar(255) NOT NULL,
    Address varchar(255) NOT NULL
);



-- MODIFY TABLES

-- ALTER TABLE Users ADD (
--     Address varchar(255) NOT NULL,
--     ZIP varchar(255) NOT NULL,
--     City varchar(255) NOT NULL,
--     Phone varchar(255) NOT NULL,
--     Password varchar(255) NOT NULL
-- )

-- ALTER TABLE Product ADD (
--     Image text NOT NULL,
--     Code varchar(255) NOT NULL
-- )

-- UPDATE Products
-- SET Image = 'duck01.png', Code ='DS0020'
-- WHERE ProductID = 1

-- UPDATE Products
-- SET Image = 'duck02.png', Code ='DS0021'
-- WHERE ProductID = 2



-- INSERT DATA
INSERT INTO products (Name,Price,Description,Image,Code)
VALUES ("Danish Duck",100,"Send this duck as a gift to a helpful friend. Just choose 'Ship to different address' when you buy this duck and fill out the address details of your valuable friend. We'll send it in our special Duck Store bag. Such a nice surprise!","duck01.png","DS0020"), 
       ("Royal Duck",200,"Buy the Jewish Torah teacher of the Amsterdam Duck Store. With hat and beard. Torah scrolls and Hanukkah menorah (candles).","duck02.png","DS0021"),
       ("Hulk Duck",350,"Incredible Rubber Duck. Buy the strong and furious superhero of the Amsterdam Duck Store. Looks like the Hulk when he's angry. With green body, sixpack muscles, black hair and what's left of this trousers. Perfect gift for a short-tempered friend.","duck03.jpg","31253245"),
       ("Queen Duck",500,"Queen Crown Rubber Duck, luxury edition. Buy the royal majesty of the Amsterdam Duck Store. With beautiful crown and dress.","duck05.jpg","43546347"),
       ("Trump Duck",10,"Trump Rubber Duck. Buy the president of the Amsterdam Duck Store. With blue suit, tie, USA flag and typical Trump hairdo and gesticulating. Says he's the best duck ever. No duck can quack as good as he can. Really, no-one. It's true.","duck06.jpg","45645363");

INSERT INTO offers (ProductID, Discount)
VALUES (2,10), 
       (4,15), 
       (5,50);

INSERT INTO roles (RoleName)
VALUES ('admin'), ('customer');

INSERT INTO users (Name, Address, ZIP, City, Phone, Email, Password, RoleID)
VALUES ("Hello Admin", "Storegade", "6700", "Esbjerg", "+4512345678", "admin@admin.dk", "123456", 1),
       ("Patrik", "Stormgade", "5000", "Odense", "+4500110011", "patrik@gmail.com", "123456", 2),
       ("Fred", "Vestergade", "8700", "Horsens", "+4522332233", "fred@gmail.com", "123456", 2),
       ("Alex", "Viborgvej", "8000", "Aarhus", "+4545454545", "alex@gmail.com", "123456", 2);

INSERT INTO orders (UserID)
VALUES (2),
       (4),
       (2),
       (3);

INSERT INTO orderEntries (OrderID, ProductID, quantity)
VALUES (1,2,5),
       (1,5,1),
       (2,1,15),
       (3,4,3),
       (4,3,17),
       (4,4,1);

INSERT INTO invoice (OrderID)
VALUES (1),
       (2),
       (3),
       (4);

INSERT INTO company (Name, Description, OpeningHours, ContactInfo, Address)
VALUES ("Rubber Duck Shop","Welcome to our online duck store and meet the cutest rubber ducks of Denmark. They’re all premium ducks made of high quality materials and CE approved. Discover the hand painted details and special finishing. Absolute collectors items. Take your pick. Order online worldwide or visit our duck stores in Denmark", "Working weekdays 08-17", "service@duckshop.dk | +4500112233", "Denmark");



-- VIEWS
CREATE VIEW RandomProducts AS
SELECT Name, Price, Description, Image
FROM products
ORDER BY RAND ( )  
LIMIT 3;


CREATE VIEW DicountProducts AS
SELECT products.Name, products.Price, products.Description, products.Code, products.Image, offers.Discount
FROM products
JOIN offers ON offers.ProductID = products.ProductID
WHERE offers.Discount IS NOT NULL;



-- JOIN QUERIES

-- get order's data
SELECT orders.OrderID, users.Name, products.Name, orderEntries.quantity
FROM orders
JOIN users ON orders.UserID = users.UserID
JOIN orderEntries ON orders.OrderID = orderEntries.OrderID
JOIN products ON products.ProductID = orderEntries.ProductID;

-- get invoice data
SELECT invoice.InvoiceID, orders.OrderID, users.Name, products.Name, orderEntries.quantity
FROM invoice
JOIN orders ON invoice.OrderID = orders.OrderID
JOIN users ON orders.UserID = users.UserID
JOIN orderEntries ON orders.OrderID = orderEntries.OrderID
JOIN products ON products.ProductID = orderEntries.ProductID
WHERE users.UserID = 2



