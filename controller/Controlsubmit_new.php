<?php
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
if(isset($_POST['password']) && isset($_POST['email']) && isset($_POST['token']))
{
	$token = htmlspecialchars($_POST['token']);
	$sth = $bdd->prepare("SELECT * FROM `user` WHERE Token=?");
	$sth->execute(array($token));
	$tmp = $sth->fetch(PDO::FETCH_ASSOC);
	$email = $_POST['email'];
	if ($tmp['Mail'] == $email){
		if (strlen($_POST['password']) < 7){
			header("location: http://localhost:8080/view/frontend/reset_pass.php?tmp=".$token."&ok=ok&error=passs");
		}
		else{
		$password = hash('whirlpool', $_POST['password']);
		$sth1 = $bdd->prepare("UPDATE `user` SET Password=? WHERE Mail=?");
		$sth1->execute(array($password, $email));
		header('location: /view/frontend/connexion.php');
	}
	}
	else{
	header("location: http://localhost:8080/view/frontend/reset_pass.php?tmp=".$token."&ok=ok&error=passd");		
	}
}
echo "Mauvais chemin";
?>
