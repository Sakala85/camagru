<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
function check_password($password)
{
	$ret = 1;
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
		$ret = 0;
	}
	return $ret;
}
if (isset($_POST['Apass']) && isset($_POST['Npass']) && isset($_POST['Cpass']))
{
	if (check_password($password) === 0){
		header('location: /view/frontend/MonCompte.php?fail=1');
	}
	$password = hash('whirlpool', $_POST['password']);
	$Apass = hash('whirlpool', $_POST['Apass']);
	$Npass = hash('whirlpool', $_POST['Npass']);
	$Cpass = hash('whirlpool', $_POST['Cpass']);
	$Username = htmlspecialchars($_SESSION['user']);
	if ($Npass !== $Cpass || strlen($_POST['Cpass']) < 7)
	{
		header('location: /view/frontend/MonCompte.php?fail=1');
	}
	$sth = $bdd->prepare("SELECT * FROM `user` WHERE Username=? AND Password=?");
	$sth->execute(array($Username, $Apass));
	$tmp = $sth->fetch(PDO::FETCH_ASSOC);
	echo $tmp['Username'];
	if (isset($tmp['Username']) && ($tmp['Username'] === $_SESSION['user']))
	{
		$sth = $bdd->prepare("UPDATE `user` SET Password=? WHERE Password=? AND Username=?");
		$sth->execute(array($Npass, $Apass, $Username));
		header('location: /view/frontend/MonCompte.php?password=ok');
	}
}
else
{
	header('location: /view/frontend/MonCompte.php');
}
?>