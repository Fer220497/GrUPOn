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
        <style>

            li{
                display: inline-block;
            }
        </style>
    </head>
    <body>
<?php
function navigation() {
    $nav = '<div id="icon_tray"><ul>';
    if (isset($_SESSION["cuenta"])) {
        if ($_SESSION["tipo"] == "cliente") {// LOGEADO COMO CLIENTE
            $nav .= '<li><a id="carrito" href="mostrar_carrito.php">Carrito</a></li>';
                    '<li><a id="perfil" href="">Perfil</a></li>' .
                    '<li><a id="logout" href="">Desconectar</a></li>' ;
                    
        } else {// LOGEADO COMO EMPRESA
            $nav .= '<li><a id="crear_produto" href="creacion_producto.php">Crear Producto</a></li>' .
                    '<li><a id="crear_catalogo" href="creacion_catalogo.php">Crear Catalogo</a></li>' .
                    '<li><a id="perfil" href="">Perfil</a></li>' .
                    '<li><a id="logout" href="">Desconectar</a></li>' ;
        }
    } else {//NO LOGEADO
        $nav .= '<li><a id="boton_login" href="login.php">Login|Registro</a></li>' .
                '<li><a id="carrito" href="mostrar_carrito.php">Carrito</a></li>';
    }
    $nav .= " </ul></div>";
    return $nav;
}

echo navigation();
?>
    </div>
</body>
</html>
