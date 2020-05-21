<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');

function ShowError($error){ 
echo '<script type="text/javascript">window.alert("'.$error.'");</script>';}
?>