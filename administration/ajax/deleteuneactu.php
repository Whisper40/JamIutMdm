<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $catactu = $_POST['catactu'];

        if(!empty($user_id)&&!empty($catactu)){

          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%d/%m/%Y %H:%M:%S');

          $select = $db->prepare("SELECT slug FROM newsactus WHERE title=:catactu");
          $select->execute(array(
                              "catactu"=>$catactu
                              )
                          );
          $sa = $select->fetch(PDO::FETCH_OBJ);
          $slug=$sa->slug;



          $delete = $db->prepare("DELETE * FROM newsactus WHERE slug=:slug");
          $delete->execute(array(
                              "slug"=>$slug
                              )
                          );

                          $delete2 = $db->prepare("DELETE * FROM carousel WHERE slug=:slug");
                          $delete2->execute(array(
                                              "slug"=>$slug
                                              )
                                          );


                                          $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                                          $insertlogs->execute(array(
                                                              "user_id"=>$user_id,
                                                              "type"=>'Suppression',
                                                              "action"=>'Suppression d une activite',
                                                              "page"=>'activitees.php',
                                                              "date"=>$date
                                                              )
                                                          );

            }else{
                ?>

                    <script>
                    demo.showNotification('top','right','<b>Erreur</b> - Création non effectuée en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
