<?php 

	require "classes/db.class.php";

	$db = new SimpleDb();

	$nome = $_POST['nome'];
	$senha = $_POST['senha'];
	$email = $_POST['email'];
	$login = $_POST['login'];
	$lastLogin = "";

	$sql = "INSERT INTO administrador
		   		(login, email, senha, nome, ultimo_login) 
			VALUES
				('$login', '$email', '$senha', '$nome', '$lastLogin')";

	$isok = $db->qry($sql);

	if($isok){
		print "ok";
	}
	else
	{
		print "fail";
	}


?>