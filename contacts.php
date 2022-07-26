<?php
session_start();
require_once 'Includes/operation.php'; //connection to the operation file to connect to db_connection and components
/* @var $conn // making the variabel known  */

// making this pages is only for login users
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
}

//Get the result set from the database with a SQL query
$result = mysqli_query($conn, "SELECT * FROM contact")
or die(mysqli_error());

//Loop through the result to create a custom array
$contact=[];
while($row = mysqli_fetch_assoc($result)){
    $contact[] =
        [
            'id' => $row['id'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'adress' => $row['adress'],
            'zipcode' => $row['zipcode'],
            'city' => $row['city'],
            'state' => $row['state'],
            'products' => $row['products'],
            'date' => $row['date'],
            'time' => $row['time']
            ];
}

//Close connection
$conn->close();
?>
<!doctype html>
<html>
<head>
<!--    Connect to bootstrap font awesome and style.css for the looks -->
    <script src="https://kit.fontawesome.com/587a279f36.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <link href = 'Styles/style.css' type = "text/css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="Plugins/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="Plugins/datatables/responsive.bootstrap4.min.css">
    <script type="text/javascript" src="Plugins/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="Plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="Plugins/datatables/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="Plugins/datatables/responsive.bootstrap4.min.js"></script>
</head>
<body>
<main>
    <div>
            <!--Nav Bar-->
            <div class="topnav">
                <img src="Media/logocovid.png">
                <a href="index.php">Home</a>
                <a href="calendar.php">Kalender</a>
                <?php if (isset($_SESSION['login'])) { ?>
                    <a href="contacts.php">Overzicht van alle afspraken</a>
                    <a href="logout.php">Logout</a>
                <?php }else { ?>
                    <!-- Code for login button which is a pop-up form   -->

                    <button class="open-button" onclick="openForm()">Login</button>

                    <div class="form-popup" id="myForm">
                        <form action="login.php" method="post" class="form-container">
                            <h1>Login</h1>
                            <div>
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username">
                            </div>
                            <div>
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password">
                            </div>
                            <div>
                                <button type="submit" name ="submit" class="btn">Login</button>
                                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        <!-- Making the form -->
        <div class="container">
            <!-- title of the Form -->
            <h1 class="py-4 text-center"><i class="far fa-calendar-check"></i> Afspraken Toevoegen</h1>
            <div class="d-flex justify-content-center">
                <form action="" method="post" class="w-50">
                    <div class="row g-2">
                        <div class=col-md-2">
                            <input type="text" class="form-control" name="id" placeholder="Id Nummer (Automatiche ingevuld)" aria-label="id" min="0" readonly="true">
                        </div>
                        <!-- Using the Function inputElements out of thecomponents.php file for the form inputs -->
                        <div class="data-field col-md-6">
                            <input class="form-control" id="firstname" type="text" name="firstname" placeholder="Voornaam" aria-label="First Name" value="<?= isset($firstname) ? htmlentities($firstname) : '' ?>"/>
                            <span class="errors"><?= isset($errors['firstname']) ? $errors['firstname'] : '' ?></span>
                        </div>
                        <div class="data-field col-md-6">
                            <input class="form-control" id="lastname" type="text" name="lastname" placeholder="Achternaam" aria-label="Last Name" value="<?= isset($lastname) ? htmlentities($lastname) : '' ?>"/>
                            <span class="errors"><?= isset($errors['lastname']) ? $errors['lastname'] : '' ?></span>
                        </div>
                        <div class="data-field col-md-12">
                            <input class="form-control" id="email" type="text" name="email" placeholder="Email" aria-label="Email" value="<?= isset($email) ? htmlentities($email) : '' ?>"/>
                            <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                        </div>
                        <div class="data-field col-md-12">
                            <input class="form-control" id="phone" type="varchar" name="phone" placeholder="Telefoonummer" aria-label="phone" value="<?= isset($phone) ? htmlentities($phone) : '' ?>"/>
                            <span class="errors"><?= isset($errors['phone']) ? $errors['phone'] : '' ?></span>
                        </div>
                        <div class="data-field col-md-12">
                            <input class="form-control" id="adress" type="varchar" name="adress" placeholder="Adres" aria-label="adress" value="<?= isset($adress) ? htmlentities($adress) : '' ?>"/>
                            <span class="errors"><?= isset($errors['adress']) ? $errors['adress'] : '' ?></span>
                        </div>
                        <div class="data-field col-md-7">
                            <input class="form-control" id="city" type="text" name="city" placeholder="Plaats" aria-label="City" value="<?= isset($city) ? htmlentities($city) : '' ?>"/>
                            <span class="errors"><?= isset($errors['city']) ? $errors['city'] : '' ?></span>
                        </div>
                        <div class="data-field col-md-5">
                            <input class="form-control" id="zipcode" type="text" name="zipcode" placeholder="Postcode" aria-label="zipcode" value="<?= isset($zipcode) ? htmlentities($zipcode) : '' ?>"/>
                            <span class="errors"><?= isset($errors['zipcode']) ? $errors['zipcode'] : '' ?></span>
                        </div>
                        <!-- Making the dropdown menu for the states in the Netherlands -->
                        <div class=" data-field col-md-7">
                            <select id="state" class="form-select" name="state" aria-label="zipcode">
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
                        <div class="data-field col-md-5">
                            <input class="form-control" min="0" id="products" type="number" name="products" placeholder="Testen" aria-label="Products" value="<?= isset($products) ? htmlentities($products) : '' ?>"/>
                            <span class="errors"><?= isset($errors['products']) ? $errors['products'] : '' ?></span>
                        </div>
                        <!-- setting up the cell for the date -->
                        <div class="data-field col-md-7">
                            <input class="form-control" min="0" id="date" type="date" name="date" placeholder="Datum" aria-label="Date" value="<?= isset($date) ? htmlentities($date) : '' ?>"/>
                            <span class="errors"><?= isset($errors['date']) ? $errors['date'] : '' ?></span>
                        </div>
                        <!-- setting up the cell for the time -->
                        <div class="data-field col-md-5">
                            <input class="form-control" min="0" id="time" type="time" name="time" placeholder="Tijd" aria-label="Time" value="<?= isset($time) ? htmlentities($time) : '' ?>"/>
                            <span class="errors"><?= isset($errors['time']) ? $errors['time'] : '' ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <!-- setting up the buttons to create, read, update and delete -->
                        <div class="d-flex justify-content-center">
                            <button name="create" 'dat-toggle="tooltip" data-placement="buttom" title="Toevoegen" '="" class="btn btn-success" id="btn-create"><i class="fas fa-plus" aria-hidden="true"></i></button>
                            <button name="read" 'dat-toggle="tooltip" data-placement="buttom" title="Verversen" '="" class="btn btn-primary" id="btn-read"><i class="fas fa-sync" aria-hidden="true"></i></button>
                            <button name="update" 'dat-toggle="tooltip" data-placement="buttom" title="Updaten" '="" class="btn btn-light border" id="btn-update"><i class="fas fa-pen-alt" aria-hidden="true"></i></button>
                            <button name="delete" 'dat-toggle="tooltip" data-placement="buttom" title="Verwijderen" '="" class="btn btn-danger" id="btn-delete"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
<!--                        buttonElement("btn-create", "btn btn-success", "<i class='fas fa-plus'></i>", "create", "dat-toggle='tooltip' data-placement='buttom' title='Toevoegen'");-->
<!--                        buttonElement("btn-read", "btn btn-primary", "<i class='fas fa-sync'></i>", "read", "dat-toggle='tooltip' data-placement='buttom' title='Verversen'");-->
<!--                        buttonElement("btn-update", "btn btn-light border", "<i class='fas fa-pen-alt'></i>", "update", "dat-toggle='tooltip' data-placement='buttom' title='Updaten'");-->
<!--                        buttonElement("btn-delete", "btn btn-danger", "<i class='fas fa-trash-alt'></i>", "delete", "dat-toggle='tooltip' data-placement='buttom' title='Verwijderen'");-->
                    </div>
                </form>
            </div>
        </div>
            <!-- Bootstrap table -->
            <div class="card-body">
                <table id="appointments" class="table dataTable table-striped table-light" width="100%">
                    <thead>
                        <tr>
                            <th colspan="14">Contact Informatie</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Voornaam</th>
                            <th>Achternaam</th>
                            <th>Email</th>
                            <th>Telefoon nummer</th>
                            <th>adres</th>
                            <th>Postcode</th>
                            <th>Plaats</th>
                            <th>Provincie</th>
                            <th>Hoeveel Producten</th>
                            <th>Datum</th>
                            <th>Tijd</th>
                            <th>Aanpassen</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contact as $index => $costumers) { ?>
                            <tr>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['id'] ?></td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['firstname'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['lastname'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['email'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['phone'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['adress'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['zipcode'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['city'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['state'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['products'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['date'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['time'] ?> </td>
                                <td><i class="fas fa-edit btnedit" id="edit"></i></td>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>
<script src="Includes/main.js"></script>
</body>
</html>
</body>
</html>
