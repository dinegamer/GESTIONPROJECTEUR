<?php
session_start();
 $login = '<span style="color:orange">INSCRIPTION</span>';
 $intecsup = '<span style="color:blue">INTECSUP G-PROJ</span>';
 $logo = $login . " " . $intecsup;
 include("../gestionProjecteur/administration/post.php");
 include("../gestionProjecteur/administration/ins/connexion.php");
 $erreur="";

 if(isset($envoie)) {
	 if(empty($nom)){
		 $erreur = "Nom laisse vide !<br>";
	 }
	 if(empty($prenom)){
		 $erreur .= "Prenom laisse vide !<br>";
	 }
	 if(empty($login)){
		$erreur .= "Login laisse vide !<br>";
	}
	if(empty($pass)){
		$erreur .= "Mot de passe laisse vide !<br>";
	}
	if($pass != $passConfirm){
		$erreur .= "Mot de passe laisse vide !<br>";
	}
	if(empty($erreur))
	{
		$ins = $db->prepare('INSERT INTO user(prenom,nom,login,pass) VALUES(?,?,?,?)');
		$ins->execute(array(
			$prenom,$nom,$username, md5($pass)
		));
		echo "Bravo, Inscription reussi";
	}
 }
 
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
<?php
echo '<div style="background-color: pink;">';
if(!empty($erreur)){
    echo $erreur;
}
echo'</div>';
?>
<div class="limiter">
<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
<div class="wrap-login100">
<form class="login100-form validate-form" method="POST">
	<span class="login100-form-logo">
		<i class="zmdi zmdi-landscape"></i>
	</span>
	
	<span class="login100-form-title p-b-34 p-t-27">

		<h1 style="font-family: Arial-Black, Helvetica, sans-serif;"><?=$logo;?></h1>
	</span>

	<div class="wrap-input100 validate-input" data-validate = "Entrer le prenom">
		<input class="input100" type="text" name="prenom" placeholder="Prenom">
		<span class="focus-input100" data-placeholder="&#xf207;"></span>
	</div>

	<div class="wrap-input100 validate-input" data-validate = "Entrer le nom">
		<input class="input100" type="text" name="nom" placeholder="nom">
		<span class="focus-input100" data-placeholder="&#xf207;"></span>
	</div>


	<div class="wrap-input100 validate-input" data-validate = "Entrer le login">
		<input class="input100" type="text" name="username" placeholder="Login">
		<span class="focus-input100" data-placeholder="&#xf207;"></span>
	</div>

	<div class="wrap-input100 validate-input" data-validate="Entrer le mot de passe">
		<input class="input100" type="password" name="pass" placeholder="Mot de passe">
		<span class="focus-input100" data-placeholder="&#xf191;"></span>
    </div>
    
    <div class="wrap-input100 validate-input" data-validate="Confirmer le mot de passe">
		<input class="input100" type="password" name="passConfirm" placeholder="Confirmer le mot de passe">
		<span class="focus-input100" data-placeholder="&#xf191;"></span>
	</div>

	<div class="contact100-form-checkbox">
		<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
		<!-- <label class="label-checkbox100" for="ckb1">
			Se souvenir de moi
		</label> -->
	</div>

	<div class="container-login100-form-btn">
		<input type="submit" value="Inscrire" class="login100-form-btn" name="envoie">
			
</input>
	</div>

	<div class="text-center p-t-90">
		<a class="txt1" href="#">
			Les meilleurs sont chez nous !
		</a>
	</div>
</form>
</div>
</div>
</div>


	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
<?=var_dump($_SESSION['afficher']);?>
</body>
</html>