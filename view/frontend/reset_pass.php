<?php
session_start();
require "../includes/header.php";
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
if(isset($_GET['tmp']))
{
  if (isset($_GET['error']))
  {
    echo '<script>alert("PasswordInsufisant");</script>';
  }
  $token = htmlspecialchars($_GET['tmp']);
  $sth = $bdd->prepare("SELECT * FROM `user` WHERE Token=?");
  $sth->execute(array($token));
  $tmp = $sth->fetch(PDO::FETCH_ASSOC);
  if (isset($tmp['Mail']))
  {
    $email = $tmp['Mail'];
    ?>
    <html>
    <head>
      <link rel="stylesheet" type="text/css" href="/public/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="/public/css/siteStyle.css">
    </head>
    <body>
      <div class="form_page">
        <div class="container-fluid ">
          <form method="post" action="/controller/Controlsubmit_new.php">
            <div class="form-group form-container">
              <input type="hidden" name="email" value="<?php echo $email;?>">
              <input type="hidden" name="token" value="<?php echo $token;?>">
              <label class="labelForm" for="psw"><b>New Password</b></label>
              <input type="password" name="password" class="inputForm">
              <button type="submit" class="btnForm">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </body>
    </html>
    <?php
  }
  else{
    echo 'Error, you already change your password or delete your account';
  }
}
echo "Ne pas modifier les liens";
?>
