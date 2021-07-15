--Users Table--
DROP TABLE Users CASCADE CONSTRAINTS;
CREATE TABLE Users
(
    user_id INT PRIMARY KEY,
    user_name VARCHAR2(50) NOT NULL,
    user_role VARCHAR2(10) NOT NULL CHECK (user_role IN ('Customer', 'Trader', 'Admin')),
    email VARCHAR2(50) NOT NULL UNIQUE,
    password VARCHAR2(500) NOT NULL,
    address VARCHAR2(50) NOT NULL,
    contact INT NOT NULL,
    user_date DATE NOT NULL,
    gender VARCHAR2(10),
    verified VARCHAR2(5) NOT NULL CHECK (verified IN ('True', 'False'))
);

--Shop Table--
DROP TABLE Shop CASCADE CONSTRAINTS;
CREATE TABLE Shop
(
    shop_id INT PRIMARY KEY,
    user_id INT REFERENCES Users (user_id),
    shop_no INT NOT NULL,
    shop_name VARCHAR2(50) NOT NULL,
    address VARCHAR2(50),
    contact INT,
    authorized VARCHAR2(5) NOT NULL CHECK (authorized IN ('True', 'False'))
);

--Product Table--
DROP TABLE Product CASCADE CONSTRAINTS;
CREATE TABLE Product
(
    product_id INT PRIMARY KEY,
    product_name VARCHAR2(50) NOT NULL UNIQUE,
    description VARCHAR2(200) NOT NULL,
    price FLOAT NOT NULL,
    stock INT NOT NULL,
    allergy_info VARCHAR2(200),
    discount INT,
    category VARCHAR2(20) NOT NULL,
    approved VARCHAR2(5) NOT NULL CHECK (approved IN ('True', 'False')),
    shop_id INT REFERENCES Shop (shop_id)
);

--Image Table--
DROP TABLE Image CASCADE CONSTRAINTS;
CREATE TABLE Image
(
    image_id INT PRIMARY KEY,
    image_name VARCHAR2(20) NOT NULL,
    product_id INT REFERENCES Product (product_id)
);

--Review Table--
DROP TABLE Review CASCADE CONSTRAINTS;
CREATE TABLE Review
(
    review_id INT PRIMARY KEY,
    rating FLOAT,
    comments VARCHAR2(200),
    product_id INT REFERENCES Product(product_id),
    user_id INT REFERENCES Users (user_id)
);

--Cart Table--
DROP TABLE Cart CASCADE CONSTRAINTS;
CREATE TABLE Cart
(
    cart_id INT PRIMARY KEY,
    user_id INT REFERENCES Users (user_id) UNIQUE
);

--Cart Product Table--
DROP TABLE Cart_Product CASCADE CONSTRAINTS;
CREATE TABLE Cart_Product
(
    cart_product_id INT PRIMARY KEY,
    quantity INT NOT NULL,
    wishlist VARCHAR2(5) NOT NULL CHECK (wishlist IN ('True', 'False')),
    cart_id INT REFERENCES Cart (cart_id),
    product_id INT REFERENCES Product (product_id)
);

--Slot Table--
DROP TABLE Slot CASCADE CONSTRAINTS;
CREATE TABLE Slot
(
    slot_id INT PRIMARY KEY,
    slot_time VARCHAR2(20) NOT NULL,
    slot_day DATE NOT NULL,
    total_orders INT
);

--Orders Table--
DROP TABLE Orders CASCADE CONSTRAINTS;
CREATE TABLE Orders
(
    order_id INT PRIMARY KEY,
    total_quantity INT NOT NULL,
    total_price FLOAT NOT NULL,
    cart_id INT REFERENCES Cart (cart_id),
    slot_id INT REFERENCES Slot (slot_id),
    status VARCHAR2(10) NOT NULL CHECK (status IN ('Pending', 'Purchased'))
);

--Order Product Table--
DROP TABLE Order_Product CASCADE CONSTRAINTS;
CREATE TABLE Order_Product
(
    order_product_id INT PRIMARY KEY,
    order_quantity int NOT NULL,
    order_id INT REFERENCES Orders (order_id),
    product_id INT REFERENCES Product (product_id)
);

--Payment Table--
DROP TABLE Payment CASCADE CONSTRAINTS;
CREATE TABLE Payment
(
    payment_id INT PRIMARY KEY,
    payment_amount FLOAT NOT NULL,
    payment_date DATE NOT NULL,
    order_id INT REFERENCES Orders(order_id),
    user_id INT REFERENCES Users (user_id)
);