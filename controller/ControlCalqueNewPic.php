<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
if (isset($_SESSION['user']) && isset($_SESSION['token']))
{
  $pseudo = htmlspecialchars($_SESSION['user']);
  $token = htmlspecialchars($_SESSION['token']);
  $sth = $bdd->prepare("SELECT * FROM `user` WHERE Username=? AND Token=?");
  $sth->execute(array($pseudo, $token));
  $tmpUser = $sth->fetch(PDO::FETCH_ASSOC);
  if (!isset($tmpUser['Token'])){
    echo "Connectez-vous";
    exit();
  }
  $sth = $bdd->prepare("SELECT * FROM calque");
  $sth->execute();
  while ($tmpCalque = $sth->fetch(PDO::FETCH_ASSOC)) {
    echo "<a class=\"ShowCalque\" href=\"./NewPic.php?calque=".$tmpCalque['Name']."\"><img class=\"IndexCalque\" src=\"/public/img/calque/" . $tmpCalque['Name']."\"/></a>";
  }
}

?>
