<?php
//Including the database connection
include_once '../model/DbConnect.php';
//Creating an instance of the database
$db = new DbConnect();
//Making a connection to the database.
$conn = $db->OpenCon();

//Querying the products
$sql = "SELECT id, product_name, description, state, country, price FROM ad_product";
$products = $conn->query($sql);


//Closing the connection
$db->CloseCon($conn);
