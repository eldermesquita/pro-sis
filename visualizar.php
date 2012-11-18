<?php
	
		session_start();

		if (!isset($_SESSION['logado'])){
			header('Location: index.php');
		}

		if (!$_SESSION['logado']){
			header('Location: index.php');
		}
	
	
	require "classes/funcionarios.class.php";
	require "classes/administrador.class.php";
	
	$prosis = new Funcionarios();
	$total = $prosis->countFuncionarios();

	//set current menu
	$menu_funcionarios = "current";

	$id = $_GET['id'];

	$edit = "SELECT funcionario.*, contrato.*, documentos.*, endereco.*, telefone.* ".
 			"FROM funcionario, contrato, documentos, endereco, telefone " .
 			"WHERE  funcionario.cod_funcionario = contrato.cod_funcionario " .
  			"AND funcionario.cod_funcionario = documentos.cod_funcionario " .
  			"AND funcionario.cod_funcionario = endereco.cod_funcionario " .
  			"AND funcionario.cod_funcionario = telefone.cod_funcionario " .
  			"AND funcionario.cod_funcionario = " . $id;

	// echo "<script>prompt('', '$edit')</script>";  

	// $edit = "SELECT * FROM funcionario WHERE cod_funcionario = " . $id;
	
	$funcionario = mysql_fetch_object(mysql_query($edit));

	$adm = new Administrador();
	$login = $_SESSION['login'];
	$nome = $adm->getNome($_SESSION['login']);
	$email = $adm->getEmail($_SESSION['login']);
	$last = date('d/m/Y', strtotime($adm->getLastLogin($_SESSION['login'])));
	
	$hora_do_dia = date("H");
	$msg = "";
	
	/*uso de condicionais, poderíamos utilizar o switch também*/

	if (($hora_do_dia >=6) && ($hora_do_dia <=12)) $msg = "Bom dia, ";
	if (($hora_do_dia >12) && ($hora_do_dia <=18)) $msg = "Boa tarde, ";
	if (($hora_do_dia >18) && ($hora_do_dia <=24)) $msg = "Boa noite, ";
	if (($hora_do_dia >24) && ($hora_do_dia <6)) $msg = "Boa madrugada, ";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />

    <title>PRÓ-SIS - Recursos Humanos - Funcionários</title>
	
	<!-- CSS -->
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/visualize.css" />
    <link rel="stylesheet" href="css/datatables.css" />
    <link rel="stylesheet" href="css/buttons.css" />
    <link rel="stylesheet" href="css/checkboxes.css" />
    <link rel="stylesheet" href="css/inputtags.css" />
    <link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css" />
	<link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    
	<!-- CONSERTAR TAGS HTML5 -->
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>
	<div style="display: none">

		<div id="meuPerfil">
			<img src="img/meuPerfil.jpg" title="" alt="" />

			<div id="boxPerfil">
				<span class="login"><?php echo $login; ?></span>
				<div class="clear"></div>
				<span class="nome"><?php echo $nome; ?></span>
				<span class="email"><?php echo $email; ?></span>

				<div id="log">
					<span class="last"><?php echo $last; ?></span>
				</div> <!-- !log -->

			</div> <!-- !box -->

		</div> <!-- !meuPerfil -->
		
		<div id="confirmarExclusao">
			<div id="alinhar">
				<a href="#" onclick="parent.$.fancybox.close();" class="cancelar">Cancelar</a>
				<a href="#" class="excluir" id="linkExcluir">Excluir</a>
			</div> <!-- !alinhar -->
		</div> <!-- !confirmarExclusao -->
		

	</div> <!-- !perfil -->
    <div id="gradient">
      <div id="stars">
        <div id="container">
        
          <header>
          
            <!-- Logo -->
            <h1 id="logo">PRO-SIS</h1>
          
            <!-- User info -->
            <div id="userinfo">

              
              <div class="intro">
               <?php echo $msg.$nome; ?>.<br />
               <a href="#meuPerfil" id="abrirPerfil">Meu Perfil</a> | <a href="sair.php">Sair</a>
              </div>
            </div>
          
          </header>

        
          <!-- The application "window" -->
          <div id="application">
          
            <!-- Primary navigation -->
           <?php require "menu.php"; ?>
          
            <!-- Secondary navigation -->
            <nav id="secondary">
              <ul>
                <li class="current"><a href="#maintab">Visualizar Funcionário</a></li>
              </ul>
            </nav>
          
            <!-- The content -->
            <section id="content">
              
              <div class="tab" id="maintab">
                <h2>Você está visualizando o usuário: <strong><?php echo $funcionario->nome; ?></strong></h2>
  				<input type="submit" value="Voltar" onclick="history.go(-1)" style="margin-top: -20px" class="button primary submit"> <input type="submit" value="Imprimir" onclick="window.print()" style="margin-top: -20px" class="button primary submit">
				<br /><br />
				
				<h3>Dados Pessoais</h3>
				<form>

					  <div class="column left">
					    <section>
					      <label for="nome">
					        Nome
							
					      </label>

					      <div>
					        <input type="text" value="<?php echo $funcionario->nome; ?>" name="nome" id="nome">
					      </div>
					    </section>


					    <section>
					      <label for="nasc">
					        Data de Nascimento
								
					      </label>

					      <div>
					        <input type="text" class="medium" value="<?php echo $funcionario->data_nascimento; ?>" id="" name="nasc">
					      </div>
					    </section>



					  </div>

					  <div class="column right">

						   		<section>
							      <label for="etnia">
							        Etnia
										
							      </label>

							      <div>
							        <input type="text" value="<?php echo $funcionario->etnia; ?>" id="etnia" name="etnia">
							      </div>
							    </section>

								<section>
							      <label for="estCivil">
							        Estado Civil
										
							      </label>

							      <div>
							       <input type="text" value="<?php echo $funcionario->estado_civil; ?>" id="estCivil" name="etnia">
							      </div>
							    </section>


					  </div>
					<div class="clear"></div>
					<br /><br />

					<h3>Endereço</h3>

					<div class="column left">

						<section>
					      <label for="cep">
					        CEP
					        
					      </label>

					      <div>
					        <input type="text" minlength="3" value="<?php echo $funcionario->cep; ?>" name="cep">
					      </div>
					    </section>

						<section>
					      <label for="cep">
					        Rua
					        
					      </label>

					      <div>
					        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->rua; ?>" name="rua" id="rua">
					      </div>
					    </section>

						<section>
					      <label for="bairro">
					        Bairro
					        
					      </label>

					      <div>
					        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->bairro; ?>" name="bairro" id="bairro">
					      </div>
					    </section>



					</div>

					<div class="column right">
						<section>
					      <label for="cidade">
					        Cidade
					        
					      </label>

					      <div>
					        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->cidade; ?>" name="cidade" id="cidade">
					      </div>
					    </section>

						<section>
					      <label for="estado">
					        Estado
					        
					      </label>

					      <div>
					        <input type="text" minlength="2" class="required" value="<?php echo $funcionario->estado; ?>" name="estado" id="estado">
					      </div>
					    </section>

						<section>
					      <label for="numero">
					        Número
					        
					      </label>

					      <div>
					        <input type="text" class="required" value="<?php echo $funcionario->numero; ?>" name="numero" id="numero">

					      </div>
					    </section>



					</div>
					<div class="clear"></div>
				<br /><br />


					<h3>Contato</h3>

					<div class="column left">

						<section>
					      <label for="telefone">
					        Telefone
					        
					      </label>

					      <div>
<input type="text" minlength="3" class="required" value="<?php echo $funcionario->telefone; ?>" name="telefone" id="">

					      </div>
					    </section>

					</div>

					<div class="clear"></div>

					<br /><br />


						<h3>Documentos</h3>

						<div class="column left">

							<section>
						      <label for="cpf">
						        CPF
						        
						      </label>

						      <div>
						        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->cpf; ?>" name="cpf" id="cpf">

						      </div>
						    </section>

							<section>
						      <label for="rg">
						        RG
						        
						      </label>

						      <div>
						        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->rg; ?>" name="rg" id="rg">

						      </div>
						    </section>

							<section>
						      <label for="cnh">
						        CNH
						        
						      </label>

						      <div>
						        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->cnh; ?>" name="cnh" id="cnh">

						      </div>
						    </section>

							<section>
						      <label for="pis">
						        PIS
						        
						      </label>

						      <div>
						        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->pis; ?>" name="pis" id="pis">

						      </div>
						    </section>

						</div>

						<div class="column right">
							<section>
						      <label for="tituloeleitoral">
						        Titulo Eleitoral
						        
						      </label>

						      <div>
						        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->titulo_eleitoral; ?>" name="tituloeleitoral" id="tituloeleitoral">
						      </div>
						    </section>

							<section>
						      <label for="escolaridade">
						        Escolaridade
						        
						      </label>

						      	<div>
						      	 <input type="text" minlength="3" class="required" value="<?php echo $funcionario->escolaridade; ?>">
							      </div>
						    </section>

							<section>
						      <label for="nacionalidade">
						        Nacionalidade
						        
						      </label>

						      <div>
						        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->nacionalidade; ?>" name="nacionalidade" id="nacionalidade">

						      </div>
						    </section>



						</div>

						<div class="clear"></div>
					<br /><br />





							<h3>Contrato</h3>

							<div class="column left">

								<section>
							      <label for="cargo">
							        Cargo
							        
							      </label>

							      <div>
							        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->cargo; ?>" name="cargo" id="cargo">

							      </div>
							    </section>


									<section>
								      <label for="salarioValor">
								        Salário
								        
								      </label>

								      <div>
								        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->salario; ?>" name="salario" id="salarioValor">
								      </div>
								    </section>

								<section>
							      <label for="cargahoraria">
							        Carga Horaria
							        
							      </label>

							      <div>
							        <input type="text" class="required" value="<?php echo $funcionario->carga_horaria; ?>" name="cargahoraria" id="cargahoraria">

							      </div>
							    </section>



								<section>
							      <label for="admissao">
							        Data de Admissão
							        
							      </label>

							      <div>
							        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->data_admissao; ?>" name="admissao" id="admissao">

							      </div>
							    </section>

							</div>


		<div class="column right">
								<section>
							      <label for="banco">
							        Banco
							        
							      </label>

							      <div>
							       <input type="text" minlength="3" class="required" value="<?php echo $funcionario->banco_pagamento; ?>" />
							      </div>
							    </section>

								<section>
							      <label for="agencia">
							        Agência
							        
							      </label>

							      <div>
							        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->agencia_pagamento; ?>" name="agencia" id="agencia">

							      </div>
							    </section>

									<section>
								      <label for="conta">
								        Conta
								        
								      </label>

								      <div>
								        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->conta_pagamento; ?>" name="conta" id="conta">

								      </div>
								    </section>




							</div>

						  <div class="clear"></div>

						 <br />


					 

					</form>
					 <p>
					    <button value="" onclick="history.go(-1)" style="margin-top: -20px" class="button primary submit">Voltar</button> 
					    <button value="" onclick="window.print()" style="margin-top: -20px" class="button primary submit">Imprimir</button> 
					  </p>
<div class="clear"></div>
              </div>
              
              <div class="tab" id="cadastrar">
                
				
					
              </div>

             
				<div id="buscar" class="tab">
					<h2>Buscar Funcionário</h2>
						<form action="home.html" method="post">
							<section>
							      <label for="username">
							        Buscar Funcionário
							        
							      </label>

							      <div>
							        <input type="text" minlength="3" class="required" placeholder="Pesquisar" name="username" id="username">
							        
							      </div>
							    </section>
							
								<br />
								<p>
								    <input type="submit" value="Buscar Funcionário" class="button primary submit">
								  </p>
						</form><br />
				</div> <!-- !buscar -->

            </section>
          </div>

        
          <footer id="copyright">&copy; Pro-Sis 2011. Todos direitos reservados.</footer>
        </div>
      </div>
    </div>

    <!-- JavaScript -->
    <script src="js/excanvas.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.livesearch.js"></script>
    <script src="js/jquery.visualize.js"></script>
    <script src="js/jquery.datatables.js"></script>
    <script src="js/jquery.placeholder.js"></script>
    <script src="js/jquery.selectskin.js"></script>
    <script src="js/jquery.checkboxes.js"></script>
    <script src="js/jquery.wymeditor.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/jquery.inputtags.js"></script>
    <script src="js/notifications.js"></script>
    <script src="js/application.js"></script>
	<script src="js/fancybox/jquery.fancybox-1.3.4.js"></script>

  </body>
</html>