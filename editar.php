<?php
	
		session_start();

		if (!isset($_SESSION['logado'])){
			header('Location: index.php');
		}

		if (!$_SESSION['logado']){
			header('Location: index.php');
		}
	
	$id = $_GET['id'];
	

	
	require "classes/funcionarios.class.php";
	require "classes/administrador.class.php";
	
	$prosis = new Funcionarios();
	$total = $prosis->countFuncionarios();

	$edit = "SELECT funcionario.*, contrato.*, documentos.*, endereco.*, telefone.* ".
 			"FROM funcionario, contrato, documentos, endereco, telefone " .
 			"WHERE  funcionario.cod_funcionario = contrato.cod_funcionario " .
  			"AND funcionario.cod_funcionario = documentos.cod_funcionario " .
  			"AND funcionario.cod_funcionario = endereco.cod_funcionario " .
  			"AND funcionario.cod_funcionario = telefone.cod_funcionario " .
  			"AND funcionario.cod_funcionario = " . $id;
	
	$funcionario = mysql_fetch_object(mysql_query($edit));


	$adm = new Administrador();
	$login = $_SESSION['login'];
	$nome = $adm->getNome($_SESSION['login']);
	$email = $adm->getEmail($_SESSION['login']);
	$last = date('d/m/Y', strtotime($adm->getLastLogin($_SESSION['login'])));
	
	$hora_do_dia=date("H");
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
            <nav id="primary">
              <ul>
                <li>
                  <a href="home.php">
                    <span class="icon home"></span>
                    Home
                  </a>

                </li>
                
                <li class="current">
                  <a href="funcionarios.php">
                    <span class="icon funcionario"></span>
                    Funcionários
					<span class="contador"><?php echo $total; ?></span>
                  </a>
                </li>

				<li>
                  <a href="naoimplementado.php">
                    <span class="icon ponto"></span>
                    Folha de Ponto
                  </a>

                </li>
                
                <li >
                  <a href="naoimplementado.php">

                    <span class="icon remuneracao"></span>
                    Remuneração
                  </a>
                </li>

                <li >
                  <a href="naoimplementado.php">
                    <span class="icon folha"></span>
                    

                    Folha de Pagamento
                  </a>
                </li>
                
                <li >
                  <a href="naoimplementado.php">
                    <span class="icon relatorios"></span>
                    Relatorios
                  </a>
                </li>

				<li >
                  <a href="naoimplementado.php">
                    <span class="icon administrador"></span>
                    Administradores
                  </a>
                </li>

				<li >
                  <a href="naoimplementado.php">
                    <span class="icon ajuda"></span>
                    Ajuda
                  </a>
                </li>

                <li >
                  <a href="sair.php">
                    <span class="icon sair"></span>
                    Sair
                  </a>
                </li>               
              </ul>
            
             
            </nav>
          
            <!-- Secondary navigation -->
            <nav id="secondary">
              <ul>
                <li class="current"><a href="#maintab">Editar Funcionário</a></li>
              </ul>
            </nav>
          
            <!-- The content -->
            <section id="content">
              
              <div class="tab" id="maintab">
                <h2>Você está editando o usuário: <strong><?php echo $funcionario->nome; ?></strong></h2>
                <input type="submit" value="Salvar" class="salvarEdit button primary submit">
                
  				<input type="submit" value="Voltar" onclick="history.go(-1)" style="margin-top: -20px" class="button primary submit"/>
				<br /> <br />
				
				<h3>Dados Pessoais</h3>
					<form action="receber.php?editar" id="editarFunc" method="post" novalidate="novalidate">
					  
					<input type="hidden" value="<?php echo $funcionario->cod_funcionario; ?>" name="id" />
					
						
					  <div class="column left">
					    <section>
					      <label for="nome">
					        Nome
							<small>Por favor, escreva o nome completo.</small>
					      </label>

					      <div>
					        <input type="text" value="<?php echo $funcionario->nome; ?>" name="nome" id="nome">
					      </div>
					    </section>


					    <section>
					      <label for="nasc">
					        Data de Nascimento
							<small>Por favor, digite a data de nascimento.</small>	
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
									<small>Por favor, digite a sua etnia.</small>	
							      </label>

							      <div>
							        <input type="text" class="large" value="<?php echo $funcionario->etnia; ?>" id="etnia" name="etnia">
							      </div>
							    </section>

								<section>
							      <label for="estCivil">
							        Estado Civil
									<small>Por favor, digite a seu estado civil.</small>	
							      </label>

							      <div>
							        <select name="estCivil" id="estCivil">
							        	<option value="<?php echo $funcionario->estado_civil; ?>"><?php echo $funcionario->estado_civil; ?></option>
							        	<option value="Solteiro">Solteiro(a)</option>
										<option value="Casado">Casado(a)</option>
										<option value="Viúvo">Viúvo(a)</option>
									</select>
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
					        <small>Por favor, digite seu CEP.</small>
					      </label>

					      <div>
					        <input type="text" minlength="3" value="<?php echo $funcionario->cep; ?>" name="cep">
					      </div>
					    </section>

						<section>
					      <label for="cep">
					        Rua
					        <small>Por favor, digite sua rua.</small>
					      </label>

					      <div>
					        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->rua; ?>" name="rua" id="rua">
					      </div>
					    </section>

						<section>
					      <label for="bairro">
					        Bairro
					        <small>Por favor, digite sua bairro.</small>
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
					        <small>Por favor, digite sua bairro.</small>
					      </label>

					      <div>
					        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->cidade; ?>" name="cidade" id="cidade">
					      </div>
					    </section>

						<section>
					      <label for="estado">
					        Estado
					        <small>Por favor, digite seu estado.</small>
					      </label>

					      <div>
					        <input type="text" minlength="2" class="required" value="<?php echo $funcionario->estado; ?>" name="estado" id="estado">
					      </div>
					    </section>

						<section>
					      <label for="numero">
					        Número
					        <small>Por favor, digite o número da sua casa.</small>
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
					        <small>Por favor, digite seu telefone.</small>
					      </label>

					      <div>
					        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->telefone; ?>" name="telefone" id="telefone">

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
						        <small>Por favor, digite seu CPF. </small>
						      </label>

						      <div>
						        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->cpf; ?>" name="cpf" id="cpf">

						      </div>
						    </section>

							<section>
						      <label for="rg">
						        RG
						        <small>Por favor, digite seu RG. </small>
						      </label>

						      <div>
						        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->rg; ?>" name="rg" id="rg">

						      </div>
						    </section>

							<section>
						      <label for="cnh">
						        CNH
						        <small>Por favor, digite sua CNH. </small>
						      </label>

						      <div>
						        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->cnh; ?>" name="cnh" id="cnh">

						      </div>
						    </section>

							<section>
						      <label for="pis">
						        PIS
						        <small>Por favor, digite do PIS. </small>
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
						        <small>Por favor, digite do título eleitoral.</small>
						      </label>

						      <div>
						        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->titulo_eleitoral; ?>" name="tituloeleitoral" id="tituloeleitoral">
						      </div>
						    </section>

							<section>
						      <label for="escolaridade">
						        Escolaridade
						        <small>Por favor, selecione sua escolaridade.</small>
						      </label>

						      	<div>
							        <select name="escolaridade" id="escolaridade">
										<option value="<?php echo $funcionario->escolaridade; ?>" selected><?php echo $funcionario->escolaridade; ?></option>
							        	<option value="Primeiro Grau Incompleto">1° Grau - Primário Incompleto</option>
																			<option value="Primeiro Grau Completo">1° Grau - Primário Completo</option>
																			<option value="Ginasial Incompleto">1° Grau - Ginasial Incompleto</option>
																			<option value="Ginasial Completo">1° Grau - Ginasial Completo</option>
																			<option value="Segundo Grau Incompleto">2° Grau - Colegial Incompleto</option>
																			<option value="Segundo Grau Completo">2° Grau - Colegial Completo</option>
																			<option value="Terceiro Grau Incompleto">3° Grau - Superior Incompleto</option>
																			<option value="Terceiro Grau Completo">3° Grau - Superior Completo</option>
																			<option value="Especialização">Especialização</option>
																			<option value="Mestrado">Mestrado</option>
																			<option value="Doutorado">Doutorado</option>
							        </select>
							      </div>
						    </section>

							<section>
						      <label for="nacionalidade">
						        Nacionalidade
						        <small>Por favor, digite a sua nacionalidade.</small>
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
							        <small>Por favor, digite seu Cargo.</small>
							      </label>

							      <div>
							        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->cargo; ?>" name="cargo" id="cargo">

							      </div>
							    </section>


									<section>
								      <label for="salarioValor">
								        Salário
								        <small>Por favor, digite seu salário.</small>
								      </label>

								      <div>
								        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->salario; ?>" name="salario" id="salarioValor">
								      </div>
								    </section>

								<section>
							      <label for="cargahoraria">
							        Carga Horaria
							        <small>Por favor, digite sua carga horária. </small>
							      </label>

							      <div>
							        <input type="text" class="required" value="<?php echo $funcionario->carga_horaria; ?>" name="cargahoraria" id="cargahoraria">

							      </div>
							    </section>



								<section>
							      <label for="admissao">
							        Data de Admissão
							        <small>Por favor, digite sua data de admissão. </small>
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
							        <small>Por favor, selecione seu banco.</small>
							      </label>

							      <div>
							        <select name="banco" id="banco">
										<option value="<?php echo $funcionario->banco_pagamento; ?>" selected><?php echo $funcionario->banco_pagamento; ?></option>
							        	<option value="Banco do Brasil">Banco do Brasil</option>
							        	<option value="Banco Real">Banco Real</option>
							        	<option value="HSBC">HSBC</option>
										<option value="Bradesco">Bradesco</option>
										<option value="Santander">Santander</option>
										<option value="Caixa Econômica">Caixa Econômica</option>
										<option value="Nossa Caixa">Nossa Caixa</option>
										<option value="Itaú">Itaú</option>
										<option value="Safra">Safra</option>
										<option value="CitiBank">CitiBank</option>
							        </select>
							      </div>
							    </section>

								<section>
							      <label for="agencia">
							        Agência
							        <small>Por favor, digite a agência de seu banco.</small>
							      </label>

							      <div>
							        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->agencia_pagamento; ?>" name="agencia" id="agencia">

							      </div>
							    </section>

									<section>
								      <label for="conta">
								        Conta
								        <small>Por favor, digite o número de sua conta bancária.</small>
								      </label>

								      <div>
								        <input type="text" minlength="3" class="required" value="<?php echo $funcionario->conta_pagamento; ?>" name="conta" id="conta">

								      </div>
								    </section>




							</div>

						  <div class="clear"></div>

						 <br />


					  <p>
					    <input type="submit" value="Salvar" class="salvarEdit button primary submit">
					  </p>

					</form>
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
							        <small>Busque por id, nome, rg ou função.</small>
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
	<?php
		if (isset($_GET['ok'])):
	?>
	<script type="text/javascript">
	$(document).ready(function(){
		$.fancybox(
			'<img src="img/editado.jpg" />',
			{
					'autoDimensions'    : false,
				'width'                 : '480',
				'height'                : '70',
				'transitionIn'      : 'none',
				'transitionOut'     : 'none'
			}
		);
	});

	</script>
	<?php
		endif;
	?>
  </body>
</html>