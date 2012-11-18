<?php
	session_start();
	unset($_SESSION['logado']);
	unset($_SESSION['login']);
	
	header('Location: index.php');
?>