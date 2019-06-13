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
$typeactivite=$_SESSION['typeactivite'];
$transaction_id = $_POST['transaction_id'];
$price = $_POST['price'];
$currency_code = $_POST['currency_code'];
$user_id = $_SESSION['user_id'];
$raison = 'Commande activité/voyage';

$activity_name = $_SESSION['activity_name'];


$selectrealname = $db->prepare("SELECT * from activitesvoyages WHERE slug=:activity_name");
$selectrealname->execute(array(
    "activity_name"=>$activity_name
    )
);
$r = $selectrealname->fetch(PDO::FETCH_OBJ);
$realname = $r->title;
$stock = $r->stock;
$newstock = $stock - 1;

$selectactivite = $db->prepare("SELECT * from users WHERE id=:user_id");
$selectactivite->execute(array(
    "user_id"=>$user_id
    )
);
$ractivite = $selectactivite->fetch(PDO::FETCH_OBJ);
$countactivite = $ractivite->countactivite;
$newcountactivite = $countactivite + '1';

$updateactivite = $db->prepare("UPDATE users SET countactivite=:newcountactivite WHERE id=:user_id");
$updateactivite->execute(array(
    "user_id"=>$user_id,
    "newcountactivite"=>$newcountactivite
    )
);

//Pour le SKI
if ($typeactivite == "ski"){
$optionmateriel = $_SESSION['optionmateriel'];
$optionrepas = $_SESSION['optionrepas'];
$optionadditionnelles = $_SESSION['optionadditionnelles'];


$pageformulaire = 'formulaire.php?type=ski';
$icon = 'ac_unit';

$insertparticipe = $db->prepare("INSERT INTO participe (user_id, activity_name, date, optionmateriel, optionrepas, optionadditionnelles) VALUES(:user_id, :activity_name, :date, :optionmateriel, :optionrepas, :optionadditionnelles)");
$insertparticipe->execute(array(
    "user_id"=>$user_id,
    "activity_name"=>$activity_name,
    "date"=>$date,
    "optionmateriel"=>$optionmateriel,
    "optionrepas"=>$optionrepas,
    "optionadditionnelles"=>$optionadditionnelles
    )
);


$insertcatparticipe = $db->prepare("INSERT INTO catparticipe (user_id, name, page, icon) VALUES(:user_id, :realname, :pageformulaire, :icon)");
$insertcatparticipe->execute(array(
    "user_id"=>$user_id,
    "realname"=>$realname,
    "pageformulaire"=>$pageformulaire,
    "icon"=>$icon
    )
);


$insertformski = $db->prepare("INSERT INTO formulaireski (user_id) VALUES(:user_id)");
$insertformski->execute(array(
    "user_id"=>$user_id
    )
);

// Pour le RUGBY
}else if ($typeactivite == "rugby"){
$optionaccompagnement = $_SESSION['optionaccompagnement'];
$pageformulaire = 'formulaire.php?type=rugby';
$icon = 'map';


$insertparticipe2 = $db->prepare("INSERT INTO participe (user_id, activity_name, date, optionaccompagnement) VALUES(:user_id, :activity_name, :date, :optionaccompagnement)");
$insertparticipe2->execute(array(
    "user_id"=>$user_id,
    "activity_name"=>$activity_name,
    "date"=>$date,
    "optionaccompagnement"=>$optionaccompagnement
    )
);


$insertcatparticipe2 = $db->prepare("INSERT INTO catparticipe (user_id, name, page, icon) VALUES(:user_id, :realname, :pageformulaire, :icon)");
$insertcatparticipe2->execute(array(
    "user_id"=>$user_id,
    "realname"=>$realname,
    "pageformulaire"=>$pageformulaire,
    "icon"=>$icon
    )
);

$insertformrugby = $db->prepare("INSERT INTO formulairerugby (user_id) VALUES(:user_id)");
$insertformrugby->execute(array(
    "user_id"=>$user_id
    )
);

}else if ($typeactivite == "cinema"){
$pageformulaire = 'formulaire.php?type=cinema';
$icon = 'map';


$insertparticipe3 = $db->prepare("INSERT INTO participe (user_id, activity_name, date) VALUES(:user_id , :activity_name ,:date)");
$insertparticipe3->execute(array(
    "user_id"=>$user_id,
    "activity_name"=>$activity_name,
    "date"=>$date
    )
);


$insertcatparticipe3 = $db->prepare("INSERT INTO catparticipe (user_id, name, page, icon) VALUES(:user_id, :realname, :pageformulaire, :icon)");
$insertcatparticipe3->execute(array(
    "user_id"=>$user_id,
    "realname"=>$realname,
    "pageformulaire"=>$pageformulaire,
    "icon"=>$icon
    )
);

}


$updateactiv = $db->prepare("UPDATE activitesvoyages SET stock=:newstock WHERE slug=:activity_name");
$updateactiv->execute(array(
    "newstock"=>$newstock,
    "activity_name"=>$activity_name
    )
);

$insertcatparticipe3 = $db->prepare("INSERT INTO transactions (name, street, city, country, date, datesystem, transaction_id, amount, currency_code, user_id, raison) VALUES(:name, :street, :city, :country_code, :date, :datesystem, :transaction_id, :price, :currency_code, :user_id , :raison)");
$insertcatparticipe3->execute(array(
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

unset($_SESSION['activity_name']);
unset($_SESSION['optionmateriel']);
unset($_SESSION['optionadditionnelles']);
unset($_SESSION['optionrepas']);
unset($_SESSION['optionaccompagnement']);
unset($_SESSION['typeactivite']);
