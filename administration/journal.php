<?php
session_start();
header("Refresh: 14000"); // Refreshes after 2 seconds
$tableauCompte = explode(",", @$_SESSION['numClick']);

$salutation = (date('H') >= 17) ? 'Bonsoir ' : 'Bonjour ';
if($salutation == 'Bonjour '){
    $image = '<img src="images/sun.jpeg" alt="" width=70px>';
}
else if($salutation == 'Bonsoir '){
    $image = '<img src="images/moon.jpeg" alt="" width=70px>';
}


$nbr = 0;
   @ $tabHeure = explode(" ", $_SESSION['time']);
    // echo $tabHeure[0]. " ". $tabHeure[1];
    
if(!isset($_SESSION['valider']) || $tableauCompte = '' ) {
    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="administration.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
    <script
			  src="https://code.jquery.com/jquery-3.5.1.min.js"
			  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			  crossorigin="anonymous"></script>
<div class="jumbotron">
  <h1 class="display-4"><?= $salutation . $_SESSION['admin'] . $image;?>!</h1>
  <p class="lead">
      Cette page n'est disponible que lorsque la verification des projecteurs est effectuee en verifiant
      et cliquant sur la case COMPLET? et le bouton valider.<br>
      La Journalisation est automatiquement supprime a 00h.
    </p>
  <hr class="my-4">
  <p>Ce message est juste un canevas. Pour voir la Journalisation il vous faudra valider le checking en cliquant sur le lien en bas</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="dashboard.php" role="button">Tableau de bord des projecteurs</a>
  </p>
</div>
<?php

exit();
} 

if($_SESSION['utilisateur'] == "kadi" || $_SESSION['utilisateur'] == "ousmane" || $_SESSION['utilisateur'] == "mariam") {
    include("ins/connexionAnnexe.php");
    
} 
else if($_SESSION['utilisateur'] == "maiga"){
    include("ins/connexionHippodrome.php");
}
else
    include("ins/connexion.php");

    // if(date('H') >= 22 || date('H') < 7){
    //     $ins = $db->prepare("DELETE FROM dashboard");
    //         $ins->execute();
    //     }
       
        @$_SESSION['groupe'] = substr($_SESSION['numClick'], 0, strlen($_SESSION['numClick'])-1);
        @$_SESSION['numClick'] = substr($_SESSION['groupe'], 0, strlen($_SESSION['groupe'])-1);

        // echo $_SESSION['groupe'];


    if(!empty($_SESSION['ok']) || isset($_SESSION['ok']))
    {
        $query = $db->prepare('SELECT * FROM dashboard');
        $query->setFetchMode(PDO::FETCH_ASSOC);
        @$query->execute();
        $tab = $query->fetchAll();
        $query->closeCursor();
        $tableau = explode(",", $_SESSION['numClick']);
        
        for($i = 0; $i < count($tableau); $i++){
        @$requete = $db->prepare('INSERT INTO journal(num,nom,prenom,filiere,salle,cours,
        numProjecteur,composant,quantiteRallonge,telephone) SELECT DISTINCT num,nom,prenom,filiere,salle,cours,
        numProjecteur,composant,quantiteRallonge,telephone FROM dashboard
        WHERE id = ? ');
        @$requete->execute(array($tab[$i]['id']));
      

        

        @$ins = $db->prepare('DELETE FROM dashboard WHERE
        num IN (?)');
        @$ins->execute(array($tableau[$i]));
        }
    }
  
    
    

    $query = $db->prepare('SELECT * FROM journal');
    $query->setFetchMode(PDO::FETCH_ASSOC);
    @$query->execute();
    $tab = $query->fetchAll();
    $query->closeCursor();

    $query2 = $db->prepare("SELECT * FROM heureRetour");
    $query2->setFetchMode(PDO::FETCH_ASSOC);
    $query2->execute();
    $tab2 = $query2->fetchAll();

    
  
   
    

   

    
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</head>
<body>
<div class="row" id="main" >
        <div class="col-sm-12 col-md-12 well" id="content">
             <h1 style="text-align:center"><?= $salutation . $_SESSION['admin'] . $image;?>!</h1>
             <h1 style="text-align:center">Journalisation</h1>
             <h3><strong><i class="fas fa-info"></i>Journalisation des emprunts</strong></h3>
        </div>
    </div>
    <table class="table table-striped table-hover table-dark table-sm">
        <thead class="thead-light">
            <tr>
                <th scope="col">numero#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom(s)</th>
                <th scope="col">Telephone</th>
                <th scope="col">Filiere</th>
                <th scope="col">Salle</th>
                <th scope="col">Cours</th>
                <th scope="col">Projecteur num</th>
                <th scope="col">Composants</th>
                <th scope="col">Qte rallonge</th>
                <th scope="col">Date et heure</th>
                <th scope="col">Retour?</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
                       
                for($i = 0; $i < count($tab); $i++) {
                   $ok = $i;
            ?>
            <tr class="table-active">
               
                <td>
                    <?php
                        $_SESSION['num'] = $tab[$i]['num'];
                       echo ++$nbr;
                    ?>
                </td>
                <td>
                    <?php
                    $_SESSION['lastName'] = $tab[$i]['nom'];
                    echo $tab[$i]['nom'];
                    ?>
                </td>
                <td>
                <?php
                $_SESSION['firstName'] = $tab[$i]['prenom'];
                echo $tab[$i]['prenom'];?>
                </td>
                <td>
                <?php
                $_SESSION['phone'] = $tab[$i]['telephone'];
                echo $tab[$i]['telephone'];?>
                </td>
                <td>
                <?php
                $_SESSION['classe'] = $tab[$i]['filiere'];
                echo $tab[$i]['filiere'];?>
                </td>
                <td>
                <?php
                $_SESSION['classRoom'] = $tab[$i]['salle'];
                echo $tab[$i]['salle'];
                ?>
                </td>
                <td>
                <?php
                $_SESSION["course"] = $tab[$i]['cours'];
                echo $tab[$i]['cours'];
                ?>
                </td>
                <td>
                <?php
                $_SESSION['projector'] = $tab[$i]['numProjecteur'];
                echo $tab[$i]['numProjecteur'];
                ?>
                </td>
                <td>
                <?php
                $_SESSION['component'] = $tab[$i]['composant'];
                echo $tab[$i]['composant'];
                ?>
                </td>
                <td>
                <?php
                $_SESSION['ral'] = $tab[$i]['quantiteRallonge'];
                echo $tab[$i]['quantiteRallonge'];
                ?>
                </td>
                <td><?=date('d-m-Y');?></td>
                <td>
                    OUI
                   
                </td>
                
            </tr>
            <?php
           
               
                  
            }

            unset($_SESSION['numClick']);
            // unset($_SESSION['num']);
            unset($_SESSION['id']);
            ?>
        </tbody>
    </table>
    <h1 style="text-align:center"><a class="btn btn-danger" href="truncate.php">Supprimer</a></h1>

</body>
</html>
