<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $nom = mb_strtoupper($_POST['nom']);
        $prenom = mb_strtoupper($_POST['prenom']);
        $code = $_POST['code'];
        $raison = $_POST['raison'];
        $email = $_POST['email'];

      if(!empty($user_id)&&!empty($nom)&&!empty($prenom)&&!empty($code)&&!empty($raison)&&!empty($email)){


                $insert = $db->prepare("INSERT INTO etud (numero, nom, prenom) VALUES (:numero, :nom, :prenom)");
                $insert->execute(array(
                    "numero"=>$code,
                    "nom"=>$nom,
                    "prenom"=>$prenom
                    )
                );

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Ajout',
                                    "action"=>'Ajout d\'un utilisateur externe',
                                    "page"=>$raison,
                                    "date"=>$date
                                    )
                                );



                                 //owner = le mail de la personne
                                   $priority = '1';
                                   $owner_mail = 'contact@jam-mdm.fr';
                                   $message = 'MESSAGE A FAIRE';
                                   $subject = '[JAM]'.'[Inscription]';
                                 if($subject&&$email&&$message){

                                       $filename = $_FILES['attachment']['name'];
                                       $file = $_FILES['attachment']['tmp_name'];
                                       $content = file_get_contents( $file);
                                       $content = chunk_split(base64_encode($content));
                                       $uid = md5(uniqid(time()));
                                       $name = basename($file);
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
                                       $nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
                                       $nmessage .= "Content-Transfer-Encoding: base64\r\n";
                                       $nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
                                       $nmessage .= $content."\r\n\r\n";
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
                  demo.showNotification('top','right','<b>Erreur</b> - Modification non effectués en raison de champs vides !');
                  </script>
          <?php

            }

    ?>
