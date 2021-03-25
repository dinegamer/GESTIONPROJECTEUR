<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="administration.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script
			  src="https://code.jquery.com/jquery-3.5.1.min.js"
			  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			  crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</head>
<?php
if($_SESSION['utilisateur'] == "kadi" || $_SESSION['utilisateur'] == "ousmane" || $_SESSION['utilisateur'] == "mariam") {
    include("ins/connexionAnnexe.php");
    
} 
else if($_SESSION['utilisateur'] == "maiga"){
    include("ins/connexionHippodrome.php");
}
else
    include("ins/connexion.php");
$nombreDeNotification = 0;
$query01 = $db->prepare("SELECT * FROM dashboard");
$query01->setFetchMode(PDO::FETCH_ASSOC);
$query01->execute();
$tableauDeDonnees = $query01->fetchAll();
$count = count($tableauDeDonnees);

$heure = date('H');
$minute = date('i');

if($heure == 12 && $minute >= 20 || $heure == 14 && $minute >= 30 || $heure == 21 && $minute >= 5){
    if($count > 0) { 
        
$salutation = (date('H') >= 17) ? 'Bonsoir ' : 'Bonjour ';
if($salutation == 'Bonjour '){
    $image = '<img src="images/sun.jpeg" alt="" width=70px>';
}
else if($salutation == 'Bonsoir '){
    $image = '<img src="images/moon.jpeg" alt="" width=70px>';
}
?>

<body>
    <div class="row" id="main" >
        <div class="col-sm-12 col-md-12 well" id="content">
             <h1 style="text-align:center"><?= $salutation . $_SESSION['admin'] . $image;?>!</h1>
             <h1 style="text-align:center">Notifications</h1>
             <h3><strong><i class="fas fa-info"></i>Vous trouverez ci-dessous une liste des 
             etudiants n'ayant pas ramene de projecteur apres 14h35 ou 21h05!</strong></h3>
        </div>
    </div>
    <table class="table table-bordered table-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Alertes</th>
            </tr>
        </thead>
        <tbody>
        <?php for($i = 0; $i < $count; $i++) {?>
            <tr>
                <th scope="row"><?=date('d/m/Y')?></th>
                <td class="table-danger"><p style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
                <strong>L'etudiant 
                    <?=$tableauDeDonnees[$i]['prenom'] . ' ' ?>
                    <?=$tableauDeDonnees[$i]['nom'] . 'en '?>
                    <?=$tableauDeDonnees[$i]['filiere'] . ' n\'a pas ramene son projecteur dont
                    le numero est '?> <?=$tableauDeDonnees[$i]['numProjecteur'] . ' veuillez
                    verifier la salle '?> <?=$tableauDeDonnees[$i]['salle'] . ' ou l\' appeler au
                     '?>  <?=$tableauDeDonnees[$i]['telephone'] . ' '?></strong>
                <p>

                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
   
</body>
</html>
<?php
    }
else{
    
    ?>
    <div class="jumbotron">
  <p class="lead">
      Cette page n'est disponible que lorsque, apres 14h 30 ou 21h 05 il y a des projecteurs qui manquent.
     <br>
    Vous serez notifie en cas d'absence de projecteur mais vous devez reste connecte et vigilant, aussi
    vous devez checker et verifier le nombre total de vos projecteur
    </p>
  <hr class="my-4">
  <p>Ce message est juste un canevas.</p>
  <p class="lead">
  </p>
</div>
<?php
} 

}
else{
    
    ?>
    <div class="jumbotron">
  <p class="lead">
      Cette page n'est disponible que lorsque, apres 14h 30 ou 21h 05 il y a des projecteurs qui manquent.
     <br>
    Vous serez notifie en cas d'absence de projecteur mais vous devez reste connecte et vigilant, aussi
    vous devez checker et verifier le nombre total de vos projecteur
    </p>
  <hr class="my-4">
  <p>Ce message est juste un canevas.</p>
  <p class="lead">
  </p>
</div>
<?php
}
