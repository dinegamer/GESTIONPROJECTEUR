<?php
session_start();
if($_SESSION['utilisateur'] == "kadi" || $_SESSION['utilisateur'] == "ousmane" || $_SESSION['utilisateur'] == "mariam") {
    include("ins/connexionAnnexe.php");
    
} 
else if($_SESSION['utilisateur'] == "maiga"){
    include("ins/connexionHippodrome.php");
}
else
    include("ins/connexion.php");

@$a = $_SESSION['prenom'];
    @$b = $_SESSION['nom'];
    @$c = $_SESSION['filiere'];
    @$d = $_SESSION['cours'];
    @$e = $_SESSION['salle'];
    @$f = $_SESSION['projecteurNumero'];
    @$g = $_SESSION['composants'];
    @$h = $_SESSION['quantiteRallonge'];
    
    @$ins = $db->prepare("DELETE FROM dashboard WHERE num = ?");
    @$ins->execute(array($_SESSION['num']));
    echo $_SESSION['num'];

    foreach($_SESSION as $session){
        unset($session);
    }
    echo "La ligne a ete supprime !";