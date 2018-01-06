<?php

require_once '../back-end/lectura_producto.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function pagoFallido() {


    echo "PAGO REALIZADO SIN EXITO";
    echo '<a href="../front-end/seleccion_accion.php"> Pulse para terminar proceso</a>';
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