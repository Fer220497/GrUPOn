<?php session_start();
require_once '../back-end/funciones.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cuenta</title>
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <link href='estilo.css' rel="stylesheet"/>
        <link rel="icon" href="../img/logo.png"/>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="../back-end/funciones.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    </head>
    <body>
        <header>
            <header>
                <div id="logo">
                    <a href="index.php"><img alt="GrUPOn" src="..\img\logo.png" height="100"/></a>
                </div>
                <div id="titulo">
                    <a href="index.php">
                        <h1>GrUPOn</h1>
                    </a>

                </div>
            </header>
            <nav>
<?php echo navigation(); ?>
            </nav>
            <h2>Hola <?php echo $_SESSION['nombre'] ?>, aqu&iacute; est&aacute; la informaci&oacute;n de su cuenta</h2>
            <!--Esto debería ser el submenú de datos, que muestra las opciones del empresario o cliente dependiendo de la cuenta-->
            <?php
            require_once '../back-end/formulario_borrar_cuenta.php';
            require_once '../back-end/lectura_cuenta.php';

            if ($_SESSION['tipo'] === 'empresa') {
                echo '<button type="submit" onclick="location.href = \'creacion_catalogo.php\'">Crear Cat&aacute;logo</button> 
        <button type="submit" onclick="location.href = \'creacion_producto.php\'">Crear Producto</button> 
        <button type="submit" onclick="location.href = \'modificar_catalogo.php\'">Modificar Cat&aacute;logo</button> 
        <button type="submit" onclick="location.href = \'modificar_producto.php\'">Modificar Producto</button>';
            } else {
                echo '<p>Aquí debería haber un historial de compra para el cliente, pero es que nos han pagado 1€ por hacer la aplicacion, asi que te con el placeholder</p><br/>'
                . '<img src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2017/05/03/15/ok-hand.jpg" width="400"/>';
            }
            echo muestraCuenta();
            echo muestraFormularioBorrar();
            ?>

    </body>
</html>
