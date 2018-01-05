
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

        <script type="text/javascript">
            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toGMTString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                
                return "";
            }
          



        </script>
    </head>
    <body>
        <h2>B&uacute;squeda de producto</h2>
        <div id="cookie">La Categoria es:</div>

        <script>
            $("#cookie").append(document.createTextNode(getCookie("categoria")));
        </script>    
        <?php
        require_once '../back-end/funciones.php';
        echo menuCategorias()
        ?>
<?php require_once '../back-end/formulario_busqueda_producto.php'; ?>

    </body>
</html>
