<?php
//form validation
$errors =[];
if ($firstname == "") {
    $errors['firstname'] = 'Voornaam mag niet leeg zijn';
}
if ($lastname == "") {
    $errors['lastname'] = 'Achternaam mag niet leeg zijn';
}
if ($email == "") {
    $errors['email'] = 'Email mag niet leeg zijn';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format";
}
if ($phone == "") {
    $errors['phone'] = 'Telefoonnummer mag niet leeg zijn';
}
if ($adress == "") {
    $errors['adress'] = 'Adres mag niet leeg zijn';
}
if ($zipcode == "") {
    $errors['zipcode'] = 'Postcode mag niet leeg zijn';
}
if ($state == "") {
    $errors['state'] = 'Provincie mag niet leeg zijn';
}
if ($city == "") {
    $errors['city'] = 'Plaats mag niet leeg zijn';
}
if ($products == "") {
    $errors['products'] = 'Aantal testen mag niet leeg zijn';
}
if ($date == "") {
    $errors['date'] = 'Datum mag niet leeg zijn';
}
if ($time == "") {
    $errors['time'] = 'Tijd mag niet leeg zijn';
}
