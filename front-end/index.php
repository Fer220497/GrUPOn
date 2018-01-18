<?php
session_start();
require_once '../back-end/funciones.php';
inicializarDB();
if(!isset($_GET['categoria'])){
    $_GET['categoria'] = 'general';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>GrUPOn</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
        <?php
        if (isset($SESSION['tipo']) && $SESSION['tipo'] == 'cliente') {
            ?>
            <link href='estilo_login.css' rel="stylesheet"/>
            <?php
        }
        ?>
        <link rel="icon" href="../img/logo.png"/>
        <script src="../back-end/funciones.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    </head>
    <body>
        <header class="w3-container w3-flat-midnight-blue">
            <div id="logo">
                <a href="index.php?categoria=general"><img alt="GrUPOn" src="..\img\logo.png" height="90"/></a>
            </div>
        </header>
        <nav class="w3-container w3-flat-wet-asphalt">
            <div class="w3-container w3-third"></div>
            <div class="w3-container w3-third">
            <?php echo formularioBusquedaProducto(); ?></div>
            <i class="fa fa-search"></i>
            <div class="w3-container w3-third">
            <?php echo navigation(); ?></div>
        </nav>
        <main>
            <aside id="sidenav">
                <h2 id="categoria_actual">Categor&iacute;a: 
                    <?php if(isset($_SESSION['tipo']) && ($_SESSION['tipo'] == 'cliente')){
                        echo $arrayCategoriasLogged[$_GET['categoria']];
                    }else{
                        echo $arrayCategorias[$_GET['categoria']];
                    }?>
                </h2>
<?php echo menuCategorias(); ?>
            </aside>

            <article>
<?php echo desplegarPaginaPrincipal($_GET['categoria']); ?>
            </article>
        </main>

        <footer>
            Grupo &num;2 - GrUPOn&copy;, el fruto dado por el odio hacia nosotros mismos
        </footer>
    </body>
</html>
