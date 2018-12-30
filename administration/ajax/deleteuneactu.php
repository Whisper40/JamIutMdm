<?php
require_once('../includes/connectBDD.php');


        $user_id = $_POST['user_id'];
        $title = $_POST['title'];


//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE

        if(!empty($user_id)&&!empty($title){
          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%d/%m/%Y %H:%M:%S');

          $insert = $db->prepare("INSERT INTO newsactus (title, slug, description, surname, date, formatimg, status) VALUES(:title, :slug, :description, :surname, :date, :formatimg, :status)");
          $insert->execute(array(
                              "title"=>$title,
                              "slug"=>$slug,
                              "description"=>$description,
                              "surname"=>'Actualité',
                              "date"=>$date,
                              "formatimg"=>$formatimg,
                              "status"=>'ACTIVE'
                              )
                          );

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Ajout',
                                    "action"=>'Ajout d\'une actualité',
                                    "page"=>'actualitees.php',
                                    "date"=>$date
                                    )
                                );
                ?>

                    <script>
                    demo.showSwal('success-message');
                    demo.showNotification('top','right','<b>Succès</b> - L\'actualité à été crée !');
                    </script>

            <?php
            }else{
                ?>

                    <script>
                    demo.showSwal('warning-message-and-canceldeletefichier');
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Création non effectuée en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
