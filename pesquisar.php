<?php
	
		session_start();

		if (!isset($_SESSION['logado'])){
			header('Location: index.php');
		}

		if (!$_SESSION['logado']){
			header('Location: index.php');
		}
	
	$p = $_POST['pesquisa'];
	

	
	require "classes/funcionarios.class.php";
	require "classes/administrador.class.php";
	
	$prosis = new Funcionarios();
	$total = $prosis->countFuncionarios();

	// $edit = "SELECT * FROM inf WHERE cod_funcionario = " . $id;
	
	// $funcionario = mysql_fetch_object(mysql_query($edit));

	//set current menu
	$menu_funcionarios = "current";

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
            <?php require "menu.php"; ?>
          
            <!-- Secondary navigation -->
            <nav id="secondary">
              <ul>
                <li class="current"><a href="#maintab">Pesquisar Funcionário</a></li>
              </ul>
            </nav>
          
            <!-- The content -->
            <section id="content">
              
              <div class="tab" id="maintab">
                <h2>Você está pesquisando por: <strong><?php echo $p; ?></strong></h2>
  				<br />
				
				<table class="datatable">
				    <thead>

				      <tr>
						<th>ID</th>
				        <th>Nome Completo</th>
						<th>CPF</th>
				        <th>Cargo</th>
				        <th>Telefone</th>
						<th>Salário</th>
						<th>Ações</th>
						
				      </tr>
				    </thead>

				    <tbody>
					
					<?php

					$p = $_POST['pesquisa'];
					$sql = 
						"SELECT 
							f.cod_funcionario AS cod_funcionario, 
							f.nome AS nome, 
							t.telefone AS telefone,
							d.cpf AS cpf, 
							d.rg AS rg,
							c.cargo AS cargo, 
							c.salario AS salario

						FROM funcionario AS f

						INNER JOIN documentos AS d ON
							d.cod_funcionario = f.cod_funcionario

						INNER JOIN telefone AS t ON
							t.cod_funcionario = f.cod_funcionario

						INNER JOIN contrato AS c ON
							c.cod_funcionario = f.cod_funcionario
						
						WHERE f.cod_funcionario 
							LIKE '%$p%' 

						OR f.nome 
						LIKE '%$p%' 

						OR d.cpf LIKE '%$p%' 

						OR d.rg LIKE '%$p%' 

						OR c.cargo LIKE '%$p%'";

						// echo $sql;

						// $sql = "SELECT cod_funcionario, nome, cpf, cargo, telefone, salario FROM inf WHERE cod_funcionario LIKE '%$p%' OR nome LIKE '%$p%' OR cpf LIKE '%$p%' OR rg LIKE '%$p%' OR cargo LIKE '%$p%'";
						
						$query = mysql_query($sql);
						
						while($inf = mysql_fetch_object($query)):
					?>
					
				      <tr>
				        <td><?php echo $inf->cod_funcionario; ?></td>
				        <td><?php echo $inf->nome; ?></td>
						<td><?php echo $inf->cpf; ?></td>
				        <td><?php echo $inf->cargo; ?></td>
						<td><?php echo $inf->telefone; ?></td>
						<td>R$ <?php echo number_format($inf->salario, 2, ', ', '.'); ?></td>
						<td>
						  <span class="button-group">
							  <a href="visualizar.php?id=<?php echo $inf->cod_funcionario; ?>" class="button icon user">Ver</a>
						      <a href="editar.php?id=<?php echo $inf->cod_funcionario; ?>" class="button icon edit">Editar</a>
						      <a href="#confirmarExclusao" class="button icon remove danger excluir" onclick="document.getElementById('linkExcluir').href='excluir.php?id=<?php echo $inf->cod_funcionario; ?>'">Deletar</a>
						  </span>
						 </td>
				       
				      </tr>
				
					<?php
						endwhile;
					?>

				     
				    </tbody>
				  </table>

	
					
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

  </body>
</html>