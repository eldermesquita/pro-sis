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
	require "classes/folhadeponto.class.php";
	
	$prosis = new Funcionarios();
	$total = $prosis->countFuncionarios();

	$fponto = new FolhaDePonto();
	$fponto->checarFechamentos();


						

	$sql = "SELECT * FROM fechamentoFolhaDePonto WHERE id = " . $_GET['id'];
	
	$query = $fponto->bd->qry($sql);

	$folha = $fponto->bd->fetch($query);
	
					


	//set current menu
	$menu_folhadeponto = "current";


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

<style type="text/css">
	.what {
		cursor: help;
	}

	.voltar {
		display: none;
		margin-left: 0 !important;
		margin-top: 10px;
	}

</style>

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
                <li class="current"><a href="#maintab">Fechamento</a></li>
              </ul>
            </nav>
          
            <!-- The content -->
            <section id="content">
              
              <div class="tab" id="maintab">
                <h2>Fechamento de: <?php echo "$folha->mes/$folha->ano"; ?> </h2> 

              <form id="fechamento" method="post">
              
                <table>
                	<thead>
	                	<tr>
	                		<th>Nome</th>
	                		<th>Faltas</th>
	                		<th class="what" title= "Descanso Semanal Remunerado">DSR</th>
	                		<th>Horas Extras (60%)</th>
	                		<th>Horas Extras (100%)</th>
	                		<th>Feriados</th>
	                	</tr>
                	</thead>
                	<tbody class="increase">
                		<?php
                			$sql = "SELECT cod_funcionario AS id, nome FROM funcionario";
                			$q = $fponto->bd->qry($sql);

                			$i = 0;

                			while($fp = $fponto->bd->fetch($q)):
                		?>
                		<tr>
                			<td>
                				<?php echo $fp->nome; ?> 
                				<input type="hidden" tabindex="<?php echo $i; ?>" name="id" value="<?php echo $fp->id; ?>" />
                				<input type="hidden" name="mes" value="<?php echo $folha->mes ?>" />
              					<input type="hidden" name="ano" value="<?php echo $folha->ano ?>" />
                			</td>
                			<?php $i++; ?>
                			<td><input type="text" tabindex="<?php echo $i; ?>" name="faltas" value="0" /></td>
                			<?php $i++; ?>
                			<td><input type="text" tabindex="<?php echo $i; ?>" name="dsr" value="0" /></td>
                			<?php $i++; ?>
                			<td><input type="text" tabindex="<?php echo $i; ?>" name="he60" value="0" /></td>
                			<?php $i++; ?>
                			<td><input type="text" tabindex="<?php echo $i; ?>" name="he100" value="0" /></td>
                			<?php $i++; ?>
                			<td><input type="text" tabindex="<?php echo $i; ?>" name="feriados" value="0" /></td>
                		</tr>
                		<?php
                			$i++;
                			endwhile;
                		?>
                	</tbody>
                </table>
                
              </form>
                <input type="submit" value="Salvar Folha de Ponto" class="button primary submit salvar">
               <input type="submit" onclick="location.href='folhadeponto.php'" value="Voltar" class="button primary submit voltar">
                
			<br />
				

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

	<script type="text/javascript">
		$(document).ready(function(){
			$('.increase input').keydown(function(e){
				var keynum = 0;
				var t = $(this);
				var v = t.val();

			    if(window.event) { keynum = e.keyCode; }  // IE (sucks)
			    else if(e.which) { keynum = e.which; }    // Netscape/Firefox/Opera

			    if(keynum == 38) { // up
			      	t.val(parseInt(v)+1 );
			    }

			    if(keynum == 40) { // down
			    	if(v != 0)
			       		t.val(parseInt(v) - 1 );
			    }

			});

			function folhaponto(data)
			{
				$.post("ajax_criarfolha.php", data, function(d){
					console.log(d);
				} );
				// console.log(data);
			}

			$('.salvar').click(function(){
				var total = $('#fechamento tbody tr').length;
				for(var i = 0; i < total; i++)
				{
					var data = $('#fechamento tbody tr').eq(i).find('input').serialize();
					folhaponto(data);
				}

				$('.salvar').hide();
				
				$('#fechamento').slideUp(function(){
					$('.voltar').show();
					$(this).html("<strong style='color: green; font-size: 14px'>Mês fechado com sucesso!</strong> <br />").fadeIn();
				});
			})
		});
	</script>	
	
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