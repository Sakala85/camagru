<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
$target_dir = "../public/img/calque/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $ret = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $ret = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $ret = "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    $ret = "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $ret = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk = 0;
}
if ($uploadOk != 0) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $nameFile = basename( $_FILES["fileToUpload"]["name"]);
      $ret = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      $bdd->exec("INSERT INTO calque (Name) VALUES ('$nameFile')");
  } else {
    $ret = "Sorry, there was an error uploading your file.";
}
}

header("location: /view/frontend/admin.php?ret=$ret");



?>
