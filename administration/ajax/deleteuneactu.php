<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $catactu = $_POST['catactu'];

        if(!empty($user_id)&&!empty($catactu){

          echo 'ok';

            }else{
                ?>

                    <script>
                    demo.showNotification('top','right','<b>Erreur</b> - Création non effectuée en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
