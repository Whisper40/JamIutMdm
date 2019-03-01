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
                                //owner = le mail de la personne
                                  $priority = '1';
                                  $owner_mail = 'contact@jam-mdm.fr';
                                  $message = 'MESSAGE A FAIRE en lui donnant le mail utilise et le mdp';
                                  $subject = '[JAM]'.'[Administrateur]';
                                if($subject&&$email&&$message){
                                      $uid = md5(uniqid(time()));
                                      // header
                                      $headers = "From: <".$owner_mail.">\r\n";
                                      $headers .= "MIME-Version: 1.0\r\n";
                                      $headers .= 'X-Priotity:'.$priority."\r\n";
                                      $headers .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
                                      // message & attachment
                                      $nmessage = "--".$uid."\r\n";
                                      $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
                                      $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                                      $nmessage .= $message."\r\n\r\n";
                                      $nmessage .= "--".$uid."\r\n";

                                      $nmessage .= "--".$uid."--";
                                        mail($email,$subject,$nmessage, $headers);
                                        ?>
                                            <script>
                                            demo.showSwal('success-message');
                                            demo.showNotification('top','right','<b>Succès</b> - Modifications effectués !');
                                            </script>
                                            <?php
                                  }else{
                                    ?>

                                        <script>
                                        demo.showSwal('danger-message');
                                        demo.showNotification('top','right','<b>Erreur</b> - Modifications non effectués en raison de champs vides !');
                                        </script>
                                <?php
                                  }







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
