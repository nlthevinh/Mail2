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
if (isset($_GET["idSUP"])) {
    $prep = $bdd->prepare('DELETE FROM donnee WHERE id=?');
    $prep->execute(array($_GET["idSUP"]));
}  
