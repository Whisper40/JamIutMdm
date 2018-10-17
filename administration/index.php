    <?php

   try{

	$db = new PDO('mysql:host=127.0.0.1;dbname=siteassociation', 'admin','ENTRERVOTREMDP');
	$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // les noms de champs seront en caractères minuscules
	$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); // les erreurs lanceront des exceptions
	$db->exec('SET NAMES utf8');
}

catch(Exception $e){

	die('Veuillez vérifier la connexion à la base de données');

}
   ?>

   <!doctype html>
   <html lang="fr">
   <head>
   	<meta charset="utf-8" />
   	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
   	<link rel="icon" type="image/png" href="../assets/img/favicon.png">
   	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

   	<title>Rt & Co - Costumes sur mesure</title>

   	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

   	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
   	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

       <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
       <link href="../assets/css/material-kit.css?v=1.1.0" rel="stylesheet"/>
   </head>
   <body class="login-page">
   	<div class="page-header header-filter" style="background-image: url('http://costumes.smart.fr/site/images/normal/RoyRobson4jpg_598427d005f39.jpg'); background-size: cover; background-position: top center;">
   		<br>
   		<br>

      <?php


    $username = $password = "";
    $username_err = $password_err = "";
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = 'Please enter username.';
        } else{
            $username = trim($_POST["username"]);
        }
        // Check if password is empty
        if(empty(trim($_POST['password']))){
            $password_err = 'Please enter your password.';
        } else{
            $password = trim($_POST['password']);
        }
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT username, password FROM admin WHERE username = :username";
            if($stmt = $db->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
             // Set parameters
                $param_username = trim($_POST["username"]);
              // Attempt to execute the prepared statement
                if($stmt->execute()){

                    // Check if username exists, if yes then verify password
                    if($stmt->rowCount() == 1){

                        if($row = $stmt->fetch()){

                            $hashed_password = $row['password'];
                            if($hashed_password==$password){
                         /* Password is correct, so start a new session and

                                save the username to the session */

                                session_start();
                                $_SESSION['username'] = $username;
                                header("location: admin.php");
                            }
                            else{

                              echo '<div class="container">
                      				<div class="row">

                      				<div class="alert alert-warning">
                      				 <div class="alert-icon">
                      					<i class="material-icons">warning</i>
                      				</div>
                      				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      					<span aria-hidden="true"><i class="material-icons">clear</i></span>
                      				</button><center>
                      								 <b>Attention Alert :</b> Mot de passe incorrect</center>
                      				</div>


                      	              </div>
                      	              </div>';

                                $password_err = 'The password you entered was not valid.';
                            }

                        }

                    } else{

                        echo '<div class="container">
                				<div class="row">

                				<div class="alert alert-warning">
                				 <div class="alert-icon">
                					<i class="material-icons">warning</i>
                				</div>
                				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                					<span aria-hidden="true"><i class="material-icons">clear</i></span>
                				</button><center>
                								 <b>Attention Alert :</b> Identifiant incorrect</center>
                				</div>


                	              </div>
                	              </div>';

                        $username_err = 'No account found with that username.';
                    }

                } else{

                    echo '<div class="container">
            				<div class="row">

            				<div class="alert alert-warning">
            				 <div class="alert-icon">
            					<i class="material-icons">warning</i>
            				</div>
            				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            					<span aria-hidden="true"><i class="material-icons">clear</i></span>
            				</button><center>
            								 <b>Attention Alert :</b> Oops ! Une erreur est survenue. Merci de réessayer.</center>
            				</div>


            	              </div>
            	              </div>';
                }

            }
            // Close statement
            unset($stmt);
        }

        // Close connection
        unset($pdo);
    }

    ?>

    <div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
					<div class="card card-signup">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="header header-primary text-center">
								<h4 class="card-title">Connectez-vous</h4>
							</div>
							<p class="description text-center">Merci de completer les champs ci-dessous.</p>
							<div class="card-content">

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">face</i>
									</span>
									<input type="text" name="username" class="form-control" placeholder="Pseudo"/>
								</div>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">lock_outline</i>
									</span>
									<input type="password" name="password" placeholder="Mot de passe" class="form-control"/>
								</div>

							</div>
							<div class="footer text-center">
								<input name="submit" type="submit" class="btn btn-primary btn-simple btn-wd btn-lg"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<footer class="footer">
	        <div class="container">
	            <div class="copyright pull-center">
								Copyright &copy; <script>document.write(new Date().getFullYear())</script> Réseau et Télécommunication - Mont de Marsan - 2018
	            </div>
	        </div>
	    </footer>

</body>
<!--   Core JS Files   -->
<script src="../assets/js/jquery.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/material.min.js"></script>

<!--    Plugin for Date Time Picker and Full Calendar Plugin   -->
<script src="../assets/js/moment.min.js"></script>

<!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/   -->
<script src="../assets/js/nouislider.min.js" type="text/javascript"></script>

<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker   -->
<script src="../assets/js/bootstrap-datetimepicker.js" type="text/javascript"></script>

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="../assets/js/bootstrap-selectpicker.js" type="text/javascript"></script>

<!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/  -->
<script src="../assets/js/bootstrap-tagsinput.js"></script>

<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput   -->
<script src="../assets/js/jasny-bootstrap.min.js"></script>

<!--    Plugin For Google Maps   -->
<script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!--    Plugin for 3D images animation effect, full documentation here: https://github.com/drewwilson/atvImg    -->
<script src="../assets/js/atv-img-animation.js" type="text/javascript"></script>

<!--    Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc    -->
<script src="../assets/js/material-kit.js?v=1.1.0" type="text/javascript"></script>

<!-- Fixed Sidebar Nav - JS For Demo Purpose, Don't Include it in your project -->
<script src="../assets/assets-for-demo/modernizr.js" type="text/javascript"></script>
<script src="../assets/assets-for-demo/vertical-nav.js" type="text/javascript"></script>

<!-- Demo Purpose, JS For Demo Purpose, Don't Include it in your project -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script type="text/javascript">
  var $section_features = '';
  $().ready(function(){

  });
</script>

<script type="text/javascript">

  $(document).ready(function(){
    var slider = document.getElementById('sliderRegular');

        noUiSlider.create(slider, {
            start: 40,
            connect: [true,false],
            range: {
                min: 0,
                max: 100
            }
        });

        var slider2 = document.getElementById('sliderDouble');

        noUiSlider.create(slider2, {
            start: [ 20, 60 ],
            connect: true,
            range: {
                min:  0,
                max:  100
            }
        });



    materialKit.initFormExtendedDatetimepickers();

  });
</script>
</html>
