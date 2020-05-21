<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        // creating a cut resource
	$cut = imagecreatetruecolor($src_w, $src_h);

        // copying relevant section from background to the cut resource
	imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
	
        // copying relevant section from watermark to the cut resource
	imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
	
        // insert cut resource to destination image
	imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}
$target_file = "../public/img/tmp.png";
$uploadOk = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

	if($check !== false) {
		echo "File is an image";
		$uploadOk = 1;
	}
	else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	if($imageFileType != "png") {
		echo "Sorry, only PNG files are allowed.";
		$uploadOk = 0;
	}
	if (!$_FILES['fileToUpload']['tmp_name']){
		echo "Sorry, NotSupport.";
		$uploadOk = 0;
	}
	if (!list($witdh, $height) = getimagesize($_FILES['fileToUpload']['tmp_name'])){
		echo "Sorry, NotSupport.";
		$uploadOk = 0;
	}
	if ($witdh != 600|| $height != 400){
		echo "Sorry, NotSupport.";
		$uploadOk = 0;
	}
	if ($uploadOk == 1){
		$tmp_name = $_FILES["fileToUpload"]["tmp_name"];
		move_uploaded_file($tmp_name, $target_file);
		$src = file_get_contents('../public/img/tmp.png');
		$src = 'data:image/png;base64,' . base64_encode($src);
	}
	else{
		$src = $_POST['tar'];
	}
	$src = str_replace('data:image/png;base64,', '', $src);
	$src = str_replace(' ', '+', $src);
	$src = base64_decode($src);
	file_put_contents("../public/img/tmp.png", $src);
	$src1 = imagecreatefrompng("../public/img/calque/".$_POST['calque']."");
	$dest = imagecreatefrompng("../public/img/tmp.png");
	imagealphablending($src1, false);
	imagesavealpha ($src1, true);
	$largeur_source = imagesx($src1);
	$hauteur_source = imagesy($src1);
	$largeur_destination = imagesx($dest);
	$hauteur_destination = imagesy($dest);
	$destination_x = $largeur_destination - $largeur_source;
	$destination_y =  $hauteur_destination - $hauteur_source;
	$src1 = imagecreatefrompng("../public/img/calque/".$_POST['calque']."");
	$dest = imagecreatefrompng("../public/img/tmp.png");
	imagecopymerge_alpha($dest, $src1, $destination_x, $destination_y, 0, 0, imagesx($src1), imagesy($src1), 90);

	ob_start();
	imagepng($dest);
	$image_data = ob_get_contents();
	ob_end_clean();
	$name = $_SESSION['IdUser'];
	$picture = uniqid().".png";
	file_put_contents("../public/img/picture/".$picture."", $image_data);
	imagedestroy($dest);
	imagedestroy($src1);
	$bdd->exec("INSERT INTO picture (Name, CreationDate, IdUser) VALUES ('$picture', NOW(), '$name')");
	echo '<script type="text/javascript"> window.location.replace("/view/frontend/NewPic.php") </script>';
}
?>