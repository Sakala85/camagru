<?php 
session_start();
	$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'camagru', 'camagru');

	if(!isset($_SESSION['log'])){
	  	$_SESSION['log'] = 0;
		}

	if($_SESSION['log'] === 1 && isset($_GET['like']) && $_GET['like'] === "1" && isset($_GET['user']) && $_GET['user'] === $_SESSION['user'] && isset($_GET['picture'])) {
		$IdUser = $_SESSION['IdUser'];
		$IdPicture = htmlspecialchars($_GET['picture']);
		$sth3 = $bdd->prepare("SELECT * FROM `likes` WHERE IdPicture = ? AND IdUser = ?");
    	$sth3->execute(array($IdPicture, $IdUser));
    	$IsLike = $sth3->fetch(PDO::FETCH_ASSOC);
    	if (isset($IsLike['IdUser']))
    	{
    		echo "ERROR";
    	}
    	else{
    		$bdd->exec("INSERT INTO likes (IdUser, IdPicture) VALUES ('$IdUser', '$IdPicture')");
    	}
		}
		else if($_SESSION['log'] === 1 && isset($_GET['like']) && $_GET['like'] === "0" && isset($_GET['user']) && $_GET['user'] === $_SESSION['user'] && isset($_GET['picture'])) {
			$IdUser = $_SESSION['IdUser'];
			$IdPicture = htmlspecialchars($_GET['picture']);
			$sth3 = $bdd->prepare("SELECT * FROM `likes` WHERE IdPicture = ? AND IdUser = ?");
    		$sth3->execute(array($IdPicture, $IdUser));
    		$IsLike = $sth3->fetch(PDO::FETCH_ASSOC);
    		if (isset($IsLike['IdUser']))
    		{
    			$bdd->exec("DELETE FROM likes WHERE IdUser = $IdUser AND IdPicture = $IdPicture");
    		}
    		else{
				echo "ERROR";
    		}
		}
		 ?>
