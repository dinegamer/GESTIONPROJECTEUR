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
    $sql = "DELETE FROM journal";
    $db = $db->query($sql);
    // $db->execute(array($id));
    echo "<h1>Ligne supprimee avec succes<h2>";
    echo "<a href='dashboard.php'>Retour</a>";
 
    // header("Location: index.php"); 
    
  
// header("Location: index.php");