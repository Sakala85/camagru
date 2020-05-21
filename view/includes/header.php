<?php
session_start();
if(!isset($_SESSION['log'])){
  $_SESSION['log'] = 0;
}
?>
<link rel="stylesheet" type="text/css" href="/public/css/siteStyle.css">
<link rel="stylesheet" type="text/css" href="/public/css/materialize.css">
<nav>
  <div class="nav-wrapper blue-grey darken-3">
    <ul class="nav-mobile">
      <li>
        <a class="nav-link" href="/index.php">
          <img class="img-nav" src="/public/img/icon/picture.png"></a>
      </li>
      <?php
        if($_SESSION['log'] === 1){
          ?>
          <li>
            <a class="nav-link" href="/view/frontend/MonCompte.php"><img class="img-nav" src="/public/img/icon/profile.png"></a></li>
          <li>
              <a class="nav-link" href="/view/frontend/NewPic.php"><img class="img-nav" src="/public/img/icon/instagram-logo.png"></a></li>
          <li>
            <a class="brand-logo right button-color" href="/controller/ControlDeconnexion.php">Se deconnecter</a></li>
          <?php
        }
        else{
          ?>
          <li>

            <a class="button-color brand-logo" href="/view/frontend/connexion.php">Connexion</a></li>
          <li>
            <a class="brand-logo right button-color" href="/view/frontend/inscription.php">S'inscrire</a></li>
          <?php
        }
      ?>
    </ul>
  </div>
</nav>
