INSERT INTO Customer(Customer_ID, Shipping_Address, Phone_Number, Customer_Name, Card_Number) values
('Landoghini', '4813 Ashton Park, Hoffman Estates, IL 60729', '1871384256', 'Joseph D. Landon', '8712352130'),
('PapaMochi7', '2187 Wayview Ave, Schaumburg, IL 60193', '8794653186', 'James R. Corden', '4563135413'),
('Tobey', '4513 Highland Dr, Bloomington, IL 60428', '8754216512', 'Torey Tobias', '7565164953'),
('livelaughlmao', '7845 Golf Rd, Hoffman Estates, IL 60429', '7895246315', 'Jimmy Mcmallon', '7812643852'),
('Smiff', '9513 Asbury Dr West Chicago, IL 60185', '7635187366', 'Kenny Smith', '1394528760');

INSERT INTO Product (Product_Name, Stock, Details, Size, Color, Base_Price) Values 

('Supreme x CDG T-shirt', 25, 'The long anticipated collaboration between Supreme and Commes Des Garcon has materialized as this thoughtfully designed tee', 'XS', 'White', 129.99),

('Supreme x CDG T-shirt', 25, 'The long anticipated collaboration between Supreme and Commes Des Garcon has materialized as this thoughtfully designed tee', 'S', 'white', 129.99),

('Supreme x CDG T-shirt', 25, 'The long anticipated collaboration between Supreme and Commes Des Garcon has materialized as this thoughtfully designed tee', 'M', 'White', 129.99),

('Supreme x CDG T-shirt', 25, 'The long anticipated collaboration between Supreme and Commes Des Garcon has materialized as this thoughtfully designed tee', 'L', 'White', 129.99),

('Supreme x CDG T-shirt', 25, 'The long anticipated collaboration between Supreme and Commes Des Garcon has materialized as this thoughtfully designed tee', 'XL', 'White', 129.99),

('Supreme x CDG T-shirt', 25, 'The long anticipated collaboration between Supreme and Commes Des Garcon has materialized as this thoughtfully designed tee', 'XXL', 'White', 129.99),

('Supreme x CDG T-shirt', 25, 'The long anticipated collaboration between Supreme and Commes Des Garcon has materialized as this thoughtfully designed tee', 'L', 'Black', 129.99),

('Supreme x CDG T-shirt', 25, 'The long anticipated collaboration between Supreme and Commes Des Garcon has materialized as this thoughtfully designed tee', 'XL', 'Black', 129.99),

('Biplane', 3, 'Defy Sir Issac Newton.', 'XS', 'Black', 449.99),

('Biplane', 3, 'Defy Sir Issac Newton.', 'S', 'Black', 449.99),

('Biplane', 3, 'Defy Sir Issac Newton.', 'M', 'Black', 449.99),

('Biplane', 3, 'Defy Sir Issac Newton.', 'L', 'Black', 449.99),

('Biplane', 3, 'Defy Sir Issac Newton.', 'XL', 'Black', 449.99),

('Biplane', 3, 'Defy Sir Issac Newton.', 'XXL', 'Black', 449.99),

('Baseball Shirt', 1000, 'Fashionable and Simple', 'XS', 'White', 450.66),

('Baseball Shirt', 1000, 'Fashionable and Simple', 'S', 'White', 450.66),

('Baseball Shirt', 1000, 'Fashionable and Simple', 'M', 'White', 450.66),

('Baseball Shirt', 1000, 'Fashionable and Simple', 'L', 'White', 450.66),

('Baseball Shirt', 1000, 'Fashionable and Simple', 'XL', 'White', 450.66),

('Baseball Shirt', 1000, 'Fashionable and Simple', 'XXL', 'White', 450.66);

INSERT INTO Product
	(Product_Name, Stock, Details, Size, Base_Price) Values
	('Dominos Pizza', 600, 'Why bother with the fuss of ordering? Let us order your takeout tonight!', 'S', 7.00),
	('Dominos Pizza', 600, 'Why bother with the fuss of ordering? Let us order your takeout tonight!', 'M', 8.00),
	('Dominos Pizza', 600, 'Why bother with the fuss of ordering? Let us order your takeout tonight!', 'L', 7.00);

INSERT INTO Product
	(Product_Name, Stock, Details, Base_Price) Values
	('Cryptocurrency', 3, 'You heard about em! We got em! Buy the future now!', 3141.59),
	('Early SCOTUS Opinion Draft', 999, 'Curious about the so called Highest Court in the Lands stance on the devils lettuce? Get your flash pass here', 59.99),
	('BTS WINGS TOUR PT 3', 30, 'PHOTOCARD NOT INCLUDED Comes with target promotional poster', 7.00),
	('NordVPN', 120, 'Pay us to collect your data! You get to watch Netflix in Thailand.', 90.00),
	('The Santa Clause 3-Box Set', 549, 'Own the movie franchise that made Tim Allen famous! He stars as Scott Calvin who narrowly avoids attempted santa-cide charges by being BAMBOOZLED into taking over possibly the worst product release schedule ever conceived!', 7.99);

INSERT INTO Product
	(Product_Name, Stock, Details, Size, Color, Base_Price) Values
	('Baby Shoes', 1, 'Never worn and for 0-1 year olds', 'S','Pastel Pink', 8.00),
	('One Weekend with a Fatherly Figure Who Will Cut Your Grass and Grill', 12, 'Missed out on an essential part of childhood? Dad can not grill to save his life? We have the solution. (Willingness to engage in firm, comforting embraces may vary)', 'L', 'white', 120),
	('One Weekend with a Fatherly Figure Who Will Cut Your Grass and Grill', 16, 'Missed out on an essential part of childhood? Dad can not grill to save his life? We have the solution. (Willingness to engage in firm, comforting embraces may vary)', 'XL', 'Black' ,120),
	('EVGA Nvidia RTX 3090 GPU 12GB GDDR6X', 7000, 'AVAILABLE WHILE SUPPLIES LAST. UNBEATABLE PRICE  AT $1 FOR EACH R THAT GETS TXed', 'M', 'Black', 3089.99);


INSERT INTO Ordered_Item(Quantity, Price) values
(2, 129.99),
(1, 129.99),
(1, 449.99),
(3, 129.99),
(1, 129.99),
(2, 129.99),
(1, 129.99),
(1, 129.99),
(3, 449.99),
(1, 450.99);
