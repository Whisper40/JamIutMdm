<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $id = $_POST['id'];
        $description1 = $_POST['description1'];
        $description2 = $_POST['description2'];



        if(!empty($user_id)&&!empty($id)&&!empty($description1)&&!empty($description2)){


                $update = $db->prepare("UPDATE pageasso SET description1=:description1, description2=:description2 WHERE id=:id");
                $update->execute(array(
                    "id"=>$id,
                    "description1"=>$description1,
                    "description2"=>$description2
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
