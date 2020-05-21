<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
function check_email($email)
{
    $ret = 0;
    if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
        $ret = 1;
    }
    return $ret;
}
if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email']))
{
    if ($_POST['pseudo'] !== htmlspecialchars($_POST['pseudo']) || strlen($_POST['password']) < 7){
        header('location: /view/frontend/inscription.php?fail=3');
    }
    else{
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = hash('whirlpool', $_POST['password']);
        $email = htmlspecialchars($_POST['email']);
        $tmp = check_email($email);
        if($tmp !== 1){
            header('location: /view/frontend/inscription.php?fail=1');
        }
        else {
            $random = uniqid();
            $sth = $bdd->prepare("SELECT * FROM `user` WHERE Username=? OR Mail=?");
            $sth->execute(array($pseudo, $email));
            $tmp = $sth->fetch(PDO::FETCH_ASSOC);
            if($tmp == 0){
                $bdd->exec("INSERT INTO user (Username, Password, Mail, ValidMail, Token) VALUES ('$pseudo', '$password', '$email', 0, '$random')");
                $subject = "Validation";
                $message = "Cliquez ici pour Valider ! <b>http://localhost:8080/index.php?valide=$pseudo&mail=$random</b>";
                $headers = "From: Contact Camagru <camagru4242@gmail.com>\r\n".
                "MIME-Version: 1.0" . "\r\n" .
                "Content-type: text/html; charset=UTF-8" . "\r\n";
                if (mail($email, $subject, $message, $headers)){
                    header('location: /view/frontend/connexion.php');
                }
                else{
                    header('location: /view/frontend/inscription.php?fail=2');
                }
            }
            else{
              header('location: /view/frontend/inscription.php?fail=2');
          }
      }
  }
}
?>
