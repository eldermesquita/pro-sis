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
	$menu_config = "current";


	$adm = new Administrador();
	$login = $_SESSION['login'];
	$nome = $adm->getNome($_SESSION['login']);
	$email = $adm->getEmail($_SESSION['login']);
	$last = date('d/m/Y', strtotime($adm->getLastLogin($_SESSION['login'])));
	
	$hora_do_dia=date("H");
	$msg = "";
	

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
                <li class="current"><a href="#maintab">Minha conta</a></li>
                <li><a href="#sistema">Sistema</a></li>
              </ul>
            </nav>
          
            <!-- The content -->
            <section id="content">
              
              <div class="tab" id="maintab">
                <h2>Minha conta</h2> 

                <form action="#" method="post" class="validar minhaconta">

				    <section>
				      <label for="nome">
				        Nome
						<small>Por favor, escreva o nome completo.</small>
				      </label>

				      <div>
				        <input type="text" value="<?php echo $nome; ?>" class="required" placeholder="Digite o nome" name="nome" id="nome">
				      </div>
				    </section>

				    <section>
				      <label for="login">
				        Login
						<small>Por favor, escreva o nome completo.</small>
				      </label>

				      <div>
				        <input type="text" value="<?php echo $login; ?>" class="required" placeholder="Digite o nome" name="login" id="login">
				      </div>
				    </section>


				    <section>
				      <label for="email">
				        Email
						<small>Por favor, escreva seu email para contato.</small>
				      </label>

				      <div>
				        <input value="<?php echo $email; ?>" type="text" class="required" placeholder="Digite o seu email" name="email" id="email">
				      </div>
				    </section>

				    <section>
				      <label for="ultimo">
				        Último login
						<small>Seu último login.</small>
				      </label>

				      <div>
				        <input style="opacity: 0.6" disabled="disabled" value="<?php echo $last; ?>" type="text" name="ultimo" id="ultimo" />
				      </div>
				    </section>

				  
				    <section>
				    	<input type="submit" class="button primary submit clickminhaconta" value="Atualizar cadastro" />
				    </section>
				</form>


				

			<br />
			
					<div class="clear"></div>
              </div>
              
              <div class="tab" id="sistema">
                <h2>Entre em contato</h2>
  				
				
				
				
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
	$(document).ready(function() {
		$('.clickminhaconta').on('click', function(){
			var serializedItems = $('.minhaconta').serialize();

			ajaxPRO("atualizar_admin.php", serializedItems, ".minhaconta", "Atualizado com sucesso!", "Erro ao atualizar");

			return false;
		});
	});
	
</script>	
  </body>
</html>