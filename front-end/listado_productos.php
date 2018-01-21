<?php
session_start();
require_once '../back-end/funciones.php';
inicializarDB();
if (!isset($_GET['categoria'])) {
    $_GET['categoria'] = 'general';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>GrUPOn</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="UTF-8"/>
        <style>
            .tab-content {
                display: none;
               
            }

            .tab-content.current {
                display: inherit;
            }
        </style>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="estilow3.css">
        <link rel="icon" href="../img/icono.png"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <script src="../back-end/funciones.js"></script>
        <script src="../back-end/libs/jquery.zoom.min.js"></script>
        <script src="../back-end/libs/pagina.js"></script>
        <script>
            $(document).ready(function () {
                var $paginas = $('div.pagina').hide();

                $paginas.eq(0).show();

                $('ul.tabs li').click(function () {
                    var $tab_id = $(this).attr('data-tab');
                   
                    $('ul.tabs li').removeClass('current');
                    $('.tab-content').removeClass('current');

                    $(this).addClass("current");
                    $("#" + $tab_id).addClass("current");
                });




                // $('button.paginacion').pagina();
                //$('.zoom').zoom();

            });
        </script>
    </head>
    <body class="w3-display-container">
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
                        echo $arrayCategoriasLogged[$_GET['categoria']];
                    } else {
                        echo $arrayCategoriasLogged[$_GET['categoria']];
                    }
                    ?>
                </h2>
                <div class="w3-container">
                    <?php echo menuCategorias(); ?>
                </div>
            </aside>
            <article class="w3-container w3-threequarter">
              <?php echo mostrarProductosVendedor($_SESSION['cuenta']); ?>
            </article>

        </main>
        <footer class="w3-container w3-bottom w3-flat-midnight-blue">
            Grupo &num;2 - GrUPOn&copy;, el fruto dado por el odio hacia nosotros mismos
        </footer>
    </body>
</html>