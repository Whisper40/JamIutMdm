
<?php
require_once('includes/head.php');
        
        
        

        $email = $_POST['email2'];
        $newemail = $_POST['newemail'];
        $repeatnewemail = $_POST['repeatnewemail'];
        $mailpetit = strtolower($newemail);
        if(!empty($email)&&(!empty($newemail))&&(!empty($repeatnewemail))){
            if($newemail==$repeatnewemail){



                $user_id = $_SESSION['user_id'];
                $update = $db->query("UPDATE users SET email='$mailpetit' WHERE id='$user_id' and email='$email'");
                ?>
            <script> 

            demo.showSwal('success-message');
            demo.showNotification('top','right','<b>Succès</b> - Modification effectuée !');
            </script>
            <?php


                
            }else{
                ?>


                    <script> 
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Modification non effectuée !');
                    </script>


            <?php
            }}
 
        ?>

