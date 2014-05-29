<!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">Sistema de Padrón de Cuentas Oficiales</a>
        </div>
        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cuentas Oficiales <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="apertura_cta.php">Apertura de Cuentas</a></li>
                <li><a href="alta_cuentas.php">Alta de Cuentas</a></li>
                <li><a href="alta_sectores.php">Alta de Sectores</a></li>                
                <li><a href="edit_cuentas.php">Modificacion de Cuentas</a></li>
                <li><a href="bajas_cuentas.php">Baja de Cuentas</a></li>
                <li><a href="baja_sectores.php">Baja de Sectores</a></li>
              </ul>
            </li>

             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Firmantes <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="alta_firmantes.php">Agregar Firmantes</a></li>
                <li><a href="buscar_firmantes.php">Buscar Firmantes</a></li>
              </ul>
            </li>

             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Informes <b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
                  <li role="presentation" class="dropdown-header">GENERAL</li>
                            <li><a href="#">General</a></li>
                            <li><a href="#">Activos de Cuentas</a></li>
                            <li><a href="#">Historicos de Cuentas</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation" class="dropdown-header">CUENTAS</li>
                            <li><a href="informes/cuentas/cantidad_saf.php">Cantidad por SAF</a></li>
                            <li><a href="informes/cuentas/cantidad_banco.php">Cantidad por Banco</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation" class="dropdown-header">BANCOS</li>
                            <li><a href="informes/bancos/cuentas_simple.php">Por Cuentas: Simple</a></li> 
                            <li><a href="#">Por Cuentas: Detallado</a></li>
                            <li><a href="#">Por Bancos y SAF</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation" class="dropdown-header">SAF</li>
                            <li><a href="#">Por SAF</a></li>
                            <li><a href="#">General por Cuentas</a></li>
                            <li><a href="#">Autorizados por SAF</a></li>
                </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración <b class="caret"></b></a>
              <ul class="dropdown-menu">
                    <li> <a href="alta_usuarios.php">Alta de Usuarios</a></li>
                    <li> <a href="#">Listado de Usuarios</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
		  		<li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $_SESSION["session_user"]; ?>&nbsp;<b class="caret"></b></a>
	              <ul class="dropdown-menu">
	                <li><a href="salir.php">Cerrar Seción</a></li>
	              </ul>
            	</li>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>