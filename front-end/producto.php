<?php
session_start();
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
        <?php
        if (isset($SESSION['tipo']) && $SESSION['tipo'] == 'cliente') {
            ?>
            <link href='estilo_login.css' rel="stylesheet"/>
            <?php
        }
        ?>
        <link rel="icon" href="../imagenesSubidas/logo.png"/>
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
                    <a href="index.php?categoria=general"><img alt="GrUPOn" src="..\img\logo.png" height="100"/></a>
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

                    <?php
                    require_once '../back-end/formulario_borrar_producto.php';
                    require_once '../back-end/lectura_producto.php';
                    /**
                     * COMO OBTENEMOS ID PRODUCTO ACTUAL?
                     */
                    //$_SESSION['id_producto_borrar'] = $id;
                    echo muestraProducto($_GET['id']);
                    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'empresa' && esVendedor($_GET['id'], $_SESSION['cuenta'])) {
                        echo muestraFormularioBorrar($_GET['id']);
                    }
                    echo mostrarBotonAnadir($_GET['id']);

                    if (isset($_SESSION['cuenta']) && $_SESSION['tipo'] == 'cliente' &&
                            puedeComentar($_SESSION['cuenta'], $_GET['id'])) {
                        require_once '../back-end/formulario_comentario.php';
                        echo mostrarCajaComentario();
                    }
                    echo mostrarComentarios($_GET['id']);
                    ?></article>
            </main>
    </body>
</html>
