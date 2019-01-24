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

//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE

        if(!empty($user_id)&&!empty($catactivitevoyage)){
          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%d/%m/%Y %H:%M:%S');


            

              $del5 = $db->prepare("DELETE FROM communicationactivite WHERE slug=:slug");
              $del5->execute(array(
                              "slug"=>$slug
                            )
              );
                //Suivant l'activité

                if (stripos($slug, 'ski') !== FALSE) {
                    //L'insulte est présente
                    $del2 = $db->prepare("DELETE FROM formulaireski");
                    $del2->execute();

                    $del6 = $db->prepare("DELETE FROM catparticipe where page=:slug");
                    $del6->execute(array(
                      "slug"=>'%ski%'
                    ));
                }else if (stripos($slug, 'sportive') !== FALSE){
                  $del2 = $db->prepare("DELETE FROM formulairesportive");
                  $del2->execute();

                  $del7 = $db->prepare("DELETE FROM catparticipe where page=:slug");
                  $del7->execute(array(
                    "slug"=>'%sportive%'
                  ));

                }else if (stripos($slug, 'rugby') !== FALSE){
                  $del3 = $db->prepare("DELETE FROM formulairerugby");
                  $del3->execute();

                  $del8 = $db->prepare("DELETE FROM catparticipe where page=:slug");
                  $del8->execute(array(
                    "slug"=>'%rugby%'
                  ));

                }else if (stripos($slug, 'orientation') !== FALSE){
                  $del4 = $db->prepare("DELETE FROM formulaireorientation");
                  $del4->execute();

                  $del9 = $db->prepare("DELETE FROM catparticipe where page=:slug");
                  $del9->execute(array(
                    "slug"=>'%orientation%'
                  ));
                }


                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Suppression',
                                    "action"=>'Suppression d\'une activité',
                                    "page"=>'activitees.php',
                                    "date"=>$date
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
