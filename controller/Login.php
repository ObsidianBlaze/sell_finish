<?php

//Setting up the session
//session_start();

//Including the database connection
include_once '../model/DbConnect.php';
//Creating an instance of the database
$db = new DbConnect();
//Making a connection to the database.
$conn = $db->OpenCon();

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

//Getting the users data.
if (isset($_POST['login'])) {


    // Check if email is empty
    if (empty(trim($_POST["emailAddress"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["emailAddress"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["pwds"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["pwds"]);
    }

    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, email, password_hash, username FROM ad_user WHERE email = ?";

        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();

                // Check if email exists, if yes then verify password
                if($stmt->num_rows == 1){
                    // Bind result variables
                    $stmt->bind_result($id, $email, $password_hash, $username);
                    if($stmt->fetch()){
                        if(password_verify($password, $password_hash)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["username"] = $username;


                            // Redirect user to welcome page
                            header('location:../view/user-dashboard.php');
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";

                            // Redirect user to welcome page with error message
                            header('location:../view/index.php');

//                            $_SESSION['response'] = "Account Created Successfully! Log In...";
//
//                            $_SESSION['res_type'] = "success";
                        }
                    }
                } else{
                    // Display an error message if email doesn't exist
                    $email_err = "No account found with that email.";

                    // Redirect user to welcome page with error message
                    header('location:../view/index.php');

//                            $_SESSION['response'] = "Account Created Successfully! Log In...";
//
//                            $_SESSION['res_type'] = "success";
                }
            } else{

                // Redirect user to welcome page with error message
                header('location:../view/index.php');

                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    //Closing the connection
    $db->CloseCon($conn);
}

// Check if the user is already logged in, if yes then redirect him to welcome page
//if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//    header("location: welcome.php");
//    exit;
//}

