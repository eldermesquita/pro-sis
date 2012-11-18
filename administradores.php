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
	$menu_admins = "current";


	$adm = new Administrador();
	$login = $_SESSION['login'];
	$nome = $adm->getNome($_SESSION['login']);
	$email = $adm->getEmail($_SESSION['login']);
	$last = date('d/m/Y', strtotime($adm->getLastLogin($_SESSION['login'])));
	
	$hora_do_dia=date("H");
	$msg = "";
	

	// if( isset( $_POST['nome'] ) )
	// {
	// 	$nome = $_POST['nome'];
	// 	$senha = $_POST['senha'];
	// 	$email = $_POST['email'];
	// 	$login = $_POST['login'];
	// 	$lastLogin = "";

	// 	$sql = "INSERT INTO administrador
	// 		   		(login, email, senha, nome, ultimo_login) 
	// 			VALUES
	// 				('$login', '$email', '$senha', '$nome', '$lastLogin')";

	// 	print $sql;

	// 	mysql_query($sql);

	// }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />

    <title>PRÓ-SIS - Recursos Humanos - Ajuda</title>
	
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
                <li class="current"><a href="#maintab">Administradores</a></li>
                <li><a href="#cadastrar">Adicionar Administrador</a></li>
              </ul>
            </nav>
          
            <!-- The content -->
            <section id="content">
              
              <div class="tab" id="maintab">
                <h2>Listagem de Administradores</h2> 

              <table class="datatable">
				    <thead>

				      <tr>
						<th>ID</th>
				        <th>Nome Completo</th>
						<th>Login</th>
				        <th>Email</th>
				        <th>Último login</th>
				      </tr>
				    </thead>

				    <tbody>
					



					<?php

						

						$sql = "SELECT * FROM administrador WHERE login <> '" . $_SESSION['login'] . "'";
						
						$query = mysql_query($sql);
						
						while($inf = mysql_fetch_object($query)):
					?>
					
				      <tr>
				        <td><?php echo $inf->id_admin; ?></td>
				        <td><?php echo $inf->nome; ?></td>
						<td><?php echo $inf->login; ?></td>
				        <td><?php echo $inf->email; ?></td>
				        <td><?php echo $inf->ultimo_login; ?></td>
						
				      </tr>
				
					<?php
						endwhile;
					?>

				     
				    </tbody>
				  </table>


			<br />
			
					<div class="clear"></div>
              </div>
              
              <div class="tab" id="cadastrar">
                <h2>Cadastrar Administrador</h2>
  				
				<form action="#" method="post" class="validar">

					 <section>
				      <label for="login">
				        Login
						<small>Por favor, escreva seu usuário para login.</small>
				      </label>

				      <div>
				        <input type="text" class="required" placeholder="Digite o login" name="login" id="login">
				      </div>
				    </section>

				     <section>
				      <label for="senha">
				        Senha
						<small>Por favor, escreva sua senha para login.</small>
				      </label>

				      <div>
				        <input type="password" class="required" placeholder="Digite a senha" name="senha" id="senha">
				      </div>
				    </section>

				    <section>
				      <label for="nome">
				        Nome
						<small>Por favor, escreva o nome completo.</small>
				      </label>

				      <div>
				        <input type="text" class="required" placeholder="Digite o nome" name="nome" id="nome">
				      </div>
				    </section>


				    <section>
				      <label for="email">
				        Email
						<small>Por favor, escreva seu email para contato.</small>
				      </label>

				      <div>
				        <input type="text" class="required" placeholder="Digite o seu email" name="email" id="email">
				      </div>
				    </section>

				 
				    <section>
				    	<input type="submit" class="button primary submit" value="Cadastrar administrador" />
				    </section>
				</form>
				
				
					<div class="clear"></div>
              </div>


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
			'<img src="img/sucesso.jpg" />',
			{
					'autoDimensions'    : false,
				'width'                 : '500',
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

	<script type="text/javascript">
	$(document).ready(function(){
		$('.submit').on('click', function(){

			var data = $('.validar').serialize();



				$.ajax({
					url: "ajax_administradores.php",
					data: data,
					type: "post",

					success: function(data) {
						var msg = "<p class='success' style='display: none;'>Cadastrado com sucesso!</p>";
						$('.validar').after(msg);
						// $('.fail').remove()l;
						$('.validar').slideUp();
						$('.success').fadeIn();
						$('#container').css('height', window.innerHeight + "px");
						
					}
				});	

			return false;
				
		});

	});

	</script>

  </body>
</html>