DROP TABLE Wishlist;
DROP TABLE Order_Info;
DROP TABLE Ordered_Item;
DROP TABLE Shopping_Cart;
DROP TABLE Customer;
DROP TABLE Product;



-- Define Customer DB
CREATE TABLE Customer (
	Customer_ID CHAR(255),
	Customer_Name CHAR(255),
	Phone_Number BIGINT,
	Shipping_Address CHAR(255),
	Card_Number BIGINT,

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

-- Define Ordered Item DB
CREATE TABLE Ordered_Item (
	Order_ID INT AUTO_INCREMENT,
	Customer_ID CHAR(255),
	Product_ID INT,
	Quantity INT,
	Price DECIMAL(6,2),

	PRIMARY KEY (Order_ID),
	FOREIGN KEY (Product_ID) REFERENCES Product(Product_ID), 
	FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID)
);

-- Create Wishlist DB
CREATE TABLE Wishlist (
	Product_ID INT,
	Customer_ID CHAR(255),
	
	PRIMARY KEY (Customer_ID, Product_ID),
	FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID),
	FOREIGN KEY (Product_ID) REFERENCES Product(Product_ID)
);

-- Define Order Info DB
create table Order_Info (
    Order_ID INT not null,
    Customer_ID CHAR(255),
    Processing_status char(15) default 'Processing',
    Seller_Notes char(100),
    Tracking_Number int(10) AUTO_INCREMENT,
    Price decimal(6,2) not null,
    
    Primary Key(Tracking_Number),
    FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID),
    Foreign Key(Order_ID) References Ordered_Item(Order_ID)
);

-- Define Cart DB
CREATE TABLE Shopping_Cart (
	Product_ID INT,
	Customer_ID CHAR(255),
	Quantity INT,

	PRIMARY KEY (Product_ID, Customer_ID),
	FOREIGN KEY (Product_ID) REFERENCES Product(Product_ID),
	FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID)
);
