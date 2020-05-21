<?php
require "../includes/header.php";
if(isset($_GET['fail']) && $_GET['fail'] === 1){
  echo '<script type="text/javascript">alert("Identifiant ou Mot de pass Incorect");</script>';
}
if(isset($_GET['mail'])){
  echo '<script type="text/javascript">alert("Validez votre Mail");</script>';
}
else if(isset($_GET['fail'])){
  echo '<script type="text/javascript">alert("Identifiant ou Mot de pass Incorect");</script>';
}

?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="/public/css/siteStyle.css">
</head>
<body>
  <div class="row">
    <form method="post" class="col s12" action="/controller/ControlConnexion.php">
      <div class="row">
        <div class="input-field col s12">
          <input type="text" placeholder="Enter Pseudo" name="pseudo" required>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="password" autocomplete="off" placeholder="Enter Password" name="password" id="password" required>
        </div>
      </div>
      <div class="input-field col s12 center">
        <button type="submit" value="Connexion" class="btn waves-effect waves-light blue-grey darken-3">Login</button>
      </div>
      <div id="psw">Forgot <a href="resetPassword.php">password?</a></div>
    </div>
  </form>
</body>
</html>
