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
	$menu_ajuda = "current";


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
                <li class="current"><a href="#maintab">FAQ</a></li>
                <li><a href="#cadastrar">Contato</a></li>
              </ul>
            </nav>
          
            <!-- The content -->
            <section id="content">
              
              <div class="tab" id="maintab">
                <h2>FAQ</h2> 

                <div class="faq">
                	<ol>
                		<li>
                			<a href="#">Porque o Pro-Sis é assim?</a>
                			<div class="conteudo">
                				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>	
                			</div>
                		</li>
                		<li>
                			<a href="#">Porque o Pro-Sis é assim?</a>
                			<div class="conteudo">
                				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>	
                			</div>
                		</li>
                		<li>
                			<a href="#">Porque o Pro-Sis é assim?</a>
                			<div class="conteudo">
                				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>	
                			</div>
                		</li>
                	</ol>
                </div>

			<br />
			
					<div class="clear"></div>
              </div>
              
              <div class="tab" id="cadastrar">
                <h2>Entre em contato</h2>
  				
				<form action="receber.php" method="post" class="validar">

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
				      <label for="telefone">
				        Telefone
						<small>Por favor, escreva seu telefone para contato.</small>
				      </label>

				      <div>
				        <input type="text" class="" placeholder="Digite o seu telefone" name="telefone" id="telefone">
				      </div>
				    </section>

				    <section>
				      <label for="assunto">
				        Assunto
						<small>Por favor, escreva o assunto.</small>
				      </label>

				      <div>
				        <input type="text" class="" placeholder="Digite o assunto" name="assunto" id="assunto">
				      </div>
				    </section>

				    <section>
				      <label for="mensagem">
				        Mensagem
						<small>Por favor, descreva o seu problema ou dúvida.</small>
				      </label>

				      <div>
				        <textarea name="mensagem" id="mensagem"></textarea>
				      </div>
				    </section>

				    <section>
				    	<input type="submit" class="button primary submit" value="Enviar mensagem" />
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

  </body>
</html>