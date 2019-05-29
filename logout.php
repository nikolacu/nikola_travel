<?php
	
	if(isset($_SESSION['korIme']))
	{
		unset($_SESSION['uloga']);
		unset($_SESSION['korIme']);
        unset($_SESSION['id']);
		
		session_destroy();
		header('Location:index.php');
	}
	else
	{
		header('Location:index.php');
	}
?>