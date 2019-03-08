<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $article = $_POST['article'];
        $titre = $_POST['titrestatus'];
        $soustitre = $_POST['soustitre'];
        $description = $_POST['description'];

      if(!empty($user_id)&&!empty($article)&&!empty($titre)&&!empty($description)){


                $insert = $db->prepare("INSERT INTO status (article, titre, soustitre, description) VALUES (:article, :titre, :soustitre, :description)");
                $insert->execute(array(
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
                                    "type"=>'Ajout',
                                    "action"=>'Ajout de statuts',
                                    "page"=>'statuts.php',
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
                    demo.showNotification('top','right','Désolé, modifications non effectuées en raison de champs vides !','warning');
                    </script>
            <?php
            }

    ?>
