<?php
//Including the database connection
include_once '../model/DbConnect.php';
//Creating an instance of the database
$db = new DbConnect();
//Making a connection to the database.
$conn = $db->OpenCon();

//Querying the categories
$sql = "SELECT cat_id, cat_name, icon, picture FROM ad_catagory_main";
$category = $conn->query($sql);


//if ($category->num_rows > 0) {
//    // output data of each row
//    while($row = $category->fetch_assoc()) {
//        echo "id: " . $row["cat_id"]. " - Name: " . $row["cat_name"]. " " . $row["icon"]. " - Picture: " . $row["picture"]. "<br>";
//    }
//} else {
//    echo "0 results";
//}

//Closing the connection.
$db->CloseCon($conn);