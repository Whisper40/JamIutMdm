<?php
require_once('includes/connectBDD.php');

        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeatpassword = $_POST['repeatpassword'];
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        if(!empty($email)&&(!empty($password))&&(!empty($repeatpassword))){
            if($password==$repeatpassword){
                 if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#', $password)){
                $user_id = $_SESSION['user_id'];
                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%Y/%m/%d %H:%M:%S');
                $newmdp = $db->prepare("UPDATE users SET password=:param_password WHERE id='$user_id' and email='$email'");
                $newmdp->execute(array(


                    "param_password"=>$param_password,

                    )
                );





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
    }


            }else{
                ?>


					<script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Modification non effectuée !');
                    </script>


			<?php
            }}

        ?>
