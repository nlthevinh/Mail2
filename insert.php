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
if ((isset($_POST["user"])) && (isset($_POST["message"])) && (isset($_POST["dest"]))){
        
	$prep = $bdd->prepare('INSERT INTO messages (destinataire,expediteur,date,message) VALUES (?,?,NOW(),?)');
	$prep->execute(array($_POST["dest"],$_POST["user"],$_POST["message"]));
        
}
