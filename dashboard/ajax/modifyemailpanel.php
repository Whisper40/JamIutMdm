<?php
require_once('../includes/connectBDD.php');




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
            demo.showNotification('top','right','Modifications effectuées avec succès !','success');
            </script>
            <?php



            }else{
                ?>


                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','Désolé, modification non effectuée !','warning');
                    </script>


            <?php
            }}

        ?>
