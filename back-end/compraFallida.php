<?php

require_once '../back-end/lectura_producto.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function pagoFallido() {

    $cookiecarrito = explode(",", $_COOKIE["carrito"]);
    echo "<br/> Vas a comprar:<br/>";
    print_r($cookiecarrito);
    echo "<br/>";
    foreach ($cookiecarrito as $producto) {
        $sql = "SELECT * FROM PRODUCTO WHERE id_producto='$producto'";
        $result = realizarQuery($esquema, $sql);
        $datos_producto = mysqli_fetch_array($result);
        $cantidad_vendida = $datos_producto["cantidad_vendida"] + 1;
        $cantidad_disponible = $datos_producto["cantidad_disponible"] - 1;
        $sql = "UPDATE PRODUCTO SET cantidad_vendida='$cantidad_vendida', cantidad_disponible='$cantidad_disponible' ";
        realizarQuery($esquema, $sql);
        $sql = "SELECT * FROM LANZAMIENTOS WHERE id_producto='$producto'";
        $result = realizarQuery($esquema, $sql);
        $datos_lanzamiento = mysqli_fetch_array($result);
        $num_ventas = $datos_lanzamiento["num_ventas"] + 1;
        if ($cantidad_disponible == 0) {
            $sql = "UPDATE LANZAMIENTOs SET num_ventas='$num_ventas', fecha_fin=curdate()";
            realizarQuery($esquema, $sql);
        } else {
            $sql = "UPDATE LANZAMIENTOS SET num_ventas='$num_ventas'";
            realizarQuery($esquema, $sql);
        }
        echo "PAGO REALIZADO CON EXITO";
        echo '<button href="seleccion_accion.php" onclick="setCookie("carrito", "", 1)"> Pulse para terminar proceso</button>';
    }
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