<?php
if(isset($_POST['submit_email']) && $_POST['email'])
{
  $email = htmlspecialchars($_POST['email']);
  $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
  $sth = $bdd->prepare("SELECT * FROM `user` WHERE Mail=?");
  $sth->execute(array($email));
  $tmp = $sth->fetch(PDO::FETCH_ASSOC);
  if(isset($tmp['Mail']))
  {
    $tmpMail = $tmp['Mail'];
    $random = uniqid();
    $ok = $random;
    $bdd->exec("UPDATE user SET Token = '$ok' WHERE Mail = '$email'");
    $subject = "Change Password";
    $message    = "Click here to change password <b>http://localhost:8080/view/frontend/reset_pass.php?tmp=$ok&ok=ok</b>";
    $headers = "From: Contact Camagru <camagru4242@gmail.com>\r\n".
    "MIME-Version: 1.0" . "\r\n" .
    "Content-type: text/html; charset=UTF-8" . "\r\n";
    if (mail($tmpMail, $subject, $message, $headers)){
      header('location: /index.php');
    }
    else{
      header('location: /view/frontend/resetPassword.php?fail=2');
    }
    header('location: /index.php');
  }
}
?>
