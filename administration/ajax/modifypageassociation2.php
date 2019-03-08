<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $id = $_POST['id'];
        $titre1 = $_POST['titre1'];
        $pagetitre = $_POST['pagetitre'];


        if(!empty($user_id)&&!empty($id)&&!empty($titre1)&&!empty($pagetitre)){


                $update = $db->prepare("UPDATE pageasso SET titre1=:titre1 WHERE id=:id");
                $update->execute(array(
                    "id"=>$id,
                    "titre1"=>$titre1
                    )
                );

                $update2 = $db->prepare("UPDATE photopage SET pagetitre=:pagetitre WHERE nompage=:nompage");
                $update2->execute(array(
                    "nompage"=>'Présentation association',
                    "pagetitre"=>$pagetitre
                    )
                );

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Modification',
                                    "action"=>'Modification page association',
                                    "page"=>'association.php',
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
