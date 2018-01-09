<?php
session_start();
require_once '../back-end/funciones.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cuenta</title>
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <link href='estilo.css' rel="stylesheet"/>
        <link rel="icon" href="img/logo.png"/>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="../back-end/funciones.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <script>
            $(document).ready(function () {
                $("#cookie").append(document.createTextNode(categorias[getCookie("categoria")]));
            });
        </script> 
    </head>
    <body>
        <header>
            <header>
                <div id="logo">
                    <a href="index.php"><img alt="GrUPOn" src="..\img\logo.png" height="100"/></a>
                </div>
            </header>
            <nav>
                <?php echo formularioBusquedaProducto();
                echo navigation();
                ?>
            </nav>
            <main>
                <aside>
                <h2 id="categoria_actual">
                    <div id="cookie">  
                    </div>
                </h2>
<?php echo menuCategorias(); ?>
            </aside>
                <article>
            <h2>Hola <?php echo $_SESSION['nombre'] ?>, aqu&iacute; est&aacute; la informaci&oacute;n de su cuenta</h2>
            <!--Esto debería ser el submenú de datos, que muestra las opciones del empresario o cliente dependiendo de la cuenta-->
            <?php
            require_once '../back-end/formulario_borrar_cuenta.php';
            require_once '../back-end/lectura_cuenta.php';

            if ($_SESSION['tipo'] === 'empresa') {
                echo '<button type="submit" onclick="location.href = \'creacion_catalogo.php\'">Crear Cat&aacute;logo</button> 
        <button type="submit" onclick="location.href = \'creacion_producto.php\'">Crear Producto</button> 
        <button type="submit" onclick="location.href = \'../front-end/busqueda_modificar_catalogo.php\'">Modificar Cat&aacute;logo</button> 
        <button type="submit" onclick="location.href = \'listado_productos.php\'">Modificar Producto</button>
        <button type="submit" onclick="location.href = \'modificar_cuenta_empresa.php\'"> Modificar Cuenta</button>
               <button type="submit" onclick="location.href = \'historial_ventas.php\'"> Mostrar Historial Ventas</button>';
            } else {
                echo '<button type="submit" onclick="location.href = \'modificar_cuenta_cliente.php\'"> Modificar Cuenta</button>
                <button type="submit" onclick="location.href = \'historial_cliente.php\'"> Mostrar Historial Compras</button>';
            }
            echo muestraCuenta();
            echo muestraFormularioBorrar();
            ?></article>
            </main>
    </body>
</html>
