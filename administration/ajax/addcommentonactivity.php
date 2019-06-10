<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $slugacti = $_POST['slugacti'];
        $infoscomplementaires = $_POST['infoscomplementaires'];


        if(!empty($slugacti)&&isset($infoscomplementaires)&&!empty($user_id)){
          if (stripos($slugacti, 'cinema') != FALSE){
            $slug = "cinema";
          }else if (stripos($slugacti, 'nettoyage') != FALSE){
            $slug = "nettoyage";
          }

          $selectifexist = $db->prepare("SELECT * FROM communicationactivite WHERE slug=:slug");
          $selectifexist->execute(array(
              "slug"=>$slug
              )
          );
          $count = $selectifexist->rowCount();
          if($count == "1"){
            $update = $db->prepare("UPDATE communicationactivite SET infoscomplementaires=:infoscomplementaires WHERE slug=:slug");
            $update->execute(array(
                "infoscomplementaires"=>$infoscomplementaires,
                "slug"=>$slug
                )
            );
          }else{
            $insertcommunication = $db->prepare("INSERT INTO communicationactivite (slug, infoscomplementaires) VALUES(:slug, :infoscomplementaires)");
            $insertcommunication->execute(array(
                "slug"=>$slug,
                "infoscomplementaires"=>$infoscomplementaires
                )
            );
          }
                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Modification',
                                    "action"=>'Modification d\'une activité',
                                    "page"=>'activitees.php',
                                    "date"=>$date
                                    )
                                );
                ?>

                    <script>
                    demo.showSwal('success-message');
                    demo.showNotification('top','right','Modifications effectuées avec succès !','success');
                    </script>

            <?php
            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','Désolé, suppression non effectué en raison de champs vides !','warning');
                    </script>
            <?php
            }

    ?>
