<?php
//Info base
$dbhost = "localhost";
$dbuser = "mail";
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
if (isset($_GET["user"])){
    $user = $_GET["user"];
    $sql = "SELECT * FROM messages WHERE destinataire='".$user."'";
    $reponse = $bdd->query($sql);
    echo "<ul>";
	while ($donnees = $reponse->fetch()) {
        
		$point_fin=""; 
		$apercu = substr($donnees['message'], 0, 10);
		if(strlen($donnees['message'])>10){
			$point_fin="...";
		}
        
		echo "<li class=\"liste_mail\" onclick=\"afficherMail(".$donnees['id'].")\">
							<a id=\"listeMail\" >
								".$donnees['date']." <b>".$donnees['expediteur']."</b> : ".$apercu."".$point_fin."
							</a>
							<a id=\"croix\" onclick=\"supprimer(".$donnees['id'].",'".$user."')\">
								<span class=\"croixgauche\"></span>
                                <span class=\"croixdroite\"></span>
							</a>
						</li>";
    
	}
 echo "</ul>";
}
?>
