<?php
require_once('../includes/connectBDD.php');


        $user_id = $_POST['user_id'];
        $catactivitevoyage = $_POST['catactivitevoyage'];

        $selectslug = $db->prepare("SELECT slug FROM activitesvoyages WHERE title=:catactivitevoyage");
        $selectslug->execute(array(
                            "catactivitevoyage"=>$catactivitevoyage
                            )
                        );
        $s = $selectslug->fetch(PDO::FETCH_OBJ);
        $slug = $s->slug;


            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Suppression non effectuée en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
