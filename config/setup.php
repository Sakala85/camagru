<?php
	// header('Location: /Camagru/index.php');
	$servername = 'localhost';
	$username = 'camagru';
	$password = 'camagru';
	$db = 'camagru';
	try {
    	$conn = new PDO("mysql:host=$servername", $username, $password);
    	// set the PDO error mode to exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$sql = "CREATE DATABASE $db";
    	// use exec() because no results are returned
    	$conn->exec($sql);
    	echo "Database created successfully<br>";
    	}
	catch(PDOException $e)
    {
    	echo $sql.$e->getMessage()."<br>";
    }
    $conn = null;
    try {
   		$bdd = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
   		// set the PDO error mode to exception
    	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully <br>";

    	}
	catch(PDOException $e)
    {
    	echo "Connection failed: " . $e->getMessage()."<br>";
    }
$table = "user";
try {
    $sql = "CREATE table $table(
    IdUser INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   	Username VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Mail VARCHAR(255) NOT NULL,
   	ValidMail INT(6) NOT NULL,
    Token VARCHAR(255) NOT NULL);";
    $bdd->exec($sql);
    echo("Created $table Table.\n");
	} catch(PDOException $e) {
	    echo $e->getMessage();//Remove or change message in production code
	}
$table = "calque";
try {
    $sql = "CREATE table $table(
    IdCalque INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL);";
    $bdd->exec($sql);
    echo("Created $table Table.\n");
	} catch(PDOException $e) {
	    echo $e->getMessage();//Remove or change message in production code
	}
  try {
    $sql = "INSERT INTO calque (Name) VALUES ('computer.png');";
    $bdd->exec($sql);
    echo("InsertCalque.\n");
  } catch(PDOException $e) {
      echo $e->getMessage();//Remove or change message in production code
  }
  try {
    $sql = "INSERT INTO $table (Name) VALUES ('grumpycat.png');";
    $bdd->exec($sql);
    echo("InsertCalque.\n");
  } catch(PDOException $e) {
      echo $e->getMessage();//Remove or change message in production 
}
$table = "cascades";
try {
    $sql = "CREATE table $table(
    IdCascades INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Name VARCHAR(255) NOT NULL);";
    $bdd->exec($sql);
    echo("Created $table Table.\n");
	} catch(PDOException $e) {
	    echo $e->getMessage();//Remove or change message in production code
	}
$table = "picture";
try {
    	$sql = "CREATE TABLE $table(
    	IdPicture INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			Name VARCHAR(255) NOT NULL,
			CreationDate DATE NOT NULL,
      IdUser INT(6) UNSIGNED, FOREIGN KEY
    	FkUser(IdUser)
    	REFERENCES User(IdUser));";
    	$bdd->exec($sql);
    	echo("Created $table Table.\n");
	} catch(PDOException $e) {
	    echo $e->getMessage();//Remove or change message in production code
	}
  $table = "comment";
try {
      	$sql = "CREATE TABLE $table(
        IdComment INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Comment VARCHAR(255) NOT NULL,
        IdUser INT(6) UNSIGNED, FOREIGN KEY
        FkUser(IdUser)
        REFERENCES User(IdUser)
        ON DELETE CASCADE,
        IdPicture INT(6) UNSIGNED, FOREIGN KEY
        FkPicture(IdPicture)
        REFERENCES Picture(IdPicture)
        ON DELETE CASCADE);";
      	$bdd->exec($sql);
      	echo("Created $table Table.\n");
  	} catch(PDOException $e) {
  	    echo $e->getMessage();//Remove or change message in production code
  	}
    $table = "likes";
  try {
        	$sql = "CREATE TABLE $table(
          IdLike INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          IdUser INT(6) UNSIGNED, FOREIGN KEY
          FkUser(IdUser)
          REFERENCES user(IdUser)
          ON DELETE CASCADE,
          IdPicture INT(6) UNSIGNED, FOREIGN KEY
          FkPicture(IdPicture)
          REFERENCES picture(IdPicture)
          ON DELETE CASCADE);";
        	$bdd->exec($sql);
        	echo("Created $table Table.\n");
    	} catch(PDOException $e) {
    	    echo $e->getMessage();//Remove or change message in production code
    	}
    header('location: /index.php');
?>
