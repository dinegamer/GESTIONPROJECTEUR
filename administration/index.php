<?php
session_start();
unset($_SESSION['identifiant']);
if(@$_SESSION['afficher'] != "oui"){
    header('Location:../index.php');
    exit();
}
$salutation = (date('H') >= 17) ? 'Bonsoir ' : 'Bonjour ';
if($salutation == 'Bonjour '){
    $image = '<img src="images/sun.jpeg" alt="" width=70px>';
}
else if($salutation == 'Bonsoir '){
    $image = '<img src="images/moon.jpeg" alt="" width=70px>';
}
if($_SESSION['utilisateur'] == "kadi" || $_SESSION['utilisateur'] == "ousmane" || $_SESSION['utilisateur'] == "mariam") {
    include("ins/connexionAnnexe.php");
    
} 
else if($_SESSION['utilisateur'] == "maiga"){
    include("ins/connexionHippodrome.php");
}
else
    include("ins/connexion.php");
    

    $query = $db->prepare("SELECT * FROM filieres");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    $tab = $query->fetchAll();
    $query->closeCursor();

    $query2 = $db->prepare("SELECT * FROM etudiants");
    $query2->setFetchMode(PDO::FETCH_ASSOC);
    $query2->execute();
    $tab2 = $query2->fetchAll();
    $query2->closeCursor();

    $query3 = $db->prepare("SELECT * FROM projecteur");
    $query3->setFetchMode(PDO::FETCH_ASSOC);
    $query3->execute();
    $projecteurs = $query3->fetchAll();
    $query3->closeCursor();

    $query4 = $db->prepare("SELECT * FROM composant");
    $query4->setFetchMode(PDO::FETCH_ASSOC);
    $query4->execute();
    $composants = $query4->fetchAll();
    $query4->closeCursor();

    $query5 = $db->prepare("SELECT * FROM salle");
    $query5->setFetchMode(PDO::FETCH_ASSOC);
    $query5->execute();
    $salles = $query5->fetchAll();
    $query5->closeCursor();

    $queryCours = $db->prepare("SELECT * FROM cours");
    $queryCours->setFetchMode(PDO::FETCH_ASSOC);
    $queryCours->execute();
    $tabCours = $queryCours->fetchAll();
    $queryCours->closeCursor();

    // $query6 = $db->prepare("SELECT * FROM user WHERE prenom=?");
    // $query6->setFetchMode(PDO::FETCH_ASSOC);
    // $query6->execute($_SESSION['admin']);
    // $admin = $query6->fetchAll();
    // $query6->closeCursor();

    include("post.php");
    $erreur = "";
    $n = 0;
    if(isset($envoie))
    {
        $_SESSION['n'] = $n++;
        if(empty($nom))
        {
            $erreur = "Champ nom laisse vide !<br>";
        }
        if(empty($prenom))
        {
            $erreur .= "Champ prenom laisse vide !<br>";
        }
        if(empty($numProjecteur))
        {
            $erreur .= "Champ numero projecteur laisse vide !<br>";
        }
        if(empty($composantes))
        {
            $erreur .= "Champ composants laisse vide !<br>";
        }
        if(empty($quantiteRallonge))
        {
            $erreur .= "Champ quantite de rallonges laisse vide !<br>";
        }
        if(empty($filiere))
        {
            $erreur .= "Champ filiere laisse vide !<br>";
        }
        if(empty($salle))
        {
            $erreur .= "Champ salle laisse vide !<br>";
        }
        if(empty($heureDebut))
        {
            $erreur .= "Champ heure de debut laisse vide !<br>";
        }
        if(empty($cours))
        {
            $erreur .= "Champ cours laisse vide !<br>";
        }
        
       
        if(empty($erreur)){
        @$_SESSION['autorisation'] = "oui";
        @$_SESSION['nom'];
        @$_SESSION['prenom'];
        @$_SESSION['filiere'];
        @$_SESSION['salle'];
        @$_SESSION['cours'];
        @$_SESSION['numProjecteur'];
        @$_SESSION['composants'];
        @$_SESSION['quantiteRallonge'];
        @$_SESSION['telephone'];

    $query00 = $db->prepare("SELECT num FROM dashboard");
    $query00->setFetchMode(PDO::FETCH_ASSOC);
    $query00->execute();
    $tab00 = $query00->fetchAll();
    $query00->closeCursor();
        @$_SESSION['identifiant'] = 1;
       
       for($l = 0; $l < count($tab00); $l++) {
           $n = $l+1;
           
            @$_SESSION['identifiant'] = ++$n;
       }

        // @$_SESSION[''];
        // @$_SESSION['nom'];
        header("Location:insertion.php");
        }
        if($_SESSION['autorisation'] != "oui")
        {
            header("Location:index.php");
            exit();
        }
    }
   

    

?>
<?php



$heure = date('H');
$minute = date('i');

if($heure == 12 && $minute >= 20 || $heure == 14 && $minute >= 30 || $heure == 21 && $minute >= 05){
    
    @$nombreDeNotification = 0;
    $query01 = $db->prepare("SELECT * FROM dashboard");
    $query01->setFetchMode(PDO::FETCH_ASSOC);
    $query01->execute();
    $tableauDeDonnees = $query01->fetchAll();
    $count = count($tableauDeDonnees);
    
// function isMinuteChanged(&$rowsCount) {
//     $currentRows = 0;
//     if ( $rowsCount > $currentRows ) {
//     //   $rowsCount = $currentRows;
//       return true;
//     }
//     return false;
//   }


//   // Retourne des données uniquement
//   // si la minute change, sinon boucle
//   if(isMinuteChanged($count)) {
    if($count > 0)
        $nombreDeNotification ++;
    else{
        $nombreDeNotification = 0;
    }
    
//   } 
//   else{
//       $nombreDeNotification = 0;
//   }
 
  // Pause de 3s
//   sleep(3);
} 
header("Refresh:3600"); // Refreshes after 2 seconds
?>

<html>
<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu principal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">  
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="administration.css">


    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script
src="https://code.jquery.com/jquery-3.5.1.min.js"
integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
<script src="administration.js"></script>
<script type="text/javascript" src="jquery-1.4.4.min.js"></script>;
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/jquery.timeago.fr.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$(".timeago").timeago();
});
</script>

<script type="text/javascript">
  function callComplete(response) {
    $("#textDiv").empty();
    $("#textDiv").append(response);
    connect();
  };
 
  function connect() {
    $.post('longPolling.php', {}, callComplete, 'json');
  };
 
  $(document).ready( function() {
    $("#textDiv").empty();
    connect();
  });
</script>

<!-- <div id="textDiv" style="width:100%; height:100%; overflow:auto; border:solid 1px black;"> -->
<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img id="brand" src="http://placehold.it/200x50&text=INETCSUP" alt="INTECSUP">
                
            </a>
            <img class="brandImg" src="images/logo.png" height="50px" alt="logoIntec">
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li><a href="#" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bar-chart-o"></i>
                </a>
            </li>            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin User <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu">
               <li><a class="dropdown-item" href="profile.php"><i class="glyphicon glyphicon-user"></i> Mon Profile</a></li>
                    <li class="divider"></li>
                 <li><a class="dropdown-item" href="ins/enregistrer.php"><i class="fa fa-pencil" aria-hidden="true"></i>Enregistrer des donnees</a></li>
                 <li class="divider"></li>
                    <li><a href="deconnexion.php"><i class="fa fa-fw fa-power-off"></i>Se deconnecter</a></li>
                    
                </ul>
            </li>
            


        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="dashboard.php"><i class="fa fa-fw fa-search"></i>TABLEAU DE BORD</a>

                </li>
                <li>
                    <a href="journal.php"><i class="fas fa-newspaper">JOURNAL</i></a>
                </li>
                <li>
                    <a class="notification" href="notifications.php" id="notifications"><i class="fas fa-bell">
                        NOTIFICATIONS</i><span class="badge"><?=@$nombreDeNotification?></span>
                                 </a>
                </li>
                <li>
                    <a href="stock.php"><i class="fas fa-cart-arrow-down">GESTION DE STOCK</i></a>
                </li>
                <li>
                    <a href="infos.php"><i class="fas fa-info">INFOS DU PROJET</i></a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
<!-- </div> -->
<div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row" id="main" >
                <div class="col-sm-12 col-md-12 well" id="content">
                    <h1><?= $salutation . $_SESSION['admin'] . $image;?>!</h1>
                </div>
            </div>
            <form method="POST">
            <div class="form-group col-sm-2 my-1">
                <label for="exampleFormControlSelect1">Nom</label>
                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="nom">
                <?php
                    for($i = 0; $i < count($tab2); $i++) {
                       

                        echo "<option>" . $tab2[$i]["nom"] . "</option>";
                        echo "<br/>";
                    }
                    @$_SESSION['nom'] = $nom;
                    ?>
                </select>
            </div>
            <div class="form-group col-sm-2 my-1">
                <label for="exampleFormControlSelect1">Prenom(s)</label>
                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="prenom">
                <?php
                    for($i = 0; $i < count($tab2); $i++) {
                        echo "<option>" . $tab2[$i]["prenom"] . "</option>";
                        echo "<br/>";
                    }
                    @$_SESSION['prenom'] = $prenom;
                    ?>
                </select>
            </div>
            <div class="form-group col-sm-2 my-1">
                <label for="exampleFormControlSelect1">Projecteur Numero</label>
                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="numProjecteur">
                <?php
                    for($i = 0; $i < count($projecteurs); $i++) {
                        echo "<option>" . $projecteurs[$i]["numSerie"] . "</option>";
                        echo "<br/>";
                    }
                    @$_SESSION['projecteurNumero'] = $numProjecteur;

                    ?>
                </select>
            </div>
            <div class="form-group col-sm-2 my-1">
                <label for="exampleFormControlSelect1">Composants</label>
                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="composantes">
                <?php
                    for($i = 0; $i < count($composants); $i++) {
                        echo "<option>" . $composants[$i]["libele"] . "</option>";
                        echo "<br/>";
                    }
                    @$_SESSION['composants'] = @$composantes;
                    ?>
                </select>
            </div>
            <div class="form-group col-sm-2 my-1">
                <label for="exampleFormControlSelect1">Qte rallonge</label>
                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="quantiteRallonge">
                <option>zero</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <?php @$_SESSION['quantiteRallonge'] = @$quantiteRallonge;?>
                </select>
            </div>
            <div class="form-group col-sm-2 my-1">
                <label for="exampleFormControlSelect1">Filiere</label>
                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="filiere">
                <?php
                    for($i = 0; $i < count($tab); $i++) {
                        echo "<option>" . $tab[$i]["nom"] . "</option>";
                        echo "<br/>";
                    }
                    @$_SESSION['filiere'] = @$filiere;

                    ?>
                </select>
            </div>
            <div class="form-group col-sm-2 my-1">
                <label for="exampleFormControlSelect1">Salle</label>
                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="salle">
                <?php
                    for($i = 0; $i < count($tab); $i++) {
                        echo "<option>" . $salles[$i]["libele"] . "</option>";
                        echo "<br/>";
                    }
                    @$_SESSION['salle'] = @$salle;

                    ?>
                </select>
            </div>
            <div class="form-group col-sm-2 my-1">
                <label for="exampleFormControlSelect1">heure deb</label>
                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="heureDebut">
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>  
                </select>
            </div>

            <div class="form-group col-sm-2 my-1">
                <label for="exampleFormControlSelect1">Cours</label>
                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="cours">
                <?php
                    for($i = 0; $i < count($tabCours); $i++) {
                        echo "<option>" . $tabCours[$i]["temps"] . "</option>";
                        echo "<br/>";
                    }
                    @$_SESSION['cours'] = @$cours;
                    ?>
                </select>
            </div>

            <div class="form-group col-sm-2 my-1">
                <label for="exampleFormControlSelect1">Telephone</label>
                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="telephone">
                <?php
                    for($i = 0; $i < count($tab2); $i++) {
                        echo "<option>" . $tab2[$i]["telephone"] . "</option>";
                        echo "<br/>";
                    }
                    @$_SESSION['telephone'] = @$telephone;
                    ?>
                </select>
            </div>

            <input  type="submit" value="Emprunter" name="envoie" id="bouton">
            </form>
              
            <!-- /.row -->
        </div>
      
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div><!-- /#wrapper -->

</body>
</html>

 
  
</body>
</html>



<?php

?>