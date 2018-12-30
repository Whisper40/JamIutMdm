<?php
require_once('../includes/connectBDD.php');


        $user_id = $_POST['user_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $formatimg = $_POST['formatimg'];
        $stock = $_POST['stock'];
        $datesejour = $_POST['datesejour'];
        $price = $_POST['price'];

        if($price>'0'){
          $payant = '1';
        }else{
          $payant = '0';
        }

        function slugify($text){
      		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

      		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      		$text = preg_replace('~[^-\w]+~', '', $text);

      		$text = trim($text, '-');

      		$text = preg_replace('~-+~', '-', $text);

      		$text = strtolower($text);

      		if (empty($text)) {
      		  return 'n-a';
      		}

        		return $text;
      	}
        $slug = slugify($title);




        if(!empty($user_id)&&!empty($title)&&!empty($description)&&!empty($formatimg)&&!empty($stock)&&!empty($datesejour)&&!empty($price)){
          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%d/%m/%Y %H:%M:%S');

          $insert = $db->prepare("INSERT INTO newsactus (title, slug, description, surname, date, formatimg, status, stock, datesejour, price, payant) VALUES(:title, :slug, :description, :surname, :date, :formatimg, :status, :stock, :datesejour, :price, :payant)");
          $insert->execute(array(
                              "title"=>$title,
                              "slug"=>$slug,
                              "description"=>$description,
                              "surname"=>'Activités / Voyages',
                              "date"=>$date,
                              "formatimg"=>$formatimg,
                              "status"=>'ACTIVE',
                              "stock"=>$stock,
                              "datesejour"=>$datesejour,
                              "price"=>$price,
                              "payant"=>$payant
                              )
                          );

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Ajout',
                                    "action"=>'Ajout d\'une Activités / Voyages',
                                    "page"=>'activitees.php',
                                    "date"=>$date
                                    )
                                );
                ?>

                    <script>
                    demo.showSwal('success-message');
                    demo.showNotification('top','right','<b>Succès</b> - L\'actualité à été crée !');
                    </script>

            <?php
            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Création non effectuée en raison de champs vides !');
                    </script>
            <?php
            }

    ?>
