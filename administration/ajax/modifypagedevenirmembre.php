<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $id = $_POST['id'];
        $introduction = $_POST['introduction'];
        $etape1 = $_POST['etape1'];
        $etape2 = $_POST['etape2'];
        $etape3 = $_POST['etape3'];



        if(!empty($user_id)&&!empty($id)&&!empty($introduction)&&!empty($etape1)&&!empty($etape2)&&!empty($etape3)){


                $update = $db->prepare("UPDATE pagedevenirmembre SET introduction=:introduction, etape1=:etape1, etape2=:etape2, etape3=:etape3 WHERE id=:id");
                $update->execute(array(
                    "id"=>$id,
                    "introduction"=>$introduction,
                    "etape1"=>$etape1,
                    "etape2"=>$etape2,
                    "etape3"=>$etape3
                    )
                );

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Modification',
                                    "action"=>'Modification page devenirmembre',
                                    "page"=>'devenirmembre.php',
                                    "date"=>$date
                                    )
                                );

                ?>

                    <script>
                    demo.showSwal('success-message');
                    demo.showNotification('top','right','<b>Succès</b> - Modifications effectuées !');
                    </script>

            <?php
            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Modifications non effectuées en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
