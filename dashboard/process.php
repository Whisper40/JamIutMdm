<?php

require_once('includes/connectBDD.php');

$name=str_replace("'"," ",$_POST['name']);
$street=str_replace("'"," ",$_POST['street']);
$city=str_replace("'"," ",$_POST['city']);
$country_code = $_POST['country_code'];
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.utf8','fra');
$date = strftime('%d/%m/%Y %H:%M:%S');

$transaction_id = $_POST['transaction_id'];
$price = $_POST['price'];
$currency_code = $_POST['currency_code'];
$user_id = $_SESSION['user_id'];
$raison = 'Commande activité/voyage';

$activity_name = $_SESSION['activity_name'];

$selectrealname = $db->query("SELECT title from activitesvoyages WHERE slug='$activity_name'");
$r = $selectrealname->fetch(PDO::FETCH_OBJ);
$realname = $r->title;
$stock = $r->stock;
$newstock = $stock - '1';

//Pour le SKI
if (stripos($activity_name, 'ski') != FALSE){
$optionmateriel = $_SESSION['optionmateriel'];
$optionrepas = $_SESSION['optionrepas'];
$pageformulaire = 'formulaire.php?type=ski';
$icon = 'dns';

$db->query("INSERT INTO participe (user_id, activity_name, date, optionmateriel, optionrepas) VALUES('$user_id' ,'$activity_name' ,'$date' ,'$optionmateriel' ,'$optionrepas')");
$db->query("INSERT INTO catparticipe (user_id, name, page, icon) VALUES('$user_id', '$realname', '$pageformulaire', '$icon')");
$db->query("INSERT INTO formulaireski (user_id) VALUES('$user_id')");

// Pour le RUGBY
}else if (stripos($activity_name, 'rugby') != FALSE){
$optionaccompagnement = $_SESSION['optionaccompagnement'];
$pageformulaire = 'formulaire.php?type=rugby';
$icon = 'whatshot';

$db->query("INSERT INTO participe (user_id, activity_name, date, optionaccompagnement) VALUES('$user_id' ,'$activity_name' ,'$date', '$optionaccompagnement')");
$db->query("INSERT INTO catparticipe (user_id, name, page, icon) VALUES('$user_id', '$realname', '$pageformulaire', '$icon')");
$db->query("INSERT INTO formulairerugby (user_id) VALUES('$user_id')");

}else if (stripos($activity_name, 'cinema') != FALSE){
$pageformulaire = 'formulaire.php?type=cinema';
$icon = 'whatshot';

$db->query("INSERT INTO participe (user_id, activity_name, date) VALUES('$user_id' ,'$activity_name' ,'$date')");
$db->query("INSERT INTO catparticipe (user_id, name, page, icon) VALUES('$user_id', '$realname', '$pageformulaire', '$icon')");
}


$db->query("UPDATE activitesvoyages SET stock='$newstock' WHERE slug='$activity_name'");
$db->query("INSERT INTO transactions (name, street, city, country, date, transaction_id, amount, currency_code, user_id, raison) VALUES('$name', '$street', '$city', '$country_code', '$date', '$transaction_id', '$price', '$currency_code', '$user_id' ,'$raison')");



unset($_SESSION['activity_name']);
unset($_SESSION['optionmateriel']);
unset($_SESSION['optionrepas']);
unset($_SESSION['optionaccompagnement']);
