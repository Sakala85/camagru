<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
function check_email($email)
{
	$ret = 0;
	if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
		$ret = 1;
	}
	return $ret;
}
if (isset($_POST['mail']))
{
	$email = htmlspecialchars($_POST['mail']);
	$tmpmail = $_SESSION['mail'];
	$sth = $bdd->prepare("SELECT * FROM `user` WHERE Mail=?");
	$sth->execute(array($email));
	$tmp = $sth->fetch(PDO::FETCH_ASSOC);
	if($tmp == 0 && check_email($email)){
		$sth = $bdd->prepare("UPDATE `user` SET Mail=? WHERE Mail=?");
		$sth->execute(array($email, $tmpmail));
		$_SESSION['mail'] = $email;	
		header('location: /view/frontend/MonCompte.php');
	}
	else{
		header('location: /view/frontend/MonCompte.php?fail=1');
	}
}
else
{
	header('location: /view/frontend/MonCompte.php');
}
?>