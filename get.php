<?php
//Info base
$dbhost = "localhost";
$dbuser = "rt";
$dbpass = "rtlry";
$db = "test";
$user="";
$Liste="";
$Message="";
try
{
	$bdd = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $dbuser, $dbpass);
}
catch (Exception $e)
{
		die('Erreur : ' . $e->getMessage());
}
if (isset($_GET["id"])){
        
    $req = "SELECT * FROM messages WHERE id=".$_GET["id"]."";
    $reponse = $bdd->query($req);
    while ($donnees = $reponse->fetch()) {
        
        echo $Message = "<h2>From : ".$donnees['expediteur']."</h2><h2>To : ".$donnees['destinataire']."</h2><p>".$donnees['message']."</p>";
        
    }
}
?>
