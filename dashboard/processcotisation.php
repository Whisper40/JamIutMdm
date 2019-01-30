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
$user_id = $_SESSION['user_id'];
$raison = 'Cotisation Annuelle';

$inserttransac = $db->prepare("INSERT INTO transactions (name, street, city, country, date, datesystem, transaction_id, amount, currency_code, user_id, raison) VALUES(:name, :street, :city, :country_code, :date, :datesystem, :transaction_id, :price, :currency_code, :user_id , :raison)");
$inserttransac->execute(array(
    "name"=>$name,
    "street"=>$street,
    "city"=>$city,
    "country_code"=>$country_code,
    "date"=>$date,
    "datesystem"=>$datesystem,
    "transaction_id"=>$transaction_id,
    "price"=>$price,
    "currency_code"=>$currency_code,
    "user_id"=>$user_id,
    "raison"=>$raison
    )
);


$insertuser = $db->prepare("INSERT INTO users (status) VALUES (:membre) WHERE id=:user_id");
$insertuser->execute(array(
    "user_id"=>$_SESSION['user_id'],
    "membre"=>'MEMBRE'
    )
);
