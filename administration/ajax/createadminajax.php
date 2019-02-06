<?php
require_once('../includes/connectBDD.php');
        $user_id = $_POST['user_id'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $grade = $_POST['grade'];
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        if(!empty($email)&&!empty($nom)&&!empty($password)&&!empty($grade)){

                 if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#', $password)){

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%Y/%m/%d %H:%M:%S');

                $datesystem = strftime('%Y-%m-%d');



                $insertlogs = $db->prepare("INSERT INTO admin (username, email, password, grade, subscribe) VALUES(:nom, :email, :password, :grade, :subscribe)");
                $insertlogs->execute(array(
                                    "nom"=>$nom,
                                    "email"=>$email,
                                    "password"=>$param_password,
                                    "grade"=>$grade,
                                    "subscribe"=>$datesystem
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
