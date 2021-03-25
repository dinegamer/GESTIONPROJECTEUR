<?php
    include("connexion.php");
    $query = $db->prepare("SELECT * FROM filieres");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    $tab = $query->fetchAll();
    $erreur = "";
    include("post.php");
    if(isset($envoie))
    {
       if(empty($prenom)){
           $erreur = "Le champ prenom a ete laisse vide !<br>";
       }
       if(empty($nom)){
        $erreur .= "Le champ nom a ete laisse vide !<br>";
      }
      if(empty($filiere)){
        $erreur .= "Le champ filiere a ete laisse vide !<br>";
    }
    if(empty($telephone)){
        $erreur .= "Le champ prenom a ete laisse vide !<br>";
    }
    if(empty($cours)){
        $erreur .= "Le champ cours a ete laisse vide !<br>";
    }
    if(empty($site)){
        $erreur .= "Le champ site a ete laisse vide !<br>";
    }
    if(empty($gender)){
        $erreur .= "Le champ sexe a ete laisse vide !<br>";
    }
    if(empty($erreur)){
        $ins = $db->prepare("INSERT INTO etudiants(prenom,nom,filiere,telephone,cours,site,sexe)
        VALUES(?,?,?,?,?,?,?)");
        $ins->execute(array(
            $prenom,$nom,$filiere,$telephone,$cours,$site,$gender
        ));

    }

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Enregistrement des informations</title>

    <!-- Icons font CSS-->
    
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <?php
echo '<div style="background-color: pink;">';
if(!empty($erreur)){
    echo $erreur;
}
echo'</div>';
?>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Formulaire d'enregistrement</h2>
                    <form method="POST">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Prenom</label>
                                    <input class="input--style-4" type="text" name="prenom">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Nom</label>
                                    <input class="input--style-4" type="text" name="nom">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Date de naissance</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" name="birthday">
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Sexe</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Masculin
                                            <input type="radio" checked="checked" name="gender" value="Homme"> 
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Feminin
                                            <input type="radio" name="gender" value="Femme">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                        <div class="input-group">
                            <label class="label">Filiere</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="filiere">
                                    <option disabled="disabled" selected="selected">Choisir la filiere</option>
            
                                        <?php
                                        for($i = 0; $i < count($tab); $i++) {
                                            echo "<option>" . $tab[$i]["nom"] . "</option>";
                                            echo "<br/>";
                                        }
                                        ?>
                                    
                                    
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Numero de telephone</label>
                                    <input class="input--style-4" type="text" name="telephone">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row row-space"> -->
                        <div class="input-group">
                            <label class="label">Site</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="site">
                                    <option disabled="disabled" selected="selected">Choisir le site</option>
                                    <option>Hamdallaye</option>
                                    <option>Baco djicoroni</option>
                                    <option>Hyppodrome</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <div class="row row-space">
                            
                        <div class="input-group">
                            <label class="label">Cours</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="cours">
                                    <option disabled="disabled" selected="selected">Cours</option>
                                    <option>Jour</option>
                                    <option>Soir</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        </div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit" name="envoie">Inscrire</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->