DROP TABLE Wishlist;
DROP TABLE Order_Info;
DROP TABLE Ordered_Item;
DROP TABLE Shopping_Cart;
DROP TABLE Customer;
DROP TABLE Product;


-- Create Wishlist DB
CREATE TABLE Wishlist (
	Product_ID INT,
	Customer_ID INT,
	
	PRIMARY KEY (Customer_ID),
	FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID),
	FOREIGN KEY (Product_ID) REFERENCES Product(Product_ID)
);

-- Define Order Info DB
create table Order_Info(
    Order_ID char(20) not null,
    Customer_ID char(10) not null,
    Processing_status char(15) default 'Processing',
    Seller_Notes char(100),
    Tracking_Number int(10) auto_increment,
    Price decimal(6,2) not null,
    
    Primary Key(Order_ID,Customer_ID, Price),
    Foreign Key(Order_ID,Customer_ID) References Ordered_Item(Order_ID, Price), Customer(Customer_ID)
);

	Order_ID INT NOT NULL,
	Customer_ID INT,
	Tracking_Number

-- Define Ordered Item DB
CREATE TABLE Ordered_Item (
	Order_ID INT,
	Customer_ID INT,
	Product_ID INT,
	Quantity INT,
	Price DECIMAL(6,2),

	PRIMARY KEY (Product_ID, Order_ID),
	FOREIGN KEY (Product_ID) REFERENCES Product(Product_ID)
);

-- Define Cart DB
CREATE TABLE Shopping_Cart (
	cart_id INT NOT NULL,
	Product_ID INT,
	Customer_ID INT,
	Quantity,

	PRIMARY KEY (cart_id),
	FOREIGN KEY (Product_ID) REFERENCES Product(Product_ID),
	FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID)
);

-- Define Customer DB
CREATE TABLE Customer (
	Customer_ID INT AUTO_INCREMENT,
	Customer_Name CHAR(255),
	Phone_Number INT,
	Shipping_Address CHAR(255),
	Card_Number INT,

	PRIMARY KEY (Customer_ID)
);

-- Define Product_ID
CREATE TABLE Product (
	Product_ID INT AUTO_INCREMENT,
	Product_Name CHAR(255),
	Stock INT,
	Details CHAR(255),
	Size CHAR(12) NULL,
	Color CHAR(50) NULL,
	Base_Price DECIMAL(6,2),

	PRIMARY KEY (Product_ID)
);

