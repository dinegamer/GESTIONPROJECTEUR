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


@$id = $_SESSION['identifiant'];
@$a = $_SESSION['prenom'];
    @$b = $_SESSION['nom'];
    @$c = $_SESSION['filiere'];
    @$d = $_SESSION['cours'];
    @$e = $_SESSION['salle'];
    @$f = $_SESSION['projecteurNumero'];
    @$g = $_SESSION['composants'];
    @$h = (int) $_SESSION['quantiteRallonge'];
    @$i = @$_SESSION['telephone'];

$ins = $db->prepare("INSERT INTO dashboard(num,nom,prenom,filiere,salle,cours,
numProjecteur,composant,quantiteRallonge,telephone)
VALUES(?,?,?,?,?,?,?,?,?,?)");
$ins->execute(array(
    $id,$b,$a,$c,$e,$d,$f,$g,$h,$i
));

// foreach($_SESSION as $session){
//     unset($session);
// }

header('Location:dashboard.php');