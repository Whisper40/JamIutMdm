<?php
require_once('../includes/connectBDD.php');
        $user_id = $_POST['user_id'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $grade = 'NORMAL';
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        if(!empty($email)&&!empty($nom)&&!empty($password)){

                 if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#', $password)){

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%Y/%m/%d %H:%M:%S');

                $datesystem = strftime('%Y-%m-%d');



              




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
            demo.showNotification('top','right','<b>Erreur</b> - Modification non effectuée en raison de mot de passe non fiable !');
            </script>


<?php
    }


  }else {

    ?>


<script>
        demo.showSwal('danger-message');
        demo.showNotification('top','right','<b>Erreur</b> - Modification non effectuée en raison de champs vides !');
        </script>


<?php
  }

        ?>
