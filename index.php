<?php
	
	session_start();
	
	if (!isset($_SESSION['logado'])){
		$_SESSION['logado'] = false;
	}
	
	
	require "classes/db.class.php";
	require "classes/administrador.class.php";
	
	$adm = new Administrador();
	$msg = "";
	$redirect = "";
	
	if ($_SESSION['logado']){
		$redirect = '<meta http-equiv="refresh" content="0; URL=home.php">';
	}
	
	
	if ( isset($_POST['nome']) ):
		
		$nome = htmlentities($_POST['nome']);
		$senha = htmlentities($_POST['senha']);
		
		if ($adm->logIn($nome, $senha)){
			
			$n = $nome;
			
			$nome = $adm->getNome($n);
			$_SESSION['logado'] = true;
			$_SESSION['login'] = $n;
			$_SESSION['carregando'] = true;
			
			$msg = "$('#okAparecer').fadeIn('slow'); \n";
			
			
			$redirect = '<meta http-equiv="refresh" content="2; URL=home.php">';
			
		} else {
			$msg = "$('#errorAparecer').fadeIn('slow'); \n";
		}
			
		
		
		
	endif;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />

    <title>PRÓ-SIS - Recursos Humanos - Login</title>
	
	<!-- CSS -->
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/visualize.css" />
    <link rel="stylesheet" href="css/datatables.css" />
    <link rel="stylesheet" href="css/buttons.css" />
    <link rel="stylesheet" href="css/checkboxes.css" />
    <link rel="stylesheet" href="css/inputtags.css" />
    <link rel="stylesheet" href="css/main.css" />
	<link rel="shortcut icon" href="favicon.png" type="image/x-icon">
	
	<script src="js/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/notifications.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.validate.js" type="text/javascript" charset="utf-8"></script>
    
	<script type="text/javascript" charset="utf-8">
		$(function(){
			$("body").prepend('<ul id="notifications"></ul>');
			<?php
				echo $msg;
			?>
			$("#loginForm").validate();
		});
	</script>
	
	<?php
		echo $redirect;
	?>
	<!-- CONSERTAR TAGS HTML5 -->
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>



  <body style="background: url(img/bg-login.png) repeat; height: 400px">

	<div id="container" style="width: 750px; -moz-border-radius: 25px;
	border-radius: 25px;
	-webkit-border-radius:25px; min-width: 0px; width: height: 300px; min-height: 0px; margin-top: 30px">

			          <header style="width: 600px; margin: 0 auto">

			            <!-- Logo -->
			            <h1 id="logo2">PRO-SIS</h1>



			          </header>


			          <!-- The application "window" -->
			          <div id="application" style="margin:0 auto; width: 600px">

			       
			            <section id="content">
								
								<form action="" id="loginForm" style="padding-top: 40px;" method="post">
									<section>
									      <label for="username">
									        Usuário*
									        <small>Por favor, informe seu usuário para entrar no sistema.</small>
									      </label><br />

									      <div>
									        <input type="text" minlength="3" class="required" placeholder="Seu login" name="nome" id="username">
									        
									      </div>
									    </section>
									
										<section>
										      <label for="password">
										        Senha*
										        <small>Por favor, digite sua senha para entrar no sistema.</small>
										      </label>

										      <div>
										        <input type="password" minlength="6" class="required" id="password" name="senha" placeholder="Digite sua senha">
										      
										      </div>
										    </section>
										<br />
										<img src="img/errorFixIt.png" id="errorAparecer" style="display: none; cursor: pointer;" onclick="$(this).fadeOut('slow');" title="" alt="" />
										<img src="img/okEntrou.png" id="okAparecer" style="display: none; cursor: pointer;" onclick="$(this).fadeOut('slow');" title="" alt="" />
										<input type="submit" style="float: right" value="Entrar no Sistema" class="button primary submit icon approve">
								</form>


			            </section>
			          </div>


			          <footer id="copyright" style="color: #3b3b3b; text-shadow: 1px 1px 1px #fff"> &copy; Pro-Sis <?php echo date('Y'); ?>. Todos direitos reservados. </footer>
			        </div>
		    

  </body>
</html>