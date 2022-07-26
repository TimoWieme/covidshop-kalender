<?php
session_start();
require_once 'Includes/db_connection.php'; //connecting the db_connection to this file
$conn = openCon();

// if login is attempted this wil begin
if (isset($_POST['submit'])){
    //making a string of $username against sql injections
    $username = mysqli_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    //Get record from DB
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    // If there is a match with the username we check the password
    if (mysqli_num_rows($result) == 1){
        //we catch the result the password from the database
        $user = mysqli_fetch_assoc($result);
        // checking if the passwords matches
        if (password_verify($password, $user['password'])){
            // when it matches we save the username id and email in the session
            $_SESSION['login'] = $username;
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
        // if the password doesn't match we give a error
        } else {
            echo "Username or Password is incorrect";
        }
    // if the username doesn't match we give a error
    } else {
        echo "Username or Password is incorrect";
    }
}
// When logged in go to back to home page
if (isset($_SESSION['login'])){
    header("Location: index.php");
    exit;
}