<?php
require "../includes/header.php";
session_start();
try
{
  $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}
//On donne ensuite un titre à la page, puis on appelle notre fichier debut.php
$titre = "Index du forum";
include("./includes/header.php");
if(isset($_GET['fail'])){
  echo '<script type="text/javascript">alert("Adresse Mail ou Pseudo Déja associée");</script>';
}
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="/public/css/siteStyle.css">
</head>
<body>
	<div class="row">
   <form method="post" class="col s12" action="/controller/ControlUpdateMail.php">
    <div class="row">
      <div class="input-field col s12">
       <input type="text" placeholder="<?php echo $_SESSION['mail'];?>" name="mail" required>
     </div>
     <div class="input-field col s12 center">
       <button type="submit" value="mail" class="btn waves-effect waves-light blue-grey darken-3">Update Mail</button>
     </div>
   </div>
 </form>
</div>
<div class="row">
 <form method="post" class="col s12" action="/controller/ControlUpdatePseudo.php">
  <div class="row">
    <div class="input-field col s12">
     <input type="text" placeholder="<?php echo $_SESSION['user'];?>" name="pseudo" required>
   </div>
   <div class="input-field col s12 center">
     <button type="submit" value="Connexion" class="btn waves-effect waves-light blue-grey darken-3">Update Pseudo</button>
   </div>
 </div>
</form>
</div>
<div class="row">
 <form method="post" class="col s12" action="/controller/ControlUpdatePassword.php">
  <div class="row">
    <div class="input-field col s12">
     <input type="password" autocomplete="off" placeholder="Actual Password" name="Apass" required>
   </div>
   <div class="input-field col s12">
     <input type="password" autocomplete="off" placeholder="New Password" name="Npass" required>
   </div>
   <div class="input-field col s12">
     <input type="password" autocomplete="off" placeholder="Confirm Password" name="Cpass" required>
   </div>
   <div class="input-field col s12 center">
     <button type="submit" value="Connexion" class="btn waves-effect waves-light blue-grey darken-3">Update Password</button>
   </div>
 </div>
</form>
<?php   
$IdUser = $_SESSION['IdUser'];
    if (isset($_POST['commentON'])){
$sth = $bdd->prepare("UPDATE `user` SET ValidMail=? WHERE IdUser=?");
    $sth->execute(array(1, $IdUser));
    }
    if (isset($_POST['commentOFF'])){
$sth = $bdd->prepare("UPDATE `user` SET ValidMail=? WHERE IdUser=?");
    $sth->execute(array(2, $IdUser));
    }
$sth = $bdd->prepare("SELECT * FROM `user` WHERE IdUser = ?");
    $sth->execute(array($IdUser));
    $comment = $sth->fetch(PDO::FETCH_ASSOC);

    if ($comment['ValidMail'] == 2){
?>
  <form method="post" class="col s12" action="/view/frontend/MonCompte.php">
  <div class="row">
    <div class="input-field col s12 center">
      <button type="submit" name="commentON" value="commentON" class="btn waves-effect waves-light blue-grey darken-3">Active Comment</button>
    </div>
  </div>
</form>
<?php
  }
  else{
    ?>
<form method="post" class="col s12" action="/view/frontend/MonCompte.php">
  <div class="row">
    <div class="input-field col s12 center">
      <button type="submit" name="commentOFF" value="commentOFF" class="btn waves-effect waves-light blue-grey darken-3">Desactive Comment</button>
    </div>
  </div>
</form>
    <?php
  }
  ?>

</div>
</body>
</html>
