<header>
    <section class="header" style="top:0; color:white;">
        <?php
        require_once "header.php";
        //    echo date("d/m/Y  g:i a ");
        //echo date("d/m/Y H:i ");
        ?>
        <!-- <a href="cerrarS.php"><i class="icon-switch"></i>Cerrar Sesión</a> -->
    </section>
    <input id="navbar" class="navbar" type='checkbox' style="display: none;">

    <label for="navbar">
        <div class='btn-menuweb'>
            <span class='hamburger'></span>
        </div>
    </label>
    <nav class="contenedor-menu" id="contenedor-menu" style="z-index: 1000;">
        <a href="#" class="btn-menu">Menu <i class="icono icon-menu"></i></a>
        <ul class="menu" style="z-index: 1000;">
            <!-- <li class="img-contenedor"><img src="<?php//echo SERVERURL; ?>public/img/user-img.jpg" alt="error logo" class="logo-menu"><span>Bienvenido <span></li> -->


            <center>
                <img class="img-circle img-size-2" src="<?php echo SERVERURL . $_SESSION['url_sir']; ?>" alt="errro">
                <h3><?php echo $_SESSION['usuario_sir']; ?> </h3>
                <a href="<?php echo SERVERURL; ?>editAccount" title="Editar Cuenta">
                    <i class="glyphicon glyphicon-cog"></i>
                </a> |
                <a href="<?php echo mainModel::encryption($_SESSION['token_sir']); ?>" title="Cerrar Sesión">
                    <i class="glyphicon glyphicon-off"></i>
                </a>
            </center>


            <li><a href="<?php echo SERVERURL; ?>homeAdmin"><i class="icono izquierda icon-home"></i>Inicio</a></li>

            <li><a href="#"><i class="icono izquierda icon-users"></i>Persona <i class="icono derecha icon-circle-down"></i></a>
                <ul>
                    <li><a href="<?php echo SERVERURL; ?>addPerson">Registrar Persona</a></li>
                    <li><a href="<?php echo SERVERURL; ?>listPerson">Consultar Persona</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icono izquierda icon-spinner9"></i>Producto <i class="icono derecha icon-circle-down"></i></a>
                <ul>
                    <li><a href="<?php echo SERVERURL; ?>addProduct">Registrar Producto</a></li>
                    <li><a href="<?php echo SERVERURL; ?>listProduct">Consulta Producto</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icono izquierda icon-spinner9"></i>Entrada <i class="icono derecha icon-circle-down"></i></a>
                <ul>
                    <li><a href="<?php echo SERVERURL; ?>addEntry">Registrar Entrada</a></li>
                    <li><a href="<?php echo SERVERURL; ?>listEntry">Consulta Entrada</a></li>
                </ul>
            </li>

            <li><a href="#"><i class="icono izquierda icon-spinner9"></i>Salida <i class="icono derecha icon-circle-down"></i></a>
                <ul>
                    <li><a href="<?php echo SERVERURL; ?>addExit">Registrar Salida</a></li>
                    <li><a href="<?php echo SERVERURL; ?>listExit">Consulta Salida</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icono izquierda icon-profile"></i>Pedido <i class="icono derecha icon-circle-down"></i></a>
                <ul>
                    <li><a href="<?php echo SERVERURL; ?>addPedido">Registrar pedido</a></li>
                    <li><a href="<?php echo SERVERURL; ?>listPedido">Consultar pedido</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icono izquierda icon-spinner9"></i>Gestionar Tipos<i class="icono derecha icon-circle-down"></i></a>
                <ul>
                    <li><a href="<?php echo SERVERURL; ?>Categoria">Tipo Categoria</a></li>
                    <li><a href="<?php echo SERVERURL; ?>tipoSalida">Tipo Salida</a></li>
                    <!--  <li><a href="<?php echo SERVERURL; ?>addCategory">Registrar Categoria</a></li>
                    <li><a href="<?php echo SERVERURL; ?>listCategory">Consultar Categoria</a></li> -->
                    <!-- <li><a href="<?php echo SERVERURL; ?>tipoDocumento/">Gestión Tipo Documento</a></li> -->
                </ul>
            </li>
            <li><a href="<?php echo SERVERURL; ?>listComment"><i class="icono izquierda icon-circle-down"></i>Mensajes</a></li>
        </ul>
    </nav>
</header>