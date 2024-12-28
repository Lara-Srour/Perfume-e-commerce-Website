<?php
session_start();

require_once("db_config/connect.php");

// Retrieve the submitted username and password
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare the SQL statement to retrieve user/admin data
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Authentication successful
    // Redirect to the appropriate page based on user/admin user_type
    $row = $result->fetch_assoc();
    

    if ($row['user_type'] == 'admin') {
        // Redirect to admin page
        $_SESSION['admin_info']=$row;
        $_SESSION['admin_id'] = $row['id'];
        header("Location: admin/adminProducts.php");
        exit();
    } else {
        // Redirect to user page
        $_SESSION['user_info']=$row;
        $_SESSION['user_id'] = $row['id'];
        header("Location: home.php");
        exit();
    }
} else {
    // Authentication failed
    $_SESSION['error_message'] = "Invalid email or password";
    header("Location: login.php");
}

// Close the database connection
$con->close();
?>





