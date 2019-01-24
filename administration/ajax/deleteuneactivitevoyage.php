<?php
require_once('../includes/connectBDD.php');


        $user_id = $_POST['user_id'];
        $catactivitevoyage = $_POST['catactivitevoyage'];

        $selectslug = $db->prepare("SELECT slug FROM activitesvoyages WHERE title=:catactivitevoyage");
        $selectslug->execute(array(
                            "catactivitevoyage"=>$catactivitevoyage
                            )
                        );
        $s = $selectslug->fetch(PDO::FETCH_OBJ);
        $slug = $s->slug;



        if(!empty($user_id)&&!empty($catactivitevoyage)){
          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%d/%m/%Y %H:%M:%S');


              $del = $db->prepare("DELETE FROM participe WHERE slug=:slug");
              $del->execute(array(
                              "slug"=>$slug
                            )
              );

              $del5 = $db->prepare("DELETE FROM communicationactivite WHERE slug=:slug");
              $del5->execute(array(
                              "slug"=>$slug
                            )
              );

            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Suppression non effectuée en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
