<?php session_start();
require_once '../back-end/funciones.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyCGIDi9rfr_YQw-4Mrj5yBIVrfmr__Fb10"></script>
        <script src="../back-end/libs/map.js"></script>
        <title>Producto</title>
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <link href='estilo.css' rel="stylesheet"/>
        <link rel="icon" href="../img/logo.png"/>
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
                <div id="titulo">
                    <a href="index.php">
                        <h1>GrUPOn</h1>
                    </a>

                </div>
            </header>
            <nav>
<?php echo formularioBusquedaProducto();
echo navigation(); ?>
            </nav>
            <aside>
                <h2 id="categoria_actual">
                    <div id="cookie">  
                    </div>
                </h2>
<?php echo menuCategorias(); ?>
            </aside>
            <article>
                <main>
                    <?php
                    require_once '../back-end/formulario_borrar_producto.php';
                    require_once '../back-end/lectura_producto.php';
                    /**
                     * COMO OBTENEMOS ID PRODUCTO ACTUAL?
                     */
                    //$_SESSION['id_producto_borrar'] = $id;
                    echo muestraProducto($_COOKIE["productoVisitado"]);
                    if($_SESSION['tipo'] == 'empresa'){
                        if(esVendedor($_COOKIE['productoVisitado'], $_SESSION['cuenta'])){
                            echo muestraFormularioBorrar($_COOKIE["productoVisitado"]);
                        }
                    }
                    echo mostrarBotonAnadir($_COOKIE["productoVisitado"]);
                    ?></article>
        </main>
</body>
</html>
