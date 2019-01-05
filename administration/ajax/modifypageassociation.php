<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $id = $_POST['id'];
        $titre1 = $_POST['titre1'];
        $description1 = $_POST['description1'];
        $description2 = $_POST['description2'];
        $pagetitre = $_POST['pagetitre'];
        $image = $_POST['image'];

        if(!empty($user_id)&&!empty($id)&&!empty($titre1)&&!empty($description1)&&!empty($description2)&&!empty($pagetitre)&&!empty($image)){


                $update = $db->prepare("UPDATE pageasso SET titre1=:titre1, description1=:description1, description2=:description2, etape3=:etape3 WHERE id=:id");
                $update->execute(array(
                    "id"=>$id,
                    "titre1"=>$titre1,
                    "description1"=>$description1,
                    "description2"=>$description2,
                    "etape3"=>$etape3
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
