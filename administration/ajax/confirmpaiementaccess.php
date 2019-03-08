<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $id = $_POST['id'];

        if(!empty($user_id)&&!empty($id)){


          $update1 = $db->prepare("UPDATE users SET status=:status WHERE id=:id");
          $update1->execute(array(
              "status"=>'MEMBRE',
              "id"=>$id
              )
          );

          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%d/%m/%Y %H:%M:%S');
          $datesystem = strftime('%Y-%m-%d');

          $selectprice = $db->prepare("SELECT price FROM cotisation");
          $selectprice->execute();
          $r2 = $selectprice->fetch(PDO::FETCH_OBJ);
          $price = $r2->price;
          $currency_code = 'EUR';
          $raison = 'Cotisation Annuelle';

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
              "currency_code"=>$currency_code,
              "user_id"=>$id,
              "raison"=>$raison
              )
          );

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Modification',
                                    "action"=>'Paiement effectué',
                                    "page"=>'devenirmembre.php',
                                    "date"=>$date
                                    )
                                );
?>
                                <script>
                                window.setTimeout("location=('https://administration.jam-mdm.fr/demandeadhesion.php');",3000);
                                </script>
<?php

            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','Désolé, modifications non effectuées en raison de champs vides !','warning');
                    </script>
            <?php
            }

    ?>
