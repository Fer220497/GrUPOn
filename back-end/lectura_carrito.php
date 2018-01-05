<?php

require_once '../back-end/lectura_producto.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function mostrarCarrito() {
    echo $_COOKIE["carrito"];

    $productos = explode(",", $_COOKIE["carrito"]);
    $contador=0;
    foreach ($productos as $key => $producto) {
        
        echo muestraProducto($producto);
        echo '<button href="mostrar_carrito.php" onclick="removeCarrito(\''.$producto.'\',\''.$contador.'\')">Eliminar del carrito</button>';
        $contador++;
    }
}
