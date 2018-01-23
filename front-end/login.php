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
        <title>Login/Registro</title>
        <link rel="icon" href="img/icono.png"/>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="../back-end/funciones.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="estilow3.css">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
        <script>
            window.addEventListener("load", function () {
                window.cookieconsent.initialise({
                    "palette": {
                        "popup": {
                            "background": "#252e39"
                        },
                        "button": {
                            "background": "#14a7d0"
                        }
                    },
                    "theme": "classic",
                    "content": {
                        "message": "Todo el mundo sabe que las webs usan cookies, pero la UE nos obliga a poner esta obviedad.",
                        "dismiss": "Okey!",
                        "link": "Aprende más sobre las cookies"
                    }
                })
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
            <?php
            require_once '../back-end/formulario_login.php';
            echo '<div class="w3-container w3-third"></div><div class="w3-container w3-white w3-border w3-round w3-section w3-third w3-margin-top w3-margin-bottom">' . formularioLogin() . '</div>';
            ?>
            <footer class="w3-container w3-bottom w3-flat-midnight-blue">
                Grupo &num;2 - GrUPOn&copy;, el fruto dado por el odio hacia nosotros mismos
            </footer>
        </main>
    </body>
</html>
