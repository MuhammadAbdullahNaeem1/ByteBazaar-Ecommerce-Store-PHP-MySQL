# ByteBazaar-Ecommerce-Store-PHP-MySQL
An E-Commerce Store selling Computer parts and accessories built with proper implementation of MySQL as a database and PHP as the back-end language as well as Javascript.


https://github.com/MuhammadAbdullahNaeem1/ByteBazaar-Ecommerce-Store-PHP-MySQL/assets/105659099/1ed4926f-6e40-4b90-9ed5-3e3fd7e21262



# Introduction

The project we propose is an e-commerce website that sells computer parts to computer enthusiasts and people. The website offers countless products like computer parts, including peripherals and components from computing industry's top brands. We are making our website quite easy to use. And we are making sure that our customer experience is up to the mark. 

# Objectives

The goal of our project is to create a successful online platform for selling computer parts, providing computer enthusiasts and geeks with a convenient and efficient shopping experience. We are providing the best prices against the best products you can find in the market. We are looking forward to providing the best customer experience and providing easy access to the products related to computer. Also, we provide a convenient communication between the buyer and the seller. 

# Functionalities

# 1.Manage Account (Customers/Admin)
Customers can create, delete and update their accounts to track their purchase and to place orders as a customer or add products as an administrator.

# 2.Product Catalog: 
A module that allows users to browse and search through a list of available computer parts, including processors, motherboards, graphics cards, and more. The catalog should allow users to filter by product type and search by name description or brand.
# 3.Product Details: 
A module that provides users with detailed information about each product, including specifications, features, images, and reviews from other customers and add item to their cart for purchase.
# 4.Shopping Cart:
 A module that enables users to add products to their cart and review their selections before proceeding to checkout. This module should display the total cost of the order, including any applicable taxes and shipping fees.
# 5.Checkout: 
A module that guides users through the process of completing their purchase, including entering billing and shipping information, selecting a payment method, and reviewing their order one last time before submitting it.
# 6.Shipping and Delivery
A shipping and delivery system that allows customers to choose their preferred shipping method, track their orders.
# 7.Reviews and Ratings: 
A module that allows users to rate and review products they have purchased, as well as read reviews from other customers. This module should help users make informed purchasing decisions based on the experiences of others.

# 8.Order Management: 
A module that allows website administrators to manage orders and track their status, including reviewing new orders, updating order status, and managing order fulfillment and shipping.

# 9.Inventory Management: 
A module that helps website administrators keep track of their inventory levels and product availability. 
# 10.Wish List: 
A module that enables users to create a wish list of products they are interested in but not ready to purchase yet. This module should allow users to save items for future reference.


Attributes:
aid, afname, alname, phone, email, cnic, DOB, username, password, gender, oid, dateordered, datedelivered, address, city, country, accountno, totalcost, pid, pname, category, description, price, quantityavailable, img, brand, rtext, rating, cquantity, orderquantity




# Functional Dependencies:
aid-> (aid, afname, alname, phone, email, cnic, DOB, username, password, gender) 
pid-> (pid, pname, category, description, price, quantityavailable, img, brand) 
oid-> (oid, dateordered, datedelivered, address, city, country, accountno,totalcost) 
oid, pid-> (cquantity, orderquantity, rtext, rating) 


# Tables
1-Accounts

AID	Afname	Alname	Phone	Email	Cnic	DOB	Username	Password	Gender


2-Products

pid	Pname	Category	Description	Price	Quantityavailable	Img	brand

3-Orders

OID	DateOrdered	DateDelivered	Aid	account	address	country	city	total


4-Order_Details

Oid	Pid	quantity


5-Cart

pid	aid	cquantity


6-Reviews

Pid	Oid	rtext	rating


7-Wishlist

pid	oid


               
