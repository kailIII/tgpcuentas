<!-- Fixed navbar -->
    <div class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../home.php">Sistema de Padrón de Cuentas Oficiales</a>
        </div>
        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
          <!-- <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cuentas Oficiales <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="apertura_cta.php"><span class="glyphicon glyphicon-folder-open"></span> Apertura de Cuentas</a></li>
                <li><a href="alta_cuentas.php"><span class="glyphicon glyphicon-floppy-saved"></span> Alta de Cuentas</a></li>
                <li><a href="alta_sectores.php"><span class="glyphicon glyphicon-floppy-saved"></span> Alta de Sectores</a></li>      
                <li><a href="edit_cuentas.php"><span class="glyphicon glyphicon-list"></span> Modificacion de Cuentas</a></li>
                <li><a href="bajas_cuentas.php"><span class="glyphicon glyphicon-trash"></span> Baja de Cuentas</a></li>
                <li><a href="baja_sectores.php"><span class="glyphicon glyphicon-trash"></span> Baja de Sectores</a></li>
              </ul>
            </li>

             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Firmantes <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="alta_firmantes.php"><span class="glyphicon glyphicon-user"></span> Agregar Firmantes</a></li>
                <li><a href="buscar_firmantes.php"><span class="glyphicon glyphicon-search"></span> Buscar Firmantes</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración <b class="caret"></b></a>
              <ul class="dropdown-menu">
                    <li> <a href="alta_usuarios.php"><span class="glyphicon glyphicon-user"></span> Alta de Usuarios</a></li>
                    <li> <a href="#"><span class="glyphicon glyphicon-list"></span> Listado de Usuarios</a></li>
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

            <li><a href="informes/informes.php">Informes</a></li>

          </ul> -->
          <!-- <ul class="nav navbar-nav navbar-right">
  		  		<li class="dropdown">
  	              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $_SESSION["session_user"]; ?>&nbsp;<b class="caret"></b></a>
  	              <ul class="dropdown-menu">
  	                <li><a href="salir.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
  	              </ul>
            </li>
		      </ul> -->
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["session_user"]; ?><b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <span class="glyphicon glyphicon-user icon-size"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong><?php echo $_SESSION["session_name"]; ?></strong></p>
                                        <p class="text-left small"><?php echo $_SESSION["session_perfil"]; ?></p>
                                        <button type="button" class="btn btn-primary btn-sm btn-lg" onclick="location='home.php'">Actualizar Datos</button>
                                    </div>
                                </div>
                            </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                  <div class="navbar-login navbar-login-session">
                                      <div class="row">
                                          <div class="col-lg-12">
                                              <p class="text-center">
                                                  <a href="../salir.php" class="btn btn-danger">Cerrar Sesion</a>
                                              </p>
                                          </div>
                                      </div>
                                  </div>
                            </li>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>