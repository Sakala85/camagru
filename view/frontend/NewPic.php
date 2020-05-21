<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');
?>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="/public/css/siteStyle.css">
    <link rel="stylesheet" type="text/css" href="/public/css/materialize.css">

</head>
<?php
require "../../view/includes/header.php";
?>
<body>
    <div class="row">
        <div class="col s9 darken-2 SizeDiv" id="wrapper">
            <video id="sourcevid" class="superposition sourcevid" autoplay="true"  style='display:inline'></video>
            <img id="output_image" class="superposition" style='display:none'/>

            <?php
            if (isset($_GET['calque'])){
                echo "<img id=\"calque\" class=\"superposition calquesup\" src=\"/public/img/calque/".$_GET['calque']."\"/>";
            }
            ?>
        </div>          
        <div class="col s3 darken-2 scrollers">
            <?php
            $user = $_SESSION['IdUser'];
            $sth = $bdd->prepare("SELECT * FROM `picture` WHERE IdUser=?");
            $sth->execute(array($user));
            while ($tmpPicture = $sth->fetch(PDO::FETCH_ASSOC)) {
                echo "<div width=\"300\">";
                echo "<img width=\"300\" src=\"/public/img/picture/" .$tmpPicture['Name']."\"/>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col s9">
            <?php
            require "../../controller/ControlCalqueNewPic.php";
            ?>
        </div>
        <div class="col s3">
            <?php
            if (isset($_GET['calque'])){
                ?>
                <script type="text/javascript" src="/public/jquery-3.4.1.js"></script>
                <form action="/controller/ControlTakePicture.php" method="post" id="FormTake" name="upload_photo" enctype="multipart/form-data">
                    <input name="image" id="tata" hidden/>
                    <canvas id="cvs" style="display: none;" height='400' width='600'></canvas>
                    <input type="file" name="fileToUpload" id="fileToUpload" onclick="document.getElementById('sourcevid').style='display:none;';document.getElementById('output_image').style='display:inline;'" onchange="preview_image(event)"/>
                    <label id="text" for="upload_photo">FILE.PNG (400*600px)</label>
                    <input name='calque' type="hidden" id='calque' value='<?php echo $_GET['calque'];?>'>
                    <input name='tar' type="hidden" id='tar'>
                    <button type="submit" onclick='clone()' value="takePhoto" class="btn waves-effect waves-light blue-grey darken-3" name="submit">photo</button>
                </form>
                <?php 
            }
            else{
                ?>
                <button class="btn waves-effect waves-light blue-grey darken-3">Choose Calque</button>
                <?php
            } ?>
        </div> 
    </div>
    <script type="text/javascript">
        function preview_image(event) 
        {
            var reader = new FileReader();
            reader.onload = function()
            {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <?php  require "../../controller/ControlPictureNewPic.php"; ?>

</body>

</html>
