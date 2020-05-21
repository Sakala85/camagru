<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
 ?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Camagru</title>
        <link rel="stylesheet" type="text/css" href="/public/css/siteStyle.css">
        <link rel="stylesheet" type="text/css" href="/public/css/materialize.css">
    </head>
<?php
  require "./view/includes/header.php";
  if (isset($_GET['mail'])){
    $mail = htmlspecialchars($_GET['mail']);
    $sth = $bdd->prepare("UPDATE `user` SET ValidMail=? WHERE Token=?");
    $sth->execute(array(1, $mail));
  }
  if(isset($_GET['mail']) && $_GET['mail'] === 1){
      echo '<script type="text/javascript">alert("Adresse Mail Validée");</script>';
  }
  if(isset($_GET['mail']) && $_GET['mail'] === 2){
      echo '<script type="text/javascript">alert("Problem");</script>';
  }
?>
<body>
  <?php
  require "controller/ControlLike.php";
  
  require "controller/ControlIndex.php";
?>
    </body>
</html>
