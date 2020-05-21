<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
if (isset($_POST['pseudo']))
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$email = $_SESSION['mail'];
	$sth = $bdd->prepare("SELECT * FROM `user` WHERE Username=?");
	$sth->execute(array($pseudo));
	$tmp = $sth->fetch(PDO::FETCH_ASSOC);
	if($tmp == 0){
		$tmppseudo = $_SESSION['user'];
		$sth = $bdd->prepare("UPDATE `user` SET Username=? WHERE Username=?");
		$sth->execute(array($pseudo, $tmppseudo));
		$_SESSION['user'] = $pseudo;
		header('location: /view/frontend/MonCompte.php');
	}
	else{
		header('location: /view/frontend/MonCompte.php?fail=1');
	}
}
else{
	header('location: /view/frontend/MonCompte.php');
}
?>