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
				return false;
			}
			
			function afficherList(user){
				xhr = new XMLHttpRequest();
				
				xhr.open('GET', 'http://localhost/mail/list.php?user=' + user);
				xhr.send(null);
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4) {
						document.getElementById("gauche").innerHTML = xhr.response;
					}
				}	
				return false;
			}
			
			function ajouterMail(user){
				formElement = document.getElementById("envoi");
				formData = new FormData(formElement)
				xhr = new XMLHttpRequest();
				xhr.open("POST", "insert.php");
				formData.append("user",user);
				xhr.send(formData);
				return false;
			}	

			function supprimer(id){
				xhr = new XMLHttpRequest();
				xhr.open('DELETE', 'http://localhost/mail/remove.php?idSUP=' + id);
				xhr.send(null);
					
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4) {
						afficherList(user)
					}
				}
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
			<form id="envoi" method="post" onsubmit="return ajouterMail('<?php echo $user ?>')">
				<div id="_Destinataire">
					<label for="dest">Destinataire:  </label>
					<input type="text" id="dest" name="dest" style="width:100%" maxlength="20"/>
				</div>
				<div id="_Message">
					<label for="message">Message:  </label>
					<input type="text" id="message" name="message"  style="width:100%" maxlength="300"/>
					<input type="submit" value="Envoyer" id="btnEnvoyer">
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
