<?php

	require "classes/db.class.php";
	require "classes/folhadeponto.class.php";

	$bd = new SimpleDb();
	$fponto = new FolhaDePonto();

	$mes = $_POST['mes'];
	$ano = $_POST['ano'];
	$id = $_POST['id'];
	$faltas = $_POST['faltas'];
	$dsr = $_POST['dsr'];
	$he60 = $_POST['he60'];
	$he100 = $_POST['he100'];
	$feriados = $_POST['feriados'];

	$fponto->setCodFuncionario($id);
	$fponto->setAno($ano);
	$fponto->setMes($mes);
	$fponto->setFaltas($faltas);
	$fponto->setDsr($dsr);
	$fponto->setHe60($he60);
	$fponto->setHe100($he100);
	$fponto->setFeriado($feriados);
	$fponto->cadastrar();

