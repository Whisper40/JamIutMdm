<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $id = $_POST['id'];

        if(!empty($user_id)&&!empty($id)){


          $update1 = $db->prepare("UPDATE users SET status=:status WHERE id=:id");
          $update1->execute(array(
              "status"=>'EN ATTENTE DE PAIEMENT',
              "id"=>$id
              )
          );

          $update2 = $db->prepare("UPDATE validationfichiers SET status=:status WHERE user_id=:id");
          $update2->execute(array(
              "status"=>'VALIDE',
              "id"=>$id              
              )
          );

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Modification',
                                    "action"=>'Paiement autorisé',
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
                    demo.showNotification('top','right','<b>Erreur</b> - Modification non effectuées en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
