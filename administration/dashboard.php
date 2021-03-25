<?php

    session_start();
    @$image;
    if($_SESSION['utilisateur'] == "kadi" || $_SESSION['utilisateur'] == "ousmane" || $_SESSION['utilisateur'] == "mariam") {
        include("ins/connexionAnnexe.php");
        
    } 
    else if($_SESSION['utilisateur'] == "maiga"){
        include("ins/connexionHippodrome.php");
    }
    else
        include("ins/connexion.php");
    $salutation = (date('H') >= 17) ? 'Bonsoir ' : 'Bonjour ';
    if($salutation == 'Bonjour '){
        $image = '<img src="images/sun.jpeg" alt="" width=70px>';
    }
    else if($salutation == 'Bonsoir '){
        $image = '<img src="images/moon.jpeg" alt="" width=70px>';
    }
    $query3 = $db->prepare("SELECT * FROM dashboard");
    $query3->setFetchMode(PDO::FETCH_ASSOC);
    $query3->execute();
    $tab3 = $query3->fetchAll();
    $query3->closeCursor();
    if(count($tab3) == 0){
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
          <p class="lead">Aucun n'emprunt n'a ete effectue aujourd'hui, ou vous les avez supprimes.</p>
          <hr class="my-4">
          <p>Veuillez effectuer des emprunts en cliquant sur le lien en bas</p>
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="index.php" role="button">Emprunt de projecteurs</a>
          </p>
        </div>
     <?php
     exit();  
    }

    

    $nbr = 0;
    $tmp;
    if(!empty('envoie'))
{
   
    if((date('H') >= 14 && date('i') == 33) || date('H') == 7 && date('i') == 10 ){
        $ins = $db->prepare("DELETE FROM dashboard");
            $ins->execute();
        }
    
    @$a = $_SESSION['prenom'];
    @$b = $_SESSION['nom'];
    @$c = $_SESSION['filiere'];
    @$d = $_SESSION['cours'];
    @$e = $_SESSION['salle'];
    @$f = $_SESSION['projecteurNumero'];
    @$g = $_SESSION['composants'];
    @$h = $_SESSION['quantiteRallonge'];
    @$i = $_SESSION['phone'];


    $query = $db->prepare("SELECT * FROM dashboard");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    $tab = $query->fetchAll();
    $query->closeCursor();

    // if(isset($_POST['envoie']) && isset($_POST['ok0'])) {
       
    //     unset($_SESSION['time']);
    //    @$_SESSION['valider'] = "oui";
    //     header('Location:journal.php');
    // }

    if(isset($_POST['envoie']))
    $m = 0;
{
    for($i = 0; $i < count($tab); $i++){
        $n = $i+1;

        if(isset($_POST["ok$i"])) {

             @$_SESSION['id'] .= $tab[$i]['num'];
            @$_SESSION['id'] .= ',';
            @$_SESSION['numClick'] = $_SESSION['id'] . " ";

            // @$_SESSION['numClick'] .= $n;
            // $_SESSION['numClick'] .= ',';
        }

        if(!empty($_POST["ok$i"])){
            // @$_SESSION['id'] .= $n;
            // @$_SESSION['id'] .= ',';
            $m++;

            $_SESSION['ok'] = $i;

            // @$_SESSION['id'] .= $n;
            // @$_SESSION['id'] .= ','; 
            unset($_SESSION['time']);
            // unset($_SESSION['numClick']);
           
            
           
                
            @$_SESSION['valider'] = "oui";
            @$_SESSION['limit'] = $m;
            @header('Location:journal.php');
        }
        
    }
    // unset($_SESSION['groupe']);
}

    
    

    
    
    
   

   

    $query2 = $db->prepare("SELECT * FROM heureRetour");
    $query2->setFetchMode(PDO::FETCH_ASSOC);
    $query2->execute();
    $tab2 = $query2->fetchAll();
   
    
    
}   
else {
    header("Location:index.php");
    exit();
}
  

    
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
             <h1 style="text-align:center"> <h1><?= $salutation . $_SESSION['admin'] . $image;?>!</h1>
             <h3 style="text-align:center">Tableau de bord</h3>
             <p><strong><i class="fas fa-info"></i>Veuillez s'il vous plait verifier
              le contenu des sacs avant de valider!</strong></p>
        </div>
    </div>
    <form action="" method="POST">
    <table class="table table-bordered">
        <thead class="thead-dark">
            
            <tr>
                <!-- <th scope="col">numero#</th> -->
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
                <th scope="col" class="clickable-row">Heure de retour</th>
                <th scope="col">COMPLET?</th>
                <th scope="col">Matricule</th>
            </tr>
        </thead>
        <tbody>
        
        <?php
                       
                       $_SESSION['loop'] = count($tab);
                  
                for($i = 0; $i < count($tab); $i++) {
                   $ok = $i;
                   $z=$i+1;
                   
            ?>
            <tr>
            
                <!-- <th scope="row">1</th> -->
                
                <!-- <td> -->
                    <?php
                        @$_SESSION['num'] = $tab[$i]['num'];
                          
                        // $nbr = ++$nbr;
                        // $_SESSION['id']++;
                        
                    //    echo $nbr;
                       
                       @$_SESSION['groupe'] = $_SESSION['id'] . " ";

                      
                    ?>
                <!-- </td> -->
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
                echo $tab[$i]['telephone'];
                ?>
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
                <td><?=date('d-m-Y')?></td>
                <td>
                
                <select class="form-control col-sm-8 form-control-sm" id="exampleFormControlSelect1" name=<?=$i?>>
                <?php
                for($j = 0; $j < count($tab2); $j++){
                    
                        echo '<option>' . $tab2[$j]['retour'] . '</option>';            
                }
                ?>
                
                
                </select>   
               
                </td>
               
                <td>
                <input type="checkbox" class="complet" name="ok<?=$i?>" value="ok">COMPLETS?
                
                </td>
                <td>
                <a class="btn btn-danger" href="delete.php?id='<?=$tab[$i]['id'];?>'">Supprimer</a>
                </td>
               
            </tr>
            
            <?php
                @$_SESSION['time'] .= $_POST[$i] . " ";
                
              
                  
            }
         
            ?>
           
            
        </tbody>
    </table>
                    
                    
                <input  type="submit" value="Valider" name="envoie" id="bouton">
                </form>

                <?php
                if(isset($_POST['envoie']))
                {
                   
                   $db = null;
                   exit(
                       '<h3 class="alert alert-danger"><strong><i class="fas fa-info alert alert-danger"></i>Veuillez s\'il vous plait cocher sur la case COMPLET? apres reception des sacs et verification des materiels puis cliquez sur valider!<br>
      Assurez-vous qu\'il soit 14h ou 21h
      </strong></h3>');
            
                }
                echo @$_SESSION['numClick'] . '<br>';
                echo $_SESSION['groupe'];
                    // session_destroy();
                    // unset($_SESSION['id']);
                ?>
                   
</body>
</html>

    