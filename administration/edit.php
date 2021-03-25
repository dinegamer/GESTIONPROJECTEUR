<?php 
if($_SESSION['utilisateur'] == "kadi" || $_SESSION['utilisateur'] == "ousmane" || $_SESSION['utilisateur'] == "mariam") {
    include("ins/connexionAnnexe.php");
    
} 
else if($_SESSION['utilisateur'] == "maiga"){
    include("ins/connexionHippodrome.php");
}
else
    include("ins/connexion.php");
 if ( !empty($_GET['id']))
  { 
      header("Location: index.php"); 
  }

$sql = "UPDATE dashboard SET name = ?,firstname = ?,age = ?,tel = ?, email = ?, pays = ?, comment = ?, metier = ?, url = ? WHERE id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($name,$firstname, $age, $tel, $email,$pays,$comment, $metier, $url,$id));
header("Location: index.php");