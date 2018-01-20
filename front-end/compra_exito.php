<?php
session_start();
require_once '../back-end/funciones.php';
//inicializarDB();
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
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="estilow3.css">
        <link rel="icon" href="../img/icono.png"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <script src="../back-end/funciones.js"></script>
        <script src="../back-end/libs/jquery.zoom.min.js"></script>
        <script src="../back-end/libs/pagina.js"></script>
    </head>
    <body>
        <header class="w3-container w3-flat-midnight-blue">
            <div id="logo">
                <a href="index.php?categoria=general" onclick="setCookie('carrito','', 1)"><img alt="GrUPOn" src="..\img\logo.png" height="90"/></a>
            </div>
        </header>
        <main class="w3-container w3-flat-clouds">
            <article class="w3-container">
                <?php  
                
                require_once '../back-end/proceso_compra_terminar.php';
                require_once '../back-end/lectura_carrito.php';
                echo pagoConExito(); 
                ?>
            </article>

        </main>
        <footer class="w3-container w3-flat-midnight-blue">
            Grupo &num;2 - GrUPOn&copy;, el fruto dado por el odio hacia nosotros mismos
        </footer>
    </body>
</html>