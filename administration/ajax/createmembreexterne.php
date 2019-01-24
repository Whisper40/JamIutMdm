<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $code = $_POST['code'];
        $raison = $_POST['raison'];

      if(!empty($user_id)&&!empty($nom)&&!empty($prenom)&&!empty($code)&&!empty($raison)){


                $insert = $db->prepare("INSERT INTO etud (numero, nom, prenom) VALUES (:numero, :nom, :prenom)");
                $insert->execute(array(
                    "numero"=>$code,
                    "nom"=>$nom,
                    "prenom"=>$prenom
                    )
                );

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Ajout',
                                    "action"=>'Ajout d\'un utilisateur externe',
                                    "page"=>$raison,
                                    "date"=>$date
                                    )
                                );

                ?>

                    <script>
                    demo.showSwal('success-message');
                    demo.showNotification('top','right','<b>Succès</b> - Modification effectués !');
                    </script>

            <?php
            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Modification non effectués en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
