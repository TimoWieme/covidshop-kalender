<?php
session_start();
require_once 'Includes/db_connection.php'; //connecting the db_connection to this file
require_once 'Includes/operation.php'; //connection to the operation file to connect to db_connection and components
$conn = openCon();

if(isset($_GET['date'])){
    $date = $_GET['date'];
}

//if (isset($_POST['submit'])) {
//    $firstname = $_POST['firstname'];
//    $lastname = $_POST['lastname'];
//    $email = $_POST['email'];
//    $phone = $_POST['phone'];
//    $adress = $_POST['adress'];
//    $zipcode = $_POST['zipcode'];
//    $city = $_POST['city'];
//    $state = $_POST['state'];
//    $products = $_POST['products'];
//    $date = $_POST['date'];
//    $time = $_POST['time'];
//    $sql = "INSERT INTO contact(firstname, lastname, email, phone, adress, zipcode, city, state, products, date, time)
//            VALUES('$firstname', '$lastname', '$email', '$phone', '$adress', '$zipcode', '$city', '$state', '$products', '$date', '$time')";
//    if (mysqli_query($conn, $sql)) {
//        echo "Records added successfully";
//    } else {
//        echo "Error, could not execute" . mysqli_error($conn);
//    }
//    closeCon($conn); //close connection
//}

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Reservering</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Styles/style2.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="Includes/main.js"></script>
    </head>
    <body>
    <div class="topnav">
        <img src="Media/logocovid.png">
        <a href="index.php">Home</a>
        <a href="calendar.php">Kalender</a>
        <?php if (isset($_SESSION['login'])) { ?>
            <a href="contacts.php">Overzicht van alle afspraken</a>
            <a href="logout.php">Logout</a>
        <?php }else ?>


    <div class="jumbotron text-center">
    <div class="container">
        <h2 class="text-center">Reserveer voor datum: <?php echo date('d F, Y', strtotime($date));?></h2>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php echo isset($msg)?$msg:''; ?>
                <form action="" method="post" class="w-50">
                    <div>
                        <!-- Using the Function inputElements out of thecomponents.php file for the form inputs -->
                        <div class="form-group">
                            <input class="form-control" id="firstname" type="text" name="firstname" placeholder="Voornaam" aria-label="First Name" value="<?= isset($firstname) ? htmlentities($firstname) : '' ?>"/>
                            <span class="errors"><?= isset($errors['firstname']) ? $errors['firstname'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="lastname" type="text" name="lastname" placeholder="Achternaam" aria-label="Last Name" value="<?= isset($lastname) ? htmlentities($lastname) : '' ?>"/>
                            <span class="errors"><?= isset($errors['lastname']) ? $errors['lastname'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="email" type="text" name="email" placeholder="Email" aria-label="Email" value="<?= isset($email) ? htmlentities($email) : '' ?>"/>
                            <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="phone" type="varchar" name="phone" placeholder="Telefoonummer" aria-label="phone" value="<?= isset($phone) ? htmlentities($phone) : '' ?>"/>
                            <span class="errors"><?= isset($errors['phone']) ? $errors['phone'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="adress" type="varchar" name="adress" placeholder="Adres" aria-label="adress" value="<?= isset($adress) ? htmlentities($adress) : '' ?>"/>
                            <span class="errors"><?= isset($errors['adress']) ? $errors['adress'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="city" type="text" name="city" placeholder="Plaats" aria-label="City" value="<?= isset($city) ? htmlentities($city) : '' ?>"/>
                            <span class="errors"><?= isset($errors['city']) ? $errors['city'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="zipcode" type="text" name="zipcode" placeholder="Postcode" aria-label="zipcode" value="<?= isset($zipcode) ? htmlentities($zipcode) : '' ?>"/>
                            <span class="errors"><?= isset($errors['zipcode']) ? $errors['zipcode'] : '' ?></span>
                        </div>
                        <!-- Making the dropdown menu for the states in the Netherlands -->
                        <div class="form-group-state">
                            <select id="state" class="form-select" placeholder="Provincie"  name="state" aria-label="zipcode">
                                <option selected disabled>Provincie...</option>
                                <option value="Drenthe <?= isset($zipcode) ? htmlentities($zipcode) : '' ?>">Drenthe </option>
                                <option value="Flevoland <?= isset($zipcode) ? htmlentities($zipcode) : '' ?>">Flevoland</option>
                                <option value="Friesland <?= isset($zipcode) ? htmlentities($zipcode) : '' ?>">Friesland</option>
                                <option value="Gelderland <?= isset($zipcode) ? htmlentities($zipcode) : '' ?>">Gelderland</option>
                                <option value="Groningen <?= isset($zipcode) ? htmlentities($zipcode) : '' ?>">Groningen</option>
                                <option value="Limburg <?= isset($zipcode) ? htmlentities($zipcode) : '' ?>">Limburg</option>
                                <option value="Noord-Brabant <?= isset($zipcode) ? htmlentities($zipcode) : '' ?>">Noord-Brabant</option>
                                <option value="Noord-Holland <?= isset($zipcode) ? htmlentities($zipcode) : '' ?>">Noord-Holland</option>
                                <option value="Overijssel <?= isset($zipcode) ? htmlentities($zipcode) : '' ?>">Overijssel</option>
                                <option value="Utrecht <?= isset($zipcode) ? htmlentities($zipcode) : '' ?>">Utrecht</option>
                                <option value="Zeeland <?= isset($zipcode) ? htmlentities($zipcode) : '' ?>">Zeeland</option>
                                <option value="Zuid-Holland<?= isset($zipcode) ? htmlentities($zipcode) : '' ?>">Zuid-Holland</option>
                            </select>
                            <span class="errors"><?= isset($errors['state']) ? $errors['state'] : '' ?></span>
                        </div>
                        <!-- setting up the cell for how many products -->
                        <div class="form-group">
                            <input class="form-control" min="0" id="products" type="number" name="products" placeholder="Testen" aria-label="Products" value="<?= isset($products) ? htmlentities($products) : '' ?>"/>
                            <span class="errors"><?= isset($errors['products']) ? $errors['products'] : '' ?></span>
                        </div>
                        <!-- setting up the cell for the date -->
                        <div class="form-group">
                            <input class="form-control" min="0" id="date" type="date" name="date" placeholder="Datum" aria-label="Date" readonly value="<?= isset($date) ? htmlentities($date) : '' ?>"/>
                            <span class="errors"><?= isset($errors['date']) ? $errors['date'] : '' ?></span>
                        </div>
                        <!-- setting up the cell for the time -->
                        <div class="form-group">
                            <input class="form-control" min="09:00" max="17:30" id="time" type="time" name="time" placeholder="Tijd" aria-label="Time" value="<?= isset($time) ? htmlentities($time) : '' ?>"/>
                            <span class="errors"><?= isset($errors['time']) ? $errors['time'] : '' ?></span>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" name="create" id="bookSubmit"> Verzenden</button>
                </form>
            </div>

        </div>


    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3><a href="calendar.php"> Terug naar de kalender</a></h3>
            </div>

        </div>
    </div>

        <script src="Includes/script.js"></script>

    </body>
    </html>
