<?php
session_start();
require "../includes/header.php";
if(isset($_GET['ret'])){
	echo '<h1>'.$_GET['ret'].'</h1>';
}
if(isset($_GET['fail'])){
	echo '<h1>This calque already exist</h1>';
}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/public/css/siteStyle.css">
	<link rel="stylesheet" type="text/css" href="/public/css/bootstrap.css">
</head>
<body>
	<div class="form_page">
		<div class="container-fluid ">
			<form action="/controller/ControlAdmin.php" method="post" enctype="multipart/form-data">
				<div class="form-group form-container">
					<label for="pseudo" class="labelForm">Select image to upload:</label>
					<input type="file" name="fileToUpload" id="fileToUpload">
					<button type="submit" class="btnForm" name="submit">Add</button>
				</div>
			</form>
		</div>
	</div>
	<?php
	?>
</body>
<footer>
</footer>
</html>
