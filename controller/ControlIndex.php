<?php
session_start();
if(!isset($_SESSION['log'])){
  $_SESSION['log'] = 0;
}
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
$sthc = $bdd->prepare("SELECT COUNT(*) FROM `picture`");
$sthc->execute(array());
$finalPhoto = $sthc->fetch(PDO::FETCH_ASSOC);
$countPhoto = 0;
$page = 0;
$compteur = $finalPhoto['COUNT(*)'];
$sth = $bdd->prepare("SELECT * FROM `picture` ORDER BY CreationDate DESC");
$sth->execute(array());
$IdUser = $_SESSION['IdUser'];
if (isset($_POST['commentB']) && isset($_POST['picture']) && isset($_POST['pictureUser']) && $_POST['commentB'] != NULL){
    $comment = htmlspecialchars($_POST['commentB']);
    $picture = htmlspecialchars($_POST['picture']);
    $IdPictureUser = htmlspecialchars($_POST['pictureUser']);
    $bdd->exec("INSERT INTO comment (Comment, IdUser, IdPicture) VALUES ('$comment', '$IdUser', '$picture')");
    $sth5 = $bdd->prepare("SELECT * FROM `user` WHERE IdUser = ?");
    $sth5->execute(array($IdPictureUser));
    $tmpemail = $sth5->fetch(PDO::FETCH_ASSOC);
    if ($tmpemail['ValidMail'] == 1){
        $email = $tmpemail['Mail'];
        $subject = "Commentaire";
        $message = "Vous avez reçu un Commentaire <b>$comment</b>";
        $headers = "From: Contact Camagru <camagru4242@gmail.com>\r\n".
        "MIME-Version: 1.0" . "\r\n" .
        "Content-type: text/html; charset=UTF-8" . "\r\n";
        if (mail($email, $subject, $message, $headers)){
            
        }
    }
}
while ($countPhoto < $compteur) {
  $page++;
  $nbrPhoto = 0;
  ?>
  <div class="row">
    <?php 
    while ($nbrPhoto < 6){
      if ($tmpPicture = $sth->fetch(PDO::FETCH_ASSOC)){
        if (isset($_GET['page']) && $_GET['page'] == $page){
          ?>

          <div class="col s4">
            <div class="card CardSize">
              <div class="card-image">
                <?php
                
                echo "<a href=\"index.php?picture=".$tmpPicture['Name']."\"><img src=\"/public/img/picture/" .$tmpPicture['Name']."\"/></a>";
                echo "</div>";
                if($_SESSION['log'] === 1){
                  $IdPicture = $tmpPicture['IdPicture'];
                  $IdPictureUser = $tmpPicture['IdUser'];
                  echo "<div class=\"card-content ScrolComment\">";
                  $sth4 = $bdd->prepare("SELECT * FROM `comment` WHERE IdPicture = ?");
                  $sth4->execute(array($IdPicture));
                  while ($comment = $sth4->fetch(PDO::FETCH_ASSOC)){
                    echo "<p class=\"commentList\">".$comment['Comment']."</p>";
                }
                echo "</div>";
                echo "<div class=\"card-content blue-grey darken-3\">";
                ?>
                <form method="post" action="/index.php?page=<?php echo $page; ?>">
                    <input type="text" name="commentB">
                    <input type="text" name="picture" value="<?php echo $IdPicture; ?>" hidden>
                    <input type="text" name="pictureUser" value="<?php echo $IdPictureUser; ?>" hidden>
                    <button type="submit" name="submit">Comment</button>
                </form>
                <?php
                echo "</div>";
                echo "<div class=\"card-action\">";
                $sth3 = $bdd->prepare("SELECT * FROM `likes` WHERE IdPicture = ? AND IdUser = ?");
                $sth3->execute(array($IdPicture, $_SESSION['IdUser']));
                $IsLike = $sth3->fetch(PDO::FETCH_ASSOC);
                if (isset($IsLike['IdUser']))
                {
                    echo "<a href=\"index.php?page=".$page."&like=0&user=".$_SESSION['user']."&picture=".$IdPicture."\"><img class=\"IndexLike\" src=\"/public/img/icon/like.png\"></a>";
                }
                else
                {
                    echo "<a href=\"index.php?page=".$page."&like=1&user=".$_SESSION['user']."&picture=".$IdPicture."\"><img class=\"IndexLike\" src=\"/public/img/icon/heart.png\"></a>";
                }
                $sth2 = $bdd->prepare("SELECT COUNT(*) FROM `likes` WHERE IdPicture = ?");
                $sth2->execute(array($IdPicture));
                $NumLike = $sth2->fetch(PDO::FETCH_ASSOC);
                echo $NumLike['COUNT(*)'];
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <?php

}
}
$nbrPhoto++;
$countPhoto = $countPhoto + 1;
}
?>
</div>
<?php 
}
?>

<ul class="pagination paginationPerso">
    <?php $tmpPage=1;
    while ($tmpPage <= $page){ ?>
      <li class="waves-effect"><a href="/index.php?page=<?php echo $tmpPage;?>"><?php echo $tmpPage;?></a></li>
      <?php $tmpPage++;
  } ?>
</ul>



