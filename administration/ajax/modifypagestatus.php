<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $id = $_POST['id'];
        $article = $_POST['article'];
        $titre = $_POST['titre'];
        $soustitre = $_POST['soustitre'];
        $description = $_POST['description'];

        if(!empty($user_id)&&!empty($id)&&!empty($article)&&!empty($titre)&&!empty($description)){

                $update = $db->prepare("UPDATE status SET article=:article, titre=:titre, soustitre=:soustitre, description=:description WHERE id=:id");
                $update->execute(array(
                    "id"=>$id,
                    "article"=>$article,
                    "titre"=>$titre,
                    "soustitre"=>$soustitre,
                    "description"=>$description
                    )
                );

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Modification',
                                    "action"=>'Modification page status',
                                    "page"=>'status.php',
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
