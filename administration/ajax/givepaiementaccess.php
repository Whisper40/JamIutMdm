<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $id = $_POST['id'];

        if(!empty($user_id)&&!empty($id)){

          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%d/%m/%Y %H:%M:%S');
          $datesystem = strftime('%Y-%m-%d');
          $raison = 'Cotisation Annuelle';

          $selectslug = $db->prepare("SELECT price FROM cotisation");
          $selectslug->execute();
          $s = $selectslug->fetch(PDO::FETCH_OBJ);
          $price = $s->price;


          $inserttransac = $db->prepare("INSERT INTO transactions (name, street, city, country, date, datesystem, transaction_id, amount, currency_code, user_id, raison) VALUES(:name, :street, :city, :country_code, :date, :datesystem, :transaction_id, :price, :currency_code, :user_id , :raison)");
          $inserttransac->execute(array(
              "name"=>'NA',
              "street"=>'NA',
              "city"=>'NA',
              "country_code"=>'NA',
              "date"=>$date,
              "datesystem"=>$datesystem,
              "transaction_id"=>'NA',
              "price"=>$price,
              "currency_code"=>'NA',
              "user_id"=>$id,
              "raison"=>'NA'
              )
          );



                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Modification',
                                    "action"=>'Paiement reçu',
                                    "page"=>'devenirmembre.php',
                                    "date"=>$date
                                    )
                                );


            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Modification non effectuées en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
