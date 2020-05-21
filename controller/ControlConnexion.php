<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
if (isset($_POST['pseudo']) && isset($_POST['password']))
{
    if ($_POST['pseudo'] === "admin" && $_POST['password'] === "admin"){
        header('location: /view/frontend/admin.php');
        exit();
    }
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = hash('whirlpool', $_POST['password']);
    $tmp = 0;
    $sth = $bdd->prepare("SELECT * FROM `user` WHERE Username=? AND Password=?");
    $sth->execute(array($pseudo, $password));
    $tmp = $sth->fetch(PDO::FETCH_ASSOC);
    $random = $tmp['Token'];
    $IdUser = $tmp['IdUser'];
    $email = $tmp['Mail'];
    $valid_mail = $tmp['ValidMail'];
    if($tmp == 0){
        $_SESSION['log'] = 0;
        header('location: /view/frontend/connexion.php?fail=1');
    }
    else if($valid_mail == 0){
      header('location: /view/frontend/connexion.php?mail=1');
  }
  else{
    $_SESSION['log'] = 1;
    $_SESSION['user'] = $pseudo;
    $_SESSION['IdUser'] = $IdUser;
    $_SESSION['mail'] = $email;
    $_SESSION['token'] = $random;
    header('location: /index.php');
}
}
?>
