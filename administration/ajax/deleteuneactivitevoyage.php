<?php
require_once('../includes/connectBDD.php');


        $user_id = $_POST['user_id'];
        $title = $_POST['title'];

        $selectslug = $db->prepare("SELECT slug FROM activitesvoyages WHERE title=:title");
        $selectslug->execute(array(
                            "title"=>$title
                            )
                        );
        $s = $selectslug->fetch(PDO::FETCH_OBJ);
        $slug = $s->slug;

//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE

        if(!empty($user_id)&&!empty($title){
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
                //Suivant l'activité

                if (stripos($texte, 'ski') !== FALSE) {
                    //L'insulte est présente
                    $del2 = $db->prepare("DELETE FROM formulaireski");
                    $del2->execute();

                    $del6 = $db->prepare("DELETE FROM catparticipe where page=:slug");
                    $del6->execute(array(
                      "slug"=>'%ski%'
                    ));
                }else if (stripos($texte, 'sportive') !== FALSE){
                  $del2 = $db->prepare("DELETE FROM formulairesportive");
                  $del2->execute();

                  $del7 = $db->prepare("DELETE FROM catparticipe where page=:slug");
                  $del7->execute(array(
                    "slug"=>'%sportive%'
                  ));

                }else if (stripos($texte, 'rugby') !== FALSE){
                  $del3 = $db->prepare("DELETE FROM formulairerugby");
                  $del3->execute();

                  $del8 = $db->prepare("DELETE FROM catparticipe where page=:slug");
                  $del8->execute(array(
                    "slug"=>'%rugby%'
                  ));

                }else if (stripos($texte, 'orientation') !== FALSE){
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
                                    "action"=>'Suppression d\'une actualité',
                                    "page"=>'activitees.php',
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
