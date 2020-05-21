<?php
session_start();
session_destroy();
$titre="Déconnexion";
if(isset($_SESSION['log']) && isset($_SESSION['token'])){
	$_SESSION['log'] = 0;
	$_SESSION['token'] = 0;
}
header('location: /index.php');
?>
