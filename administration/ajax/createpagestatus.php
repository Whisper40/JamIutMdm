<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $article = $_POST['article'];
        $titre = $_POST['titre'];
        $soustitre = $_POST['soustitre'];
        $description = $_POST['description'];


        var user_id = "<?php echo $_SESSION['admin_id']; ?>";
        var article = $("#article").val();
        var titre = $("#titre").val();
        var soustitre = $("#soustitre").val();
        var description = $("#description").val();

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
                    demo.showNotification('top','right','<b>Succès</b> - Modification effectuées !');
                    </script>

            <?php
            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Modification non effectuées en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
