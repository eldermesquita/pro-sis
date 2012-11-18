<?php

	require "classes/funcionarios.class.php";
	$func =  new Funcionarios();
	$func->setId($_GET['id']);
	
	if( $func->removerFuncionario() )
	{
		echo '<div style="width: 453px; height: 55px;">
				<img src="img/registroExcludo.png" title="" alt="" />
		  	</div>
		 ';
	}
	
	
?>