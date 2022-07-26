<?php
// connecting to database, buttons and php-mailer
require_once ("db_connection.php");
require_once ("components.php");
require_once("php-mailer.php");

//making connection to the database
$conn = openCon();

// Create button Click
if(isset($_POST['create'])) {
    //making variables of the checked input
    $firstname = htmlspecialchars($_POST['firstname']);
    $firstname = mysqli_escape_string($conn, trim($firstname));
    $lastname = htmlspecialchars($_POST['lastname']);
    $lastname = mysqli_real_escape_string($conn, trim($lastname));
    $email = htmlspecialchars($_POST['email']);
    $email = mysqli_real_escape_string($conn, trim($email));
    $phone = htmlspecialchars($_POST['phone']);
    $phone = mysqli_real_escape_string($conn, trim($phone));
    $adress = htmlspecialchars($_POST['adress']);
    $adress = mysqli_real_escape_string($conn, trim($adress));
    $zipcode = htmlspecialchars($_POST['zipcode']);
    $zipcode = mysqli_real_escape_string($conn, trim($zipcode));
    $state = htmlspecialchars($_POST['state']);
    $state = mysqli_real_escape_string($conn, trim($state));
    $city = htmlspecialchars($_POST['city']);
    $city = mysqli_real_escape_string($conn, trim($city));
    $products = htmlspecialchars($_POST['products']);
    $products = mysqli_real_escape_string($conn, trim($products));
    $date = htmlspecialchars($_POST['date']);
    $date = mysqli_real_escape_string($conn, trim($date));
    $time = htmlspecialchars($_POST['time']);
    $time = mysqli_real_escape_string($conn, trim($time));

    //Require the form validation handling
//    require_once "Includes/form-validation.php";
    if (empty($errors)) {
        //Save the record to the database
        $sql = "INSERT INTO contact(firstname, lastname, email, phone, adress, zipcode, city, state, products, date, time)
        VALUES('$firstname', '$lastname', '$email', '$phone', '$adress', '$zipcode', '$city', '$state', '$products', '$date', '$time')";
        $result = mysqli_query($conn, $sql)
        or die ('Error: ' . $sql);
        // if reservation is successful
        if ($result) {
            sentMail();
            TextNode("succes", "Afpraak is goed toegevoegd!");
        // if there is an errors by making the reservation
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($conn);
        }
    }
}
// updating when button update is pressed
if(isset($_POST['update'])){
    updateData();
}
// deleting when button update is pressed
if(isset($_POST['delete'])){
    deleteRecord();
}

//checking textbox value and mysql injections
function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

//message
function TextNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

//update data
function updateData(){
    $id = textboxValue("id");
    $firstname = textboxValue("firstname");
    $lastname = textboxValue("lastname");
    $email = textboxValue("email");
    $phone = textboxValue("phone");
    $adress = textboxValue("adress");
    $zipcode = textboxValue("zipcode");
    $city = textboxValue("city");
    $state = textboxValue("state");
    $products = textboxValue("products");
    $date = textboxValue("date");
    $time = textboxValue("time");
    if ($firstname&&$lastname&&$email&&$phone&&$adress&&$zipcode&&$city&&$state&&$products&&$date&&$time) {
        $sql = "UPDATE contact SET firstname='$firstname', lastname='$lastname', email='$email', phone='$phone', adress='$adress',  zipcode='$zipcode', city='$city', state='$state', products='$products', date='$date', time='$time'
               WHERE id=$id";
        if (mysqli_query($GLOBALS['conn'], $sql)) {
            TextNode("succes", "Afpraak is aangepast!");
        } else {
            echo "Error bij het aanpassen van de afspraak";
        }
    }else{
        TextNode("error", "Voer alle gegevens in");
    }
}

function deleteRecord(){
    $id = (int)textboxValue("id");
    $sql = "DELETE FROM contact WHERE id=$id";
    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("succes", "Record Deleted Successfully!");
    }else{
        TextNode("error", "Enable to Deleted Record!");
    }
}
