	
<header>
    </style>
    <section class="header">
        <a href="cerrarS.php"><i class="icon-switch"></i>Cerrar Sesión</a>
    </section>
    <input id="navbar" class="navbar" type='checkbox' style="display: none;">
    <label for="navbar">
        <div class='btn-menuweb'>
            <span class='hamburger'></span>
        </div>
    </label>
    <nav class="contenedor-menu" id="contenedor-menu">
        <a href="vista-admin.php" class="btn-menu">Menu <i class="icono icon-menu"></i></a>
        <ul class="menu">
            <li class="img-contenedor"><img src="../../Menu/img/user-img.jpg" alt="error logo" class="logo-menu"><span>Bienvenido <?php session_start();echo $_SESSION['nombreusu']; ?></span></li>
            <li><a href="../../Persons/User/admin.php"><i class="icono izquierda icon-home"></i>Inicio</a></li>

            <li><a href="#"><i class="icono izquierda icon-users"></i>Persona <i class="icono derecha icon-circle-down"></i></a>
                <ul>
                    <li><a href="../../Persons/Person/add_person.php">Registrar Persona</a></li>
                    <li><a href="../../Persons/Person/list_person.php">Consultar Persona</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icono izquierda icon-profile"></i>Pedido <i class="icono derecha icon-circle-down"></i></a>
                <ul>
                    <li><a href="add_pedido.php">Registrar pedido</a></li>
                    <li><a href="listar_pedido.php">Consultar pedido</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icono izquierda icon-spinner9"></i>Entrada <i class="icono derecha icon-circle-down"></i></a>
                <ul>
                    <li><a href="../../Existence Control/Entry/add-entry.php">Registrar Entrada</a></li>
                    <li><a href="../../Existence Control/Entry/list-entry.php">Consulta Entrada</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icono izquierda icon-spinner9"></i>Producto <i class="icono derecha icon-circle-down"></i></a>
                <ul>
                    <li><a href="../../Existence Control/Product/add_product.php">Registrar Producto</a></li>
                    <li><a href="../../Existence Control/Product/list_product.php">Consulta Producto</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icono izquierda icon-spinner9"></i>Categoria <i class="icono derecha icon-circle-down"></i></a>
                <ul>
                    <li><a href="../../Existence Control/Category/add_category.php">Registrar Categoria</a></li>
                    <li><a href="../../Existence Control/Category/list_category.php">Consulta Categoria</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icono izquierda icon-spinner9"></i>Salida <i class="icono derecha icon-circle-down"></i></a>
                <ul>
                    <li><a href="../../Existence Control/Exit/add-exit.php">Registrar Salida</a></li>
                    <li><a href="../../Existence Control/Exit/list-exit.php">Consulta Salida</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
