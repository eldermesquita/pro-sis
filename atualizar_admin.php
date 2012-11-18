<?php 

	require "classes/db.class.php";
	require "classes/administrador.class.php";

	$db = new SimpleDb();
	$adm = new Administrador();

	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$login = $_POST['login'];

	$id = $adm->getId($login);

	$sql = "UPDATE administrador
			SET
				nome = '$nome',
				email = '$email',
				login = '$login'
			WHERE id_admin = $id";


	$isok = $db->qry($sql);

	if($isok){
		print "ok";
	}
	else
	{
		print "fail";
	}


?>