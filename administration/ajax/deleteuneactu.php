<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $id = $_POST['id'];

        if(!empty($user_id)&&!empty($id)){

          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%d/%m/%Y %H:%M:%S');

          $select = $db->prepare("SELECT slug, formatimg FROM newsactus WHERE id=:id");
          $select->execute(array(
                              "id"=>$id
                              )
                          );
          $sa = $select->fetch(PDO::FETCH_OBJ);
          $slug=$sa->slug;
          $formatimg=$sa->formatimg;


          $target_dir = '../../../../JamFichiers/Img/ImagesDuSite/Original';
          $target_dirthumb = '../../../../JamFichiers/Img/ImagesDuSite/Thumb';



          if (file_exists($target_dir)){
          unlink("$target_dir/$slug.$formatimg");
          unlink("$target_dirthumb/$slug.$formatimg");

          }else{
          $error = 'Un problème de répertoire est présent, contacter votre administrateur !';
          }



          $delete = $db->prepare("DELETE FROM newsactus WHERE slug=:slug");
          $delete->execute(array(
                              "slug"=>$slug
                              )
                          );


                          $deleteallimages = $db->prepare("SELECT image FROM carousel WHERE slug=:slug");
                          $deleteallimages->execute(array(
                            "slug"=>$slug
                          )
                        );

                              while($sa = $deleteallimages->fetch(PDO::FETCH_OBJ)){
                                $image=$sa->image;


                                if (file_exists($target_dir)){
                                unlink("$target_dir/$image");
                                unlink("$target_dirthumb/$image");

                                }else{
                                $error = 'Un problème de répertoire est présent, contacter votre administrateur !';
                                }
                          }

                          $delete2 = $db->prepare("DELETE FROM carousel WHERE slug=:slug");
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

                                                          ?>
                                                          <script>
                                                          window.setTimeout("location=('https://administration.jam-mdm.fr/modifdespages.php?page=actualite&table=newsactus');",3000);
                                                          </script>
                          <?php

            }else{
                ?>

                    <script>
                    demo.showNotification('top','right','<b>Erreur</b> - Création non effectuée en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
