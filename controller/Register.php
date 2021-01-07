<?php

//Setting up the session
session_start();

//Including the database connection
include_once '../model/DbConnect.php';
//Creating an instance of the database
$db = new DbConnect();
//Making a connection to the database.
$conn = $db->OpenCon();

//Holding the data to be sent to the database from the post of the form.
$email = "";
$phoneNumber = "";
$password = "";
$username = "";

//Getting the users data.
if (isset($_POST['add'])) {

    $email = $_POST["emailAdd"];
    $phoneNumber = $_POST["phoneNumber"];
    $password = $_POST["pwd"];
    $username = $_POST["username"];
    //Hashing the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //Storing the users input to the database using prepared statement.
    $query = "INSERT INTO ad_user(phone,email,password_hash,username)VALUES(?,?,?,?)";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("ssss",  $phoneNumber, $email, $hashed_password, $username);

    $stmt->execute();

    //alert on homepage using a session

    header('location:../view/index.php');

    $_SESSION['response'] = "Account Created Successfully! Log In...";

    $_SESSION['res_type'] = "success";


    //Closing the connection
    $db->CloseCon($conn);
}