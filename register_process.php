<?php

require_once("db_config/connect.php");
// Retrieve the submitted registration data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$user_type = isset($_POST['user_type']) ? $_POST['user_type'] : 'user';

// Validate password match
if ($password !== $confirm_password) {
    echo "Passwords do not match.";
    exit();
}

// Prepare and execute the SQL statement to insert registration data into the users table
$sql = "INSERT INTO users 
(name, email, password, user_type)
 VALUES ('$username', '$email', '$password', '$user_type')";

if ($con->query($sql) === TRUE) {
    echo "Registration successful.";
  
        // Redirect to user page 
        header("Location: login.php");
    
    
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

// Close the database connection
$con->close();
?>
