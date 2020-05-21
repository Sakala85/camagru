<?php
session_start();
require "../includes/header.php";
if(isset($_GET['fail'])){
  echo '<script type="text/javascript">alert("Email Incorrect");</script>';
}
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="/public/css/siteStyle.css">
</head>
<body>
  <div class="form_page">
    <div class="container-fluid ">
      <form method="post" action="/controller/Control_send_link.php">
        <div class="row">
          <div class="input-field col s12 center">
           <input placeholder="Your Email" class="inputForm" type="text" name="email">
         </div>
       </div>
       <div class="row">
        <div class="input-field col s12 center">
          <button class="btn waves-effect waves-light blue-grey darken-3" type="submit" name="submit_email">Valider</button>
        </div>
      </div>
  </form>
    </div>
  
</div>
</body>
</html>
