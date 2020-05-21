<?php
session_start();
require "../includes/header.php";
if(isset($_GET['fail']) && $_GET['fail'] == 1){
  echo '<script>alert("Email Invalide");</script>';
}
else if(isset($_GET['fail']) && $_GET['fail'] == 2){
  echo '<script>alert("Ce pseudo ou ce mail est déjà utilisé");</script>';
}
else if(isset($_GET['fail']) && $_GET['fail'] == 3){
  echo '<script>alert("Pseudo Invalide ou MDP insufisant");</script>';
}
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="/public/css/siteStyle.css">
</head>
<body>
  <div class="container-fluid ">
    <form action="/controller/ControlInscription.php" method="post">
      <div class="row">
        <div class="input-field col s12 center">
          <input type="text" class="inputForm" placeholder="Enter Username" name="pseudo" id="pseudo" required>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 center">
          <input type="password" autocomplete="off" class="inputForm" placeholder="Enter Password" name="password" id="password" required>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 center">
          <input type="email" placeholder="Enter Email" name="email" id="email" class="inputForm" required>
        </div>
      </div>
      <div class="input-field col s12 center">
        <button type="submit" value="Connexion" class="btn waves-effect waves-light blue-grey darken-3">Register</button>
      </div>
    </form>
  </div>
  <?php
  ?>
</body>
<footer>
</footer>
</html>
