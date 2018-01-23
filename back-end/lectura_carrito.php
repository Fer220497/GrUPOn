<?php

require_once '../back-end/lectura_producto.php';

/**
 * Función que permite finalizar la compra
 * @return string
 */
function pagoConExito() {
    global $esquema;
    $cookiecarrito = explode(",", $_COOKIE["carrito"]);
    foreach ($cookiecarrito as $producto) {
        $sql = "SELECT * FROM producto WHERE id_producto='$producto'";
        $result = realizarQuery($esquema, $sql);
        $datos_producto = mysqli_fetch_array($result);
        $cantidad_vendida = $datos_producto["cantidad_vendida"] + 1;
        $cantidad_disponible = $datos_producto["cantidad_disponible"] - 1;
        $sql = "UPDATE producto SET cantidad_vendida='$cantidad_vendida', cantidad_disponible='$cantidad_disponible' WHERE id_producto=$producto";
        realizarQuery($esquema, $sql);
        $sql = "SELECT * FROM lanzamientos WHERE id_producto='$producto'";
        $result = realizarQuery($esquema, $sql);
        $datos_lanzamiento = mysqli_fetch_array($result);
        $num_ventas = $datos_lanzamiento["num_ventas"] + 1;
        if ($cantidad_disponible == 0) {
            $sql = "UPDATE lanzamientos SET num_ventas='$num_ventas', fecha_fin=curdate() WHERE id_producto=$producto";
            realizarQuery($esquema, $sql);
        } else {
            $sql = "UPDATE lanzamientos SET num_ventas='$num_ventas' WHERE id_producto=$producto";
            realizarQuery($esquema, $sql);
        }
        
        
        $sql = 'INSERT INTO compra (correo, id_producto, fecha, cantidad) VALUES(\''.$_SESSION['cuenta'].'\',\''.$producto.'\',curdate(),\'1\')';
        realizarQuery($esquema, $sql);
    }
    $str = '<div class="w3-jumbo w3-center w3-panel w3-pale-green w3-border-green w3-border w3-leftbar w3-rightbar">&Eacute;xito</div>';
    $str .= '<a class="w3-block w3-flat-orange w3-btn w3-hover-pale-blue w3-border w3-round" '
            . 'href="../front-end/index.php" '
            . 'onclick="setCookie(\'carrito\', \'\', 1)"'
            . 'style="height:60vh;font-size:30vh;">👌</a>';
    return $str;
}