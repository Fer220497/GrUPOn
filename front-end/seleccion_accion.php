<?php
session_start();
require_once '../back-end/funciones.php';
?>
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
        <h2>Acciones: TESTING PURPOSES ONLY.</h2>
        <div id="cookie">La Categoria es:</div>
        <script>

            $("#cookie").append(document.createTextNode(getCookie("categoria")));
        </script>    

        Seleccione que quiere hacer<br/>

        Crear:<br/>
        <button type="submit" onclick="location.href = 'creacion_catalogo.php'">Crear Cat&aacute;logo</button> 
        <button type="submit" onclick="location.href = 'creacion_producto.php'">Crear Producto</button> 
        <br/>Modificar:<br/>
        <button type="submit" onclick="location.href = 'modificar_catalogo.php'">Modificar Cat&aacute;logo</button> 
        <button type="submit" onclick="location.href = 'modificar_producto.php'">Modificar Producto</button>
        <br/>Cuentas:<br/>
        <button type="submit" onclick="location.href = 'cuenta.php'">Ir al Men&uacute; de cuenta</button>
        <button type="submit" onclick="location.href = 'modificar_cuenta_cliente.php'">Modificar Cuenta Cliente</button> 
        <button type="submit" onclick="location.href = 'modificar_cuenta_empresa.php'">Modificar Cuenta Empresa</button>
        <br/>Buscar:<br/>
        <button type="submit" onclick="location.href = 'buscar_producto.php'">Buscar Producto</button>
        <?php
            if(tipoCuenta($_SESSION["cuenta"]) || !isset($_SESSION["cuenta"])){
                echo '<button type="submit" onclick="location.href = \'mostrar_carrito.php\'">Mostrar Carrito </button>';
                //<button type="submit" onclick="location.href = 'mostrar_carrito.php'">Mostrar Carrito</button>
            }
        ?>
        
    </body>
</html>
