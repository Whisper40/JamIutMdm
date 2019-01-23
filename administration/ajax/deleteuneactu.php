<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $catactu = $_POST['catactu'];

        if(!empty($user_id)&&!empty($catactu)){

          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%d/%m/%Y %H:%M:%S');

        

            }else{
                ?>

                    <script>
                    demo.showNotification('top','right','<b>Erreur</b> - Création non effectuée en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
