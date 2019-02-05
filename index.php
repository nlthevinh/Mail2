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
	
    
if (isset($_GET["user"])){
        
		$user = $_GET["user"];
        
}

	
if ((isset($_POST["message"])) && (isset($_POST["dest"]))){
        
	$prep = $bdd->prepare('INSERT INTO messages (destinataire,expediteur,date,message) VALUES (?,?,NOW(),?)');
	$prep->execute(array($_POST["dest"],$user,$_POST["message"]));
        
}

?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body> 
       
       		<script>
		
			function afficherMail(id){
				xhr = new XMLHttpRequest();
				
				xhr.open('GET', 'http://localhost/mail/get.php?id=' + id);
				xhr.send(null);
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4) {
						document.getElementById("droite").innerHTML = xhr.response;
					}
				}	
			}function afficherList(user){
				xhr = new XMLHttpRequest();
				
				xhr.open('GET', 'http://localhost/mail/list.php?user=' + user);
				xhr.send(null);
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4) {
						document.getElementById("gauche").innerHTML = xhr.response;
					}
				}	
			}function ajouterMail(user){
				xhr = new XMLHttpRequest();
				
				xhr.open('GET', 'http://localhost/mail/index.php?user=' + user);
				xhr.send(null);
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4) {
						window.location.href="index.php?user=" + user + '&id=' + id;
					}
				}	
			}
                
            
			
			function supprimer(id,user){
				xhr = new XMLHttpRequest();
				xhr.open('DELETE', 'http://localhost/mail/index.php?user=' + user + '&idSUP=' + id);
				xhr.send(null);
					
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4) {
						window.location.href="index.php?user=" + user;
					}
				}
                
                var list_mail = document.getElementById("_liste_mail");
                list_mail.removeChild(list_mail.childNodes[id_liste]);
			}
		</script> 
        
        <div id="Connexion" <?php if($user!="")echo ("style=\"background-color:#055ddd\"")?>>
            <h1>Ma Boite Mail</h1>
           
            <form id="form_connexion" action="index.php" method="get">
				<input type="text" name="user" maxlength="20"/>
				<input type="submit" value="Connexion">
			</form>
        </div>
		
		<div id="creation_mail" >
			<form id="envoi" action="index.php<?php if($user!="")echo("?user=".$user."")?>" method="post">
				<div id="_Destinataire">
					<label for="dest">Destinataire:  </label>
					<input type="text" id="dest" name="dest" style="width:100%" maxlength="20"/>
				</div>
				<div id="_Message">
					<label for="message">Message:  </label>
					<input type="text" id="message" name="message"  style="width:100%" maxlength="300"/>
					<input type="submit" value="Envoyer" <?php echo "onclick=ajouterMail(".$user.")"?> id="btnEnvoyer">
				</div>
			</form>
        </div>
		
		<div>
        Messages <a onclick="afficherList('<?php echo $user?>')" href="#">Fetch</a>
			
		</div>
        
		<div id="gauche">
        
			
		</div>
		<div id="droite">
			
		</div>
	</body>
</html>
