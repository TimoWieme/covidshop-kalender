<?php
error_reporting(0);
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'Plugins/PHPMailer/src/Exception.php';
require 'Plugins/PHPMailer/src/PHPMailer.php';
require 'Plugins/PHPMailer/src/SMTP.php';

function sentMail(){
        //making variables of the checked input
        $firstname  = mysqli_escape_string($GLOBALS['conn'], $_POST['firstname']);
        $lastname   = mysqli_escape_string($GLOBALS['conn'], $_POST['lastname']);
        $email      = mysqli_escape_string($GLOBALS['conn'], $_POST['email']);
        $phone      = mysqli_escape_string($GLOBALS['conn'], $_POST['phone']);
        $adress     = mysqli_escape_string($GLOBALS['conn'], $_POST['adress']);
        $zipcode    = mysqli_escape_string($GLOBALS['conn'], $_POST['zipcode']);
        $city       = mysqli_escape_string($GLOBALS['conn'], $_POST['city']);
        $state      = mysqli_escape_string($GLOBALS['conn'], $_POST['state']);
        $products   = mysqli_escape_string($GLOBALS['conn'], $_POST['products']);
        $date       = mysqli_escape_string($GLOBALS['conn'], $_POST['date']);
        $time       = mysqli_escape_string($GLOBALS['conn'], $_POST['time']);

        echo $firstname . $lastname . $email;
        //Require the form validation handling
        require_once "Includes/form-validation.php";

        //Variables from form to variables in this file
        //    if (empty($errors)) {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            // Debug server side
            $mail->SMTPDebug = 2;
            // settings from mail server
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            // TODO Change Username and Password
            $mail->Username = 'email'; // email
            $mail->Password = 'password'; // Key

            // mail from, where to and reply email (cc and bcc can be used when removing //
            // TODO Change Email setFrom and addReplyTo
            $mail->setFrom('mailfrom');
            $mail->addAddress($email, $firstname . " " . $lastname);
            $mail->addReplyTo('replyto');
            //$mail->addCC('');
            //$mail->addBCC('');

            // Subject of the mail with the date of reservation
            // TODO Customise to your liking
            $mail->Subject = "Bevestiging Covidshop op $date";
            // Making the body of the mail
            $Body = "Geachte $firstname $lastname,\n\n";
            $Body .= "Hierbij bevestigen wij uw afspraak op $date om $time. ";
            $Body .= "Wij zullen de $products testen uitvoeren op $adress, $city in $state\n\n";

            // Using the Body for the mail
            $mail->Body = $Body;

            $mail->send();
            // redirecting back to previous page
            header("Location: http://localhost/covidshop/contacts.php", true, 301);
        } catch (Exception $exception) {
            // error message in case something went wrong
            // echo "Error:" . $mail->ErrorInfo;
        }
}