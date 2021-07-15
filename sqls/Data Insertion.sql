--Users Table--
INSERT INTO Users (user_name, user_role, email, password, address, contact, user_date, verified) VALUES ('Basanta Karki', 'Trader', 'karkibasanta13@gmail.com', '412382137e51ac685d1ac222a9ddf2d4e086bcc2', 'Lalitpur', 9841220029, '02-12-1997', 'True');
INSERT INTO Users (user_name, user_role, email, password, address, contact, user_date, verified) VALUES ('Sumit Dulal', 'Trader', 'sumitdulal@hotmail.com', 'a49b340941ae39cedb2699f2971120a4a1c94d91', 'Lalitpur', 9865214827, '01-01-1998', 'True');
INSERT INTO Users (user_name, user_role, email, password, address, contact, user_date, verified) VALUES ('Shanti Ghale', 'Trader', 'shantighale2000@gmail.com', '1716717c26a5e953fc97191b00f5639ba44bf10d', 'Lalitpur', 9818445515, '05-21-2018', 'True');
INSERT INTO Users (user_name, user_role, email, password, address, contact, user_date, verified) VALUES ('Bipina Poudel', 'Trader', 'bipina234@gmail.com', '62b65da2f3858bdf736caa26040631d4363a25a1', 'Ranibari', 9869083792, '02-05-2020', 'True');
INSERT INTO Users (user_name, user_role, email, password, address, contact, user_date, verified) VALUES ('Seema Shrestha', 'Trader', 'seemashrestha01@gmail.com', 'ad3ffd51566f80ea255ac03ea654f46074f63c97', 'Gokarna', 9841436411, '11-11-2011', 'True');
INSERT INTO Users (user_name, user_role, email, password, address, contact, user_date, verified) VALUES ('Rohit Pandey', 'Trader', 'rpandey@thebritishcollege.edu.np', '2d1ad4b21359c053d713a19e738a1ec5655de7bb', 'Thapathali', 9851047572, '05-03-2021', 'False');
INSERT INTO Users (user_name, user_role, email, password, address, contact, user_date, gender, verified) VALUES ('Dipesh Shrestha', 'Customer', 'shrestha.dipesh1999@gmail.com', 'a0713afd7bf7a837c5add394a2d3abe7de2005a0', 'Samakhusi', 9843809482, '08-07-1999', 'Male', 'True');
INSERT INTO Users (user_name, user_role, email, password, address, contact, user_date, gender, verified) VALUES ('Bimisha Mishra', 'Customer', 'bimu.umib147@gmail.com', '8783ce1b04a48f7a9319c51f87ae8671427ef178', 'Kalanki', 9868194784, '10-27-1999','Female', 'False');

--Shop Table--
INSERT INTO Shop (user_id, shop_no, shop_name, address, contact, authorized) VALUES (1, 1, 'Deli Delicious', 'Cleckhuddersfax', 014354185, 'True');
INSERT INTO Shop (user_id, shop_no, shop_name, address, contact, authorized) VALUES (2, 1, 'Meat Hook', 'Cleckhuddersfax', 014364246, 'True');
INSERT INTO Shop (user_id, shop_no, shop_name, address, contact, authorized) VALUES (3, 1, 'Daily Delights', 'Cleckhuddersfax', 014354254, 'True');
INSERT INTO Shop (user_id, shop_no, shop_name, address, contact, authorized) VALUES (4, 1, 'Smokey Bay Seafood', 'Cleckhuddersfax', 014348692, 'True');
INSERT INTO Shop (user_id, shop_no, shop_name, address, contact, authorized) VALUES (5, 1, 'Clover Grocery', 'Cleckhuddersfax', 014309845, 'True');
INSERT INTO Shop (user_id, shop_no, shop_name, address, contact, authorized) VALUES (5, 2, 'Fruits Valley', 'Cleckhuddersfax', 014356731, 'True');

--Cart Table--
INSERT INTO Cart (user_id) VALUES (7);

--Product Table--
INSERT INTO Product (product_name, description, price, stock, allergy_info, discount, category, approved, shop_id) VALUES ('Paesana Pizza', 'Tomato sauce, mozzerallal, spinach, zucchini, bacon, garlic parmesan', 8.99, 10, 'It contains following allergens: Wheat, Tomato, Garlic and Dairy', 10, 'Delicacy', 'True', 100);
INSERT INTO Product (product_name, description, price, stock, allergy_info, discount, category, approved, shop_id) VALUES ('Piccata Di Pollo', 'Marinated chicken breast with olive oil, mushrooms, tomatoes, herbs on a bed of spaghetti, rice or corn cakes', 11.99, 5, 'It contains following allergens: Wheat, Tomato, Dairy and Corn', 5, 'Delicacy', 'True', 100);
INSERT INTO Product (product_name, description, price, stock, allergy_info, category, approved, shop_id) VALUES ('Caprese Salad', 'Slices of fresh mozzarella and tomato with oregano, basil and olive oil', 5.99, 20, 'It contains following allergens: Tomato, Dairy and Olive', 'Delicacy', 'True', 100);
INSERT INTO Product (product_name, description, price, stock, category, approved, shop_id) VALUES ('Pastrami Burger', '1/4 Beef Patty, Pastrami, Pickles, Mustard, Pepper, Jack Cheese', 6.49, 50, 'Delicacy', 'True', 100);

INSERT INTO Product (product_name, description, price, stock, allergy_info, discount, category, approved, shop_id) VALUES ('Pork Ribs', 'Rib Cage of domestic pig, meat and bones cut together', 10.99, 70, 'It contains following allergens: Gluten', 5, 'Meat', 'True', 101);
INSERT INTO Product (product_name, description, price, stock, discount, category, approved, shop_id) VALUES ('Chicken Leg', 'A leg of farm chicken includes thigh and drumstick without pelvic bones and excessive fat', 2.99, 100, 1, 'Meat', 'True', 101);
INSERT INTO Product (product_name, description, price, stock, allergy_info, category, approved, shop_id) VALUES ('Beef Brisket', 'A cut of meat from the breast or lower chest of beef or veal', 4.99, 60, 'It contains following allergens: Alpha-galactose', 'Meat', 'True', 101);
INSERT INTO Product (product_name, description, price, stock, category, approved, shop_id) VALUES ('Lamb Loin', 'Meat directly behind the ribs, running down the spine towards the hindquarters', 24.99, 150, 'Meat', 'True', 101);

INSERT INTO Product (product_name, description, price, stock, allergy_info, discount, category, approved, shop_id) VALUES ('Carrot Bread', 'A sweet taste of carrot brad mixed with carrot grits with chocolate chips, raisins and walnuts', 5.99, 200, 'It contains following allergens: Dairy, Nuts, Cocoa and Wheat', 50, 'Bakery', 'True', 102);
INSERT INTO Product (product_name, description, price, stock, allergy_info, discount, category, approved, shop_id)VALUES ('Coconut Snowball', 'A vanilla cupcake topped with vanilla buttercream and rolledd in flaky coconut.', 3.99, 50, 'It contains following allergens: Dairy, Coconut and Wheat', 50, 'Bakery', 'True', 102);
INSERT INTO Product (product_name, description, price, stock, allergy_info, discount, category, approved, shop_id) VALUES ('Chocolate Chip Cookies', 'Salt and chewly hotly served baked sweet chocolate chip cookies mixed with real chocolates and topped with chocolate chips', 2.49 , 300, 'It contains following allergens: Flour, Eggs and Cocoa powder', 50, 'Bakery', 'True', 102);
INSERT INTO Product (product_name, description, price, stock, allergy_info, discount, category, approved, shop_id) VALUES ('Red Velvet Cake', 'Tasty red velvet cake spread with white and vanilla frosting, topped with white frosting',  19.99, 20, 'It contains following allergens: Flour, Eggs and Dairy', 50, 'Bakery', 'True', 102);

INSERT INTO Product (product_name, description, price, stock, category, approved, shop_id) VALUES ('Maine Lobster', 'Meat that is dense yet tender with the texture not as flaky as that of crab', 9.99, 50, 'Fish', 'True', 103);
INSERT INTO Product (product_name, description, price, stock, discount, category, approved, shop_id) VALUES ('Alaskan Salmon', 'Highly rich in protein, shiny and moist skin, plump and firm meat', 5.99, 100, 1, 'Fish', 'True', 103);
INSERT INTO Product (product_name, description, price, stock, discount, category, approved, shop_id) VALUES ('Malpeque Oysters', 'Oysters near Prince Edward Island spend the winter under ice, butter/cream flavor, sweet and salty, plump and springy', 6.99, 150, 2, 'Fish', 'True', 103);
INSERT INTO Product (product_name, description, price, stock, category, approved, shop_id) VALUES ('Rainbow Trout Fish', 'Mild meat with delicate nut-like flavor and tender, flasky and soft flesh', 1.99, 30, 'Fish', 'True', 103);
INSERT INTO Product (product_name, description, price, stock, category, approved, shop_id) VALUES ('Calamari Squid', 'Thin and mild flesh with thicker, more powerful meat with smooth texture', 3.99, 200, 'Fish', 'True', 103);
INSERT INTO Product (product_name, description, price, stock, category, approved, shop_id) VALUES ('Alaskan King Crab', 'Premium, cooked, Alaskan king crab legs and claws. Ready to eat, just heat.', 39.99, 20, 'Fish', 'True', 103);

INSERT INTO Product (product_name, description, price, stock, discount, category, approved, shop_id) VALUES ('Broccoli', 'Plant with thick green stalk, or stem which gives rise to thick, leathery and oblong leaves', 0.39, 100, 1, 'Grocery', 'True', 104);
INSERT INTO Product (product_name, description, price, stock, category, approved, shop_id) VALUES ('Onions', 'Dice, slice or cut it in rings and put it in burgers and sandwiches. Onions emit a sharp flavour and fragrance once they are fried.', 0.49, 150, 'Grocery', 'True', 104);
INSERT INTO Product (product_name, description, price, stock, discount, category, approved, shop_id) VALUES ('Bell Pepper', 'Leaving a mild fruity flavour on the tastebuds with thick, shiny skin and fleshy texture inside', 0.29, 160, 3, 'Grocery', 'True', 104);
INSERT INTO Product (product_name, description, price, stock, category, approved, shop_id) VALUES ('Cucumber', 'Organic, Crisp, cool, and refreshing to eat raw.', 0.75, 100, 'Grocery', 'True', 104);

INSERT INTO Product (product_name, description, price, stock, category, approved, shop_id) VALUES ('Mango', 'Cultivated in the foothills, it has irresistibly sweet, juicy and delicious taste with yellow skin and tinge of green on the outside', 1.99, 50, 'Grocery', 'True', 105);
INSERT INTO Product (product_name, description, price, stock, category, approved, shop_id) VALUES ('Strawberry', 'Strawberries are soft, sweet, bright red berries with seeds on the outside', 1.79, 250, 'Grocery', 'True', 105);
INSERT INTO Product (product_name, description, price, stock, category, approved, shop_id) VALUES ('Mixed Berries', 'Plump, smooth-skinned perfect little globes of juicy berries that have mostly sweet and slightly tart flavour', 3.59, 250, 'Grocery', 'True', 105);
INSERT INTO Product (product_name, description, price, stock, discount, category, approved, shop_id) VALUES ('Fresho Avocado', 'Ripe Avocados turn dark brown or Black in colour. Any small black spots on the fruit is due to abrasion during harvesting or handling and does not affect the quality of the fruit', 3.99, 50, 20, 'Grocery', 'True', 105);

--Review Table--
INSERT INTO Review (rating, comments,  product_id, user_id) VALUES (4, 'Our family was looking for a quality pizza and the Paesana Pizza came recommended by a few people.', 1000, 7);
INSERT INTO Review (rating, product_id, user_id) VALUES (2, 1001, 7);
INSERT INTO Review (rating, product_id, user_id) VALUES (3.5, 1002, 7);

INSERT INTO Review (rating, product_id, user_id) VALUES (3, 1005, 7);
INSERT INTO Review (rating, comments, product_id, user_id) VALUES (1.5, 'The meat was a little soggy and had a weird salty taste. Not very tasteful!', 1006, 7);
INSERT INTO Review (rating, product_id, user_id) VALUES (2, 1007, 7);

INSERT INTO Review (rating, comments, product_id, user_id) VALUES (4.5, 'I recently purchased the carrot cake bread while on a road trip. It is absolutely delicious! The texture is moist, but not too crumbly.', 1008, 7);
INSERT INTO Review (rating, product_id, user_id) VALUES (2, 1010, 7);
INSERT INTO Review (rating, product_id, user_id) VALUES (3, 1011, 7);

INSERT INTO Review (rating, comments, product_id, user_id) VALUES (5, 'This was my second time ordering the Lobster. What a great way to treat yourself or someone you love. A nice gift to send to someone during this time', 1012, 7);
INSERT INTO Review (rating, product_id, user_id) VALUES (1, 1013, 7);
INSERT INTO Review (rating, product_id, user_id) VALUES (3.5, 1015, 7);
INSERT INTO Review (rating, product_id, user_id) VALUES (2, 1016, 7);
INSERT INTO Review (rating, product_id, user_id) VALUES (3, 1017, 7);

INSERT INTO Review (rating, product_id, user_id) VALUES (4.5, 1018, 7);
INSERT INTO Review (rating, comments, product_id, user_id) VALUES (0.5, 'I received three fresh green peppers that were fresh with brown spots and wrinkles and foolishly let them charge me $2 for this! Are you kidding me?', 1020, 7);
INSERT INTO Review (rating, product_id, user_id) VALUES (4, 1021, 7);

INSERT INTO Review (rating, product_id, user_id) VALUES (1.5, 1022, 7);
INSERT INTO Review (rating, product_id, user_id) VALUES (4, 1023, 7);
INSERT INTO Review (rating, comments, product_id, user_id) VALUES (2.5, 'I am highly dissapointed that many information was not presented in the item description. I am now terrified to eat them!', 1024, 7);

--Image Table--
INSERT INTO Image (image_name, product_id) VALUES ('pizza1', 1000);
INSERT INTO Image (image_name, product_id) VALUES ('pizza2', 1000);
INSERT INTO Image (image_name, product_id) VALUES ('pizza3', 1000);

INSERT INTO Image (image_name, product_id) VALUES ('piccata1', 1001);
INSERT INTO Image (image_name, product_id) VALUES ('piccata2', 1001);
INSERT INTO Image (image_name, product_id) VALUES ('piccata3', 1001);

INSERT INTO Image (image_name, product_id) VALUES ('salad1', 1002);
INSERT INTO Image (image_name, product_id) VALUES ('salad2', 1002);
INSERT INTO Image (image_name, product_id) VALUES ('salad3', 1002);

INSERT INTO Image (image_name, product_id) VALUES ('burger1', 1003);
INSERT INTO Image (image_name, product_id) VALUES ('burger2', 1003);
INSERT INTO Image (image_name, product_id) VALUES ('burger3', 1003);

INSERT INTO Image (image_name, product_id) VALUES ('ribs1', 1004);
INSERT INTO Image (image_name, product_id) VALUES ('ribs2', 1004);
INSERT INTO Image (image_name, product_id) VALUES ('ribs3', 1004);

INSERT INTO Image (image_name, product_id) VALUES ('chicken1', 1005);
INSERT INTO Image (image_name, product_id) VALUES ('chicken2', 1005);
INSERT INTO Image (image_name, product_id) VALUES ('chicken3', 1005);

INSERT INTO Image (image_name, product_id) VALUES ('brisket1', 1006);
INSERT INTO Image (image_name, product_id) VALUES ('brisket2', 1006);
INSERT INTO Image (image_name, product_id) VALUES ('brisket3', 1006);

INSERT INTO Image (image_name, product_id) VALUES ('loin1', 1007);
INSERT INTO Image (image_name, product_id) VALUES ('loin2', 1007);
INSERT INTO Image (image_name, product_id) VALUES ('loin3', 1007);

INSERT INTO Image (image_name, product_id) VALUES ('bread1', 1008);
INSERT INTO Image (image_name, product_id) VALUES ('bread2', 1008);
INSERT INTO Image (image_name, product_id) VALUES ('bread3', 1008);

INSERT INTO Image (image_name, product_id) VALUES ('snowball1', 1009);
INSERT INTO Image (image_name, product_id) VALUES ('snowball2', 1009);
INSERT INTO Image (image_name, product_id) VALUES ('snowball3', 1009);

INSERT INTO Image (image_name, product_id) VALUES ('cookie1', 1010);
INSERT INTO Image (image_name, product_id) VALUES ('cookie2', 1010);
INSERT INTO Image (image_name, product_id) VALUES ('cookie3', 1010);

INSERT INTO Image (image_name, product_id) VALUES ('cake1', 1011);
INSERT INTO Image (image_name, product_id) VALUES ('cake2', 1011);
INSERT INTO Image (image_name, product_id) VALUES ('cake3', 1011);

INSERT INTO Image (image_name, product_id) VALUES ('lobster1', 1012);
INSERT INTO Image (image_name, product_id) VALUES ('lobster2', 1012);
INSERT INTO Image (image_name, product_id) VALUES ('lobster3', 1012);

INSERT INTO Image (image_name, product_id) VALUES ('salmon1', 1013);
INSERT INTO Image (image_name, product_id) VALUES ('salmon2', 1013);
INSERT INTO Image (image_name, product_id) VALUES ('salmon3', 1013);

INSERT INTO Image (image_name, product_id) VALUES ('oyster1', 1014);
INSERT INTO Image (image_name, product_id) VALUES ('oyster2', 1014);
INSERT INTO Image (image_name, product_id) VALUES ('oyster3', 1014);

INSERT INTO Image (image_name, product_id) VALUES ('trout1', 1015);
INSERT INTO Image (image_name, product_id) VALUES ('trout2', 1015);
INSERT INTO Image (image_name, product_id) VALUES ('trout3', 1015);

INSERT INTO Image (image_name, product_id) VALUES ('squid1', 1016);
INSERT INTO Image (image_name, product_id) VALUES ('squid2', 1016);
INSERT INTO Image (image_name, product_id) VALUES ('squid3', 1016);

INSERT INTO Image (image_name, product_id) VALUES ('crab1', 1017);
INSERT INTO Image (image_name, product_id) VALUES ('crab2', 1017);
INSERT INTO Image (image_name, product_id) VALUES ('crab3', 1017);

INSERT INTO Image (image_name, product_id) VALUES ('broccoli1', 1018);
INSERT INTO Image (image_name, product_id) VALUES ('broccoli2', 1018);
INSERT INTO Image (image_name, product_id) VALUES ('broccoli3', 1018);

INSERT INTO Image (image_name, product_id) VALUES ('onions1', 1019);
INSERT INTO Image (image_name, product_id) VALUES ('onions2', 1019);
INSERT INTO Image (image_name, product_id) VALUES ('onions3', 1019);

INSERT INTO Image (image_name, product_id) VALUES ('pepper1', 1020);
INSERT INTO Image (image_name, product_id) VALUES ('pepper2', 1020);
INSERT INTO Image (image_name, product_id) VALUES ('pepper3', 1020);

INSERT INTO Image (image_name, product_id) VALUES ('cucumber1', 1021);
INSERT INTO Image (image_name, product_id) VALUES ('cucumber2', 1021);
INSERT INTO Image (image_name, product_id) VALUES ('cucumber3', 1021);

INSERT INTO Image (image_name, product_id) VALUES ('mango1', 1022);
INSERT INTO Image (image_name, product_id) VALUES ('mango2', 1022);
INSERT INTO Image (image_name, product_id) VALUES ('mango3', 1022);

INSERT INTO Image (image_name, product_id) VALUES ('strawberry1', 1023);
INSERT INTO Image (image_name, product_id) VALUES ('strawberry2', 1023);
INSERT INTO Image (image_name, product_id) VALUES ('strawberry3', 1023);

INSERT INTO Image (image_name, product_id) VALUES ('berries1', 1024);
INSERT INTO Image (image_name, product_id) VALUES ('berries2', 1024);
INSERT INTO Image (image_name, product_id) VALUES ('berries3', 1024);

INSERT INTO Image (image_name, product_id) VALUES ('avocado1', 1025);
INSERT INTO Image (image_name, product_id) VALUES ('avocado2', 1025);
INSERT INTO Image (image_name, product_id) VALUES ('avocado3', 1025);

--Cart Product Table--
INSERT INTO Cart_Product (quantity, wishlist, product_id, cart_id) VALUES (10, 'False', 1021, 1);
INSERT INTO Cart_Product (quantity, wishlist, product_id, cart_id) VALUES (20, 'False', 1006, 1);
INSERT INTO Cart_Product (quantity, wishlist, product_id, cart_id) VALUES (1, 'True', 1001, 1);

--Slot Table--
INSERT INTO Slot (slot_day, slot_time, total_orders) VALUES ('06/10/2021', '10am - 1pm', 3);
INSERT INTO Slot (slot_day, slot_time, total_orders) VALUES ('07/01/2021', '1pm - 4pm', 2);
INSERT INTO Slot (slot_day, slot_time, total_orders) VALUES ('07/02/2021', '10am - 1pm', 2);
INSERT INTO Slot (slot_day, slot_time, total_orders) VALUES ('07/02/2021', '4pm - 7pm', 1);

--Orders Table--
INSERT INTO Orders (total_quantity, total_price, cart_id, slot_id, status) VALUES (3, 5.99, 1, 1, 'Purchased');
INSERT INTO Orders (total_quantity, total_price, cart_id, slot_id, status) VALUES (2, 11.99, 1, 1, 'Purchased');
INSERT INTO Orders (total_quantity, total_price, cart_id, slot_id, status) VALUES (1, 15.99, 1, 1, 'Purchased');
INSERT INTO Orders (total_quantity, total_price, cart_id, slot_id, status) VALUES (2, 3.99, 1, 2, 'Purchased');
INSERT INTO Orders (total_quantity, total_price, cart_id, slot_id, status) VALUES (2, 5.99, 1, 2, 'Purchased');
INSERT INTO Orders (total_quantity, total_price, cart_id, slot_id, status) VALUES (1, 99.99, 1, 3, 'Purchased');
INSERT INTO Orders (total_quantity, total_price, cart_id, slot_id, status) VALUES (1, 35.99, 1, 3, 'Purchased');
INSERT INTO Orders (total_quantity, total_price, cart_id, slot_id, status) VALUES (1, 0.99, 1, 4, 'Purchased');

--Order Product Table--
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (20, 1, 1002);
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (10, 1, 1004);
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (5, 1, 1012);
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (7, 2, 1013);
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (13, 2, 1018);
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (20, 3, 1021);
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (12, 4, 1022);
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (1, 4, 1008);
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (2, 5, 1006);
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (16, 5, 1021);
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (9, 6, 1005);
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (20, 7, 1024);
INSERT INTO Order_Product (order_quantity, order_id, product_id) VALUES (12, 8, 1003);

--Payment Table--
INSERT INTO Payment (payment_amount, payment_date, order_id, user_id) VALUES (5.99, '06/10/2021', 1, 7);
INSERT INTO Payment (payment_amount, payment_date, order_id, user_id) VALUES (11.99, '06/10/2021', 2, 7);
INSERT INTO Payment (payment_amount, payment_date, order_id, user_id) VALUES (15.99, '06/10/2021', 3, 7);
INSERT INTO Payment (payment_amount, payment_date, order_id, user_id) VALUES (3.99, '07/01/2021', 4, 7);
INSERT INTO Payment (payment_amount, payment_date, order_id, user_id) VALUES (5.99, '07/01/2021', 5, 7);
INSERT INTO Payment (payment_amount, payment_date, order_id, user_id) VALUES (99.99, '07/02/2021', 6, 7);
INSERT INTO Payment (payment_amount, payment_date, order_id, user_id) VALUES (35.99, '07/02/2021', 7, 7);
INSERT INTO Payment (payment_amount, payment_date, order_id, user_id) VALUES (0.99, '07/02/2021', 8, 7);

