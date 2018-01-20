<?php
session_start();
require_once '../back-end/funciones.php';
if (!isset($_SESSION['cuenta'])) {
    header('Location: index.php');
}
if (!isset($_GET['categoria'])) {
    $_GET['categoria'] = 'general';
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cuenta</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="estilow3.css">
        <link rel="icon" href="../img/icono.png"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <script src="../back-end/funciones.js"></script>
        <script src="../back-end/libs/jquery.zoom.min.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyCGIDi9rfr_YQw-4Mrj5yBIVrfmr__Fb10"></script>
        <script src="../back-end/libs/map.js"></script>
    </head>
    <body>
        <header class="w3-container w3-flat-midnight-blue">
            <div id="logo">
                <a href="index.php?categoria=general"><img alt="GrUPOn" src="..\img\logo.png" height="90"/></a>
            </div>
        </header>
        <nav class="w3-container w3-card w3-flat-wet-asphalt">
            <div class="w3-container w3-third">
            </div>
            <div class="w3-container w3-center w3-third w3-cell w3-cell-middle">
                <?php echo formularioBusquedaProducto(); ?>
            </div>
            <div class="w3-container w3-third w3-row w3-center">
                <?php echo navigation(); ?>
            </div>
        </nav>
        <main class="w3-container w3-flat-clouds">
            <aside class="w3-container w3-quarter w3-flat-belize-hole w3-card">
                <h2 class="w3-container w3-card w3-flat-wet-asphalt w3-block w3-center">
                    <?php
                    if (isset($_SESSION['tipo']) && ($_SESSION['tipo'] == 'cliente')) {
                        echo $arrayCategoriasNoLogged[$_GET['categoria']];
                    } else {
                        echo $arrayCategoriasLogged[$_GET['categoria']];
                    }
                    ?>
                </h2>
                <?php echo menuCategorias(); ?>
            </aside>
            <article class="w3-container w3-threequarter">
                <h2>Hola <?php echo $_SESSION['nombre'] ?>, aqu&iacute; est&aacute; la informaci&oacute;n de su cuenta</h2>
                <!--Esto debería ser el submenú de datos, que muestra las opciones del empresario o cliente dependiendo de la cuenta-->
                <?php
                require_once '../back-end/formulario_borrar_cuenta.php';
                require_once '../back-end/lectura_cuenta.php';

                if ($_SESSION['tipo'] === 'empresa') {
                    echo '<button class="w3-btn w3-hover-pale-blue w3-border w3-round" type="submit" onclick="location.href = \'creacion_catalogo.php\'">Crear Cat&aacute;logo</button> 
                    <button class="w3-btn w3-hover-pale-blue w3-border w3-round" type="submit" onclick="location.href = \'creacion_producto.php\'">Crear Producto</button> 
                    <button class="w3-btn w3-hover-pale-blue w3-border w3-round" type="submit" onclick="location.href = \'../front-end/busqueda_modificar_catalogo.php\'">Modificar Cat&aacute;logo</button> 
                    <button class="w3-btn w3-hover-pale-blue w3-border w3-round" type="submit" onclick="location.href = \'listado_productos.php\'">Modificar Producto</button>
                    <button class="w3-btn w3-hover-pale-blue w3-border w3-round" type="submit" onclick="location.href = \'modificar_cuenta_empresa.php\'"> Modificar Cuenta</button>
                    <button class="w3-btn w3-hover-pale-blue w3-border w3-round" type="submit" onclick="location.href = \'historial_ventas.php\'"> Mostrar Historial Ventas</button>';
                } else {
                    echo '<button class="w3-btn w3-hover-pale-blue w3-border w3-round" type="submit" onclick="location.href = \'modificar_cuenta_cliente.php\'"> Modificar Cuenta</button>
                <button class="w3-btn w3-hover-pale-blue w3-border w3-round" type="submit" onclick="location.href = \'historial_cliente.php\'"> Mostrar Historial Compras</button>';
                }
                
                echo '<div class="w3-container w3-white w3-border w3-round w3-section">';
                echo '<div class="w3-margin" style="width:100%; clear:both;"></div>';
                echo muestraCuenta();
                echo '<div style="width:100%; clear:both;"></div>';
                echo muestraFormularioBorrar();
                echo '</div>';
                ?></article>
        </main>
        <footer class="w3-container w3-flat-midnight-blue">
            Grupo &num;2 - GrUPOn&copy;, el fruto dado por el odio hacia nosotros mismos
        </footer>
    </body>
</html>
