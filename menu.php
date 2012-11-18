<?php 

    function __($t) {
      echo $t;
    };

    if( !isset( $menu_home ) )
    {
      $menu_home = "";
    }

    if( !isset( $menu_funcionarios ) )
    {
      $menu_funcionarios = "";
    }

    if( !isset( $menu_folhadeponto ) )
    {
      $menu_folhadeponto = "";
    }

    if( !isset( $menu_folhadepagamento ) )
    {
      $menu_folhadepagamento = "";
    }

    if( !isset( $menu_relatorios) )
    {
      $menu_relatorios = "";
    }

     if( !isset( $menu_config) )
    {
      $menu_config = "";
    }

    if( !isset( $menu_admins) )
    {
      $menu_admins = "";
    }

    if( !isset( $menu_ajuda) )
    {
      $menu_ajuda = "";
    }
?>

 <nav id="primary">
              <ul>
                <li class="<?php __($menu_home); ?>">
                  <a href="home.php">
                    <span class="icon home"></span>
                    Home
                  </a>

                </li>
                
                <li class="<?php __($menu_funcionarios); ?>">
                  <a href="funcionarios.php">
                    <span class="icon funcionario"></span>
                    Funcionários
					         <span class="contador"><?php echo $total; ?></span>
                  </a>
                </li>

				      <li class="<?php __($menu_folhadeponto); ?>">
                  <a href="folhadeponto.php">
                    <span class="icon ponto"></span>
                    Folha de Ponto
                  </a>

                </li>

                <li class="<?php __($menu_folhadepagamento); ?>">
                  <a href="folhadepagamento.php">
                    <span class="icon folha"></span>
                    Folha de Pagamento
                  </a>
                </li>
                
                <li class="<?php __($menu_relatorios); ?>">
                  <a href="naoimplementado.php">
                    <span class="icon relatorios"></span>
                    Relatórios
                  </a>
                </li>

				        <li class="<?php __($menu_admins); ?>">
                  <a href="administradores.php">
                    <span class="icon administrador"></span>
                    Administradores
                  </a>
                </li>

				        <li class="<?php __($menu_ajuda); ?>">
                  <a href="ajuda.php">
                    <span class="icon ajuda"></span>
                    Ajuda
                  </a>
                </li>

                <li class="<?php __($menu_config); ?>">
                  <a href="configuracoes.php">
                    <span class="icon ajuda"></span>
                    Configurações
                  </a>
                </li>

                <li>
                  <a href="sair.php">
                    <span class="icon sair"></span>

                    Sair
                  </a>
                </li>               
              </ul>
            
             
            </nav>