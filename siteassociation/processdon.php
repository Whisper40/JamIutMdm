<?php

require_once('includes/connectBDD.php');

$name=str_replace("'"," ",$_POST['name']);
$street=str_replace("'"," ",$_POST['street']);
$city=str_replace("'"," ",$_POST['city']);
$country_code = $_POST['country_code'];
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.utf8','fra');
$date = strftime('%d/%m/%Y %H:%M:%S');
$datesystem = strftime('%Y-%m-%d');

$transaction_id = $_POST['transaction_id'];
$price = $_POST['price'];
$currency_code = $_POST['currency_code'];
$raison = 'Donation';
$user_id = $_SESSION['user_id'];
if(empty($user_id)){
  $user_id = '0';
}

$db->query("INSERT INTO transactions (name, street, city, country, date, datesystem, transaction_id, amount, currency_code, user_id, raison) VALUES('$name', '$street', '$city', '$country_code', '$date', '$datesystem', '$transaction_id', '$price', '$currency_code', '$user_id' ,'$raison')");

$nomdonneur = $_SESSION['nomdonneur'];
$adressepostale = $_SESSION['adressepostale'];
$email = $_SESSION['emaildonneur'];
$nomdonneurfinal = str_replace("'"," ",$nomdonneur);
$adressepostalefinal = str_replace("'"," ",$adressepostale);
$emaildonneurfinal = str_replace("'"," ",$email);
if(!empty($nomdonneur) && (!empty($adressepostale)) && (!empty($emaildonneurfinal))){
$db->query("INSERT INTO transactions (name, street, city, country, date, datesystem, transaction_id, amount, currency_code, user_id, raison) VALUES('$name', '$street', '$city', '$country_code', '$date', '$datesystem', '$transaction_id', '$price', '$currency_code', '$user_id' ,'$raison')");
}

unset($_SESSION['nomdonneur']);
unset($_SESSION['adressepostale']);
unset($_SESSION['emaildonneur']);
