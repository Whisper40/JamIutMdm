<?php
require_once('../includes/connectBDD.php');


        $user_id = $_POST['user_id'];
        $id = $_POST['id'];

        $selectslug = $db->prepare("SELECT slug, formatimg, typeactivite FROM activitesvoyages WHERE id=:id");
        $selectslug->execute(array(
                            "id"=>$id
                            )
                        );
        $s = $selectslug->fetch(PDO::FETCH_OBJ);
        $slug = $s->slug;
        $formatimg = $s->formatimg;
        $typeactivite = $s->typeactivite;

//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE//A FAIRE

        if(!empty($user_id)&&!empty($id)){
          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%d/%m/%Y %H:%M:%S');



          $target_dir = '../../../../JamFichiers/Img/ImagesDuSite/Original';
          $target_dirthumb = '../../../../JamFichiers/Img/ImagesDuSite/Thumb';




          if (file_exists($target_dir)){
          unlink("$target_dir/$slug.$formatimg");
          unlink("$target_dirthumb/$slug.$formatimg");

          }else{
          $error = 'Un problème de répertoire est présent, contacter votre administrateur !';
          }

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



          $deletecarousel = $db->prepare("DELETE FROM carousel WHERE slug=:slug");
          $deletecarousel->execute(array(
                              "slug"=>$slug
                              )
                          );

          $del0 = $db->prepare("DELETE FROM activitesvoyages WHERE id=:id");
          $del0->execute(array(
                          "id"=>$id
                        )
          );


              $del00 = $db->prepare("DELETE FROM participe WHERE typeactivite=:typeactivite");
              $del00->execute(array(
                              "typeactivite"=>$typeactivite
                            )
              );

              $del5 = $db->prepare("DELETE FROM communicationactivite WHERE slug=:slug");
              $del5->execute(array(
                              "slug"=>$slug
                            )
              );
                //Suivant l'activité

                if ($typeactivite == "ski"){
                    //Le texte est present
                    $del2 = $db->prepare("DELETE FROM formulaireski");
                    $del2->execute();

                    $del6 = $db->prepare("DELETE FROM catparticipe where page LIKE :slug");
                    $del6->execute(array(
                      "slug"=>'%ski%'
                    ));
                }else if ($typeactivite == "sportive"){
                  $del2 = $db->prepare("DELETE FROM formulairesportive");
                  $del2->execute();

                  $del7 = $db->prepare("DELETE FROM catparticipe where page LIKE :slug");
                  $del7->execute(array(
                    "slug"=>'%sportive%'
                  ));

                }else if ($typeactivite == "rugby"){
                  $del3 = $db->prepare("DELETE FROM formulairerugby");
                  $del3->execute();

                  $del8 = $db->prepare("DELETE FROM catparticipe where page LIKE :slug");
                  $del8->execute(array(
                    "slug"=>'%rugby%'
                  ));

                }else if ($typeactivite == "orientation"){
                  $del4 = $db->prepare("DELETE FROM formulaireorientation");
                  $del4->execute();

                  $del9 = $db->prepare("DELETE FROM catparticipe where page LIKE :slug");
                  $del9->execute(array(
                    "slug"=>'%orientation%'
                  ));
                }else if ($typeactivite == "cinema"){
                  $del10 = $db->prepare("DELETE FROM communicationactivite where slug LIKE :slug");
                  $del10->execute(array(
                    "slug"=>'%cinema%'
                  ));

                  $del11 = $db->prepare("DELETE FROM catparticipe where page LIKE :slug");
                  $del11->execute(array(
                    "slug"=>'%cinema%'
                  ));
                }else if ($typeactivite == "nettoyage"){
                  $del11 = $db->prepare("DELETE FROM communicationactivite where slug LIKE :slug");
                  $del11->execute(array(
                    "slug"=>'%nettoyage%'
                  ));

                  $del12 = $db->prepare("DELETE FROM catparticipe where page LIKE :slug");
                  $del12->execute(array(
                    "slug"=>'%nettoyage%'
                  ));
                }else if ($typeactivite == "soireebar"){
                  $del11 = $db->prepare("DELETE FROM communicationactivite where slug LIKE :slug");
                  $del11->execute(array(
                    "slug"=>'%nettoyage%'
                  ));

                  $del12 = $db->prepare("DELETE FROM catparticipe where page LIKE :slug");
                  $del12->execute(array(
                    "slug"=>'%soiree%'
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
                                ?>

                    <script>
                  window.setTimeout("location=('https://administration.jam-mdm.fr/modifdespages.php?page=activitesvoyages&table=activitesvoyages');",3000);
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
