<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function mostrarCarrito() {
    
    global $esquema;
    $productos = explode(",", $_COOKIE["carrito"]);
    $contador=0;
  
    foreach ($productos as $key => $producto) {
        
        echo muestraProductoCarrito($producto);
          //print_r($productos);
        echo '<button class="w3-button w3-border" href="../front-end/mostrar_carrito.php" onclick="removeCarrito('.$key.')">Eliminar del carrito</button>';
        $contador++;
    }
    
        $precio=0;
        $productos = explode(",", $_COOKIE["carrito"]);
        foreach ($productos as $id_producto) {
            $query = "SELECT * FROM producto WHERE id_producto='$id_producto'";
            $result = realizarQuery($esquema, $query);
            $fila = mysqli_fetch_array($result);
            $precio += $fila['precio'] - ($fila['precio'] * ($fila['porcentaje_descuento'] / 100));
        }
        echo '<br/><div class="w3-panel w3-xxlarge w3-pale-blue w3-leftbar w3-border-blue">El coste total de la compra es de: ' . $precio . '&euro;</div><br/>';
}



function opcionesCompra() {
    if (!isset($_SESSION["cuenta"])) {
        header('Location: login.php');
    } else {
        global $esquema;
        
        $precio = 0;
        $string_productos="";
        $productos = explode(",", $_COOKIE["carrito"]);
        foreach ($productos as $id_producto) {
            $query = "SELECT * FROM producto WHERE id_producto='$id_producto'";
            $result = realizarQuery($esquema, $query);
            $fila = mysqli_fetch_array($result);
            $precio += $fila['precio'] - ($fila['precio'] * ($fila['porcentaje_descuento'] / 100));
           // $string_productos.=$fila["nombre"].'<br/>';
        }
        


        $form = '<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">' .
                '<input type="hidden" name="cmd" value="_xclick">' .
                '<input type="hidden" name="business" value="fernandezfernando97-facilitator@gmail.com">' .
                '<input type="hidden" name="item_name" value="Compra en GrUPOn">' .
                '<input type="hidden" name="currency_code" value="EUR">' .
                '<input type="hidden" name="amount" value="' . $precio . '">' .
                //PARA HOST PROPIO
                '<input type="hidden" name="return" value="http:/localhost//GrUPOn_Netbeans/front-end/compra_exito.php">' .
                '<input type="hidden" name="cancel_return" value="http:/localhost/GrUPOn_Netbeans/front-end/compra_fallida.php">' .
                //PARA HOST EN LA PAGINA
              //  '<input type="hidden" name="return" value="https://grupon.000webhostapp.com/front-end/compra_exito.php">' .
                //'<input type="hidden" name="cancel_return" value="https://grupon.000webhostapp.com/front-end/compra_fallida.php">' .
                //
                '<div class="w3-center">' .
                '<input type="image" src="https://www.maxcolchon.com/images/cms/paypal.png" height="100"' .
                'name="submit"' .
                'alt="Make payments with PayPal - its fast, free and secure!"></div>';

        //$form="hola";
        return $form;
    }
}
