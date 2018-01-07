<?php

require_once '../back-end/lectura_producto.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function pagoConExito() {
    global $esquema;
    $cookiecarrito = explode(",", $_COOKIE["carrito"]);
    echo "<br/> Vas a comprar:<br/>";
    print_r($cookiecarrito);
    echo "<br/>";
    foreach ($cookiecarrito as $producto) {
        $sql = "SELECT * FROM PRODUCTO WHERE id_producto='$producto'";
        $result = realizarQuery($esquema, $sql);
        $datos_producto = mysqli_fetch_array($result);
        $cantidad_vendida = $datos_producto["cantidad_vendida"] + 1;
        echo "Productos vendidos actualizados:".$cantidad_vendida." |Para producto:".$producto."<br/>";
        $cantidad_disponible = $datos_producto["cantidad_disponible"] - 1;
        echo "Productos disponibles actualizados: ".$cantidad_disponible." |Para producto:".$producto."<br/>";
        $sql = "UPDATE PRODUCTO SET cantidad_vendida='$cantidad_vendida', cantidad_disponible='$cantidad_disponible' WHERE id_producto=$producto";
        realizarQuery($esquema, $sql);
        $sql = "SELECT * FROM LANZAMIENTOS WHERE id_producto='$producto'";
        $result = realizarQuery($esquema, $sql);
        $datos_lanzamiento = mysqli_fetch_array($result);
        $num_ventas = $datos_lanzamiento["num_ventas"] + 1;
        if ($cantidad_disponible == 0) {
            $sql = "UPDATE LANZAMIENTOS SET num_ventas='$num_ventas', fecha_fin=curdate() WHERE id_producto=$producto";
            realizarQuery($esquema, $sql);
        } else {
            $sql = "UPDATE LANZAMIENTOS SET num_ventas='$num_ventas' WHERE id_producto=$producto";
            realizarQuery($esquema, $sql);
        }
    }
    echo "PAGO REALIZADO CON EXITO";
    echo '<a href="../front-end/seleccion_accion.php" onclick="setCookie(\'carrito\', \'\', 1)"> Pulse para terminar proceso</a>';
}

/*
function mostrarBotonPagar(){
    $form = '<form action="" method="post" >' .
            '<input type="submit" name="pagar" value="Comprar">';
    return $form;
            
}
function mostrarBotonCompra(){
    echo '<button type="submit" onclick="location.href = \'pantalla_compra.php\'">Comprar</button>';
    
}
//<button type="submit" onclick="location.href = 'creacion_catalogo.php'">Crear Cat&aacute;logo</button> 


*/