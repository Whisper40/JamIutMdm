<?php
require_once('../includes/connectBDD.php');


            if(strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') !== false){
                $user_agent_name = 'Mozilla Firefox';
            }else if(strpos($_SERVER["HTTP_USER_AGENT"], 'Opera') !== false){
                $user_agent_name = 'Opera';
            }else if(strpos($_SERVER["HTTP_USER_AGENT"], 'Netscape') !== false){
                $user_agent_name = 'Netscape';
            }else if(strpos($_SERVER["HTTP_USER_AGENT"], 'Konqueror') !== false){
                $user_agent_name = 'Konqueror';
            }else if(strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE') !== false){
                $user_agent_name = 'Internet Explorer / Avant Browser';
            }else if(strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') !== false){
                $user_agent_name = 'Google Chrome';
            }else{
                $user_agent_name = '(navigateur inconnu)';
            }



              // On demande l'utilisateur avec cet email qui n'est pas bannis et qui n'a pas de tentative de connexion frauduleuses
                $email = $_POST['email'];
                $password = $_POST['password'];
                if(!empty($email)&&!empty($password)){
                        $select = $db->prepare("SELECT * FROM admin WHERE email=:email");
                        $select->execute(array(
                            "email" => $email
                            )
                        );
                        if($select->rowCount()==1){

                          $attempts = 5;
                          $selectban = $db->prepare("SELECT * FROM admin WHERE email=:email and numberofattempts<:attempts");
                          $selectban->execute(array(
                              "email"=>$email,
                              "attempts"=>$attempts
                              )
                          );
                          $slang = $selectban->fetch(PDO::FETCH_OBJ);
                          $lang=$slang->langue;
                          if($selectban->rowCount()==1){
                            $data = $select->fetch();
                            if(password_verify($password, $data['password'])){
                              //Si le mot de passe correspond à l'email utilisé par la personne alors on définis les variables de sessions

                                $_SESSION['admin_id'] = $data['id'];
                                $_SESSION['user_name'] = $data['username'];
                                $_SESSION['user_email'] = $data['email'];
                                $_SESSION['langue'] = $lang;


                        date_default_timezone_set('Europe/Paris');
                        setlocale(LC_TIME, 'fr_FR.utf8','fra');
                        $date = strftime('%d/%m/%Y %H:%M:%S');
                        $datesystem = strftime('%Y-%m-%d');
                        // On ajoute dans la BDD l'ensemble des informations de l'utilisateur qui se connecte, son IP, son navigateur ainsi que la date de connexion de la personne.
                        $insertinfos = $db->prepare("INSERT INTO histconnexionadmin (admin_id, ip, navigateur, date) VALUES (:admin_id, :ip, :navigateur, :date)");
                        $insertinfos->execute(array(
                            "admin_id"=>$_SESSION['admin_id'],
                            "ip"=>$ip,
                            "navigateur"=>$user_agent_name,
                            "date"=>$date
                            )
                        );
                        $test ="teteteteteteete";

            // STOP - Historique de connexion au site

            // START - Update last_connexion :

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');
                $datesystem = strftime('%Y-%m-%d');
                $admin_id = $_SESSION['admin_id'];
                //On réinitialise le nombre de tentatives avec echec.
                $attempts = 0;
                $tentative = $db->prepare("UPDATE admin SET numberofattempts=:attempts WHERE id=:admin_id");
                $tentative->execute(array(
                    "attempts"=>$attempts,
                    "admin_id"=>$admin_id
                    )
                );


                $update = $db->prepare("UPDATE admin SET last_connect=:date WHERE id=:id");
                $update->execute(array(
                    "date"=>$date,
                    "id"=>$admin_id
                    )
                );


           ?>


    <script>
                         StartNotif("Vous êtes maintenant connecté ! Content de vous revoir :) ",'success');

                         setTimeout(function () {
//Redirect with JavaScript
window.location.href= 'https://administration.jam-mdm.fr/';
}, 2000);

                      </script>



              <?php



            }else{



      // Ajout de tentative avec erreurs de mdp.

      $email = htmlspecialchars($_POST['email']);
      $numberofattempts = $db->prepare("SELECT numberofattempts from admin WHERE email=:email");
      $numberofattempts->execute(array(
          "email"=>$email
          )
      );


      $rattempts = $numberofattempts->fetch(PDO::FETCH_OBJ);
      $recupnumberofattempts = $rattempts->numberofattempts;
      $newattempts = $recupnumberofattempts + '1';



      $updatenumberofattempts = $db->prepare("UPDATE admin SET numberofattempts=:newattempts WHERE email=:email");
      $updatenumberofattempts->execute(array(
          "newattempts"=>$newattempts,
          "email"=>$email
          )
      );
      ?>

      <script>
                        StartNotif("champs faux",'warning');
                     </script>

                     <?php
      }

      }else{
        ?>

            <script>
                        StartNotif("compte bloque",'warning');
                     </script>

        <?php
      }
      }else{
      ?>
            <script>
                        StartNotif("inconnu",'warning');
                     </script>
      <?php
                      }
         }else{
                      ?>
              <script>
                        StartNotif("faux",'warning');
                     </script>
<?php
    }
