<?php
	
	require "classes/funcionarios.class.php";

	
	$funcionario = new Funcionarios();
	
	$id = null;

	if( isset($_GET['editar']) )
	{
		$id = @$_POST['id'];
	}


	$funcionario->setId($id);
	$funcionario->setNome( $_POST['nome'] );
	$funcionario->setDataNascimento ( $_POST['nasc'] );
	$funcionario->setEtnia ( $_POST['etnia'] );
	$funcionario->setEstadoCivil ( $_POST['estCivil'] );
	$funcionario->setCep ( $_POST['cep'] );
	$funcionario->setRua ( $_POST['rua'] );
	$funcionario->setBairro ( $_POST['bairro'] );
	$funcionario->setCidade ( $_POST['cidade'] );
	$funcionario->setEstado ( $_POST['estado'] );
	$funcionario->setNumero ( $_POST['numero'] );
	$funcionario->setTelefone ( $_POST['telefone'] );
	$funcionario->setCpf ( $_POST['cpf'] );
	$funcionario->setRg ( $_POST['rg'] );
	$funcionario->setCnh ( $_POST['cnh'] );
	$funcionario->setPis ( $_POST['pis'] );
	$funcionario->setTituloEleitoral ( $_POST['tituloeleitoral'] );
	$funcionario->setEscolaridade ( $_POST['escolaridade'] );
	$funcionario->setNacionalidade ( $_POST['nacionalidade'] );
	$funcionario->setCargo ( $_POST['cargo'] );
	$funcionario->setSalario ( $_POST['salario'] );
	$funcionario->setCargaHoraria ( $_POST['cargahoraria'] );
	$funcionario->setAdiantamento( (int) $funcionario->getSalario() * 0.4 ); //_POST['adiantamento'];
	$funcionario->setAdmissao ( $_POST['admissao'] );
	$funcionario->setBanco ( $_POST['banco'] );
	$funcionario->setAgencia ( $_POST['agencia'] );
	$funcionario->setConta ( $_POST['conta'] );


	$funcionario->salvar();

	
?>