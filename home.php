<?php

	session_start();
	ini_set("display_errors",  "on");
	
	if (!isset($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if (!$_SESSION['logado']){
		header('Location: index.php');
	}
	
	//set current menu
	$menu_home = "current";
	
	require "classes/funcionarios.class.php";
	require "classes/administrador.class.php";
	
	
	$prosis = new Funcionarios();
	$total = $prosis->countFuncionarios();
	$totalSalarios = number_format($prosis->totalSalario(), 2, ', ', '.');
	
	
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

    <title>PRÓ-SIS - Recursos Humanos - Principal</title>
	
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
           <?php 
           		require "menu.php";
           ?>
          
            <!-- Secondary navigation -->
            <nav id="secondary">
              <ul>
                <li class="current"><a href="#maintab">Principal</a></li>
               
              </ul>
            </nav>
          
            <!-- The content -->
            <section id="content">
              
			  
			<div id="carregando"><br />
				<img src="img/aguarde.jpg" title="" alt="" /><br />
				<img src="img/6.gif" title="" alt="" />
			</div> <!-- !carregando -->
			 
			  
              <div class="tab" id="maintab" style="display: none">
	<div id="hide">
		
	
                <h2>Olá, <strong><?php echo $nome; ?></strong>. Hoje é <span class="dataAtual"></span>, <span id="relogio"></span>.</h2> 
<div class="clear"></div>

			<div class="center">
				
				<center>
				<div id="salario" style="margin-left: 190px">
					<span><?php echo $totalSalarios; ?></span>
				</div> <!-- !salario -->
				
				<div id="funcionarios">
					<span><?php echo $total; ?></span>
				</div> <!-- !funcionarios -->
				</center>
				
				
			</div> <!-- !center -->

			<br />
</div> <!-- !hide -->
<div class="clear"></div>
              </div>
              
      
			</section>      
          </div>

        
          <footer id="copyright"> &copy; Pro-Sis 2011. Todos direitos reservados.</footer>
        </div>
      </div>
    </div>

    <!-- JavaScript -->
    <script src="js/excanvas.js"></script>
    <script src="js/jquery.js"></script>
	<script type="text/javascript" charset="utf-8">
	
		$(document).ready(function(){
			<?php
				if ($_SESSION['carregando']):
			?>
			$("#hide").hide();
			$('#carregando').fadeOut(4000, function(){
				$('#hide').fadeIn(600);
			});
			
			<?php
				else:
			?>
			
			$('#carregando').hide();
			
			<?php
				endif;
			?>
			
		});
		

	</script>
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
<?php
	$_SESSION['carregando'] = false;
?>