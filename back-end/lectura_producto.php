<?php

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

/**
 * Muestra los datos del producto cuyo id venía dado por parámetro.
 * @param string $id
 * @return string
 */
function muestraProducto($id) {
    global $esquema;
    global $arrayComunidades;
    global $arrayCategorias;
    global $esquema;
    $query = "SELECT * FROM producto WHERE id_producto='$id'";
    $result = realizarQuery($esquema, $query);
    $fila = mysqli_fetch_array($result);
    $precio = $fila['precio'] - ($fila['precio'] * ($fila['porcentaje_descuento'] / 100));
    $sql = "SELECT * FROM lanzamientos WHERE id_producto='$id'";
    $result = realizarQuery($esquema, $sql);
    $datosEmpresa = mysqli_fetch_array($result);
    $p_desc = (100 - $fila["porcentaje_descuento"]) * $fila["precio"] / 100;

    $table = '<input type="hidden" id="localizacion" value="' . $fila['localizacion'] . '"/>' .
            '<div class="w3-container w3-white w3-border w3-round w3-section" style="padding:3%"><div class="contenedorProducto"></div><div class="w3-container w3-third"><div class="zoom"><img class="w3-image w3-card" src="' . '../imagenesSubidas/' . $fila['ruta_imagen'] . '"alt="' . $fila["nombre"] . '"/></div></div>' .
            '<div class="w3-container w3-twothird"><div class="w3-container w3-half"><h2>' . $fila['nombre'] . '</h2></div><div class="w3-container w3-half"><div class="w3-container w3-third"><span style="text-decoration: line-through">' . $fila["precio"] . '&euro;</span></div><div class="w3-container w3-third"><span class="w3-tag w3-padding w3-red" style="transform:rotate(-5deg)">-' . $fila['porcentaje_descuento'] . '%</span></div><div class="w3-container w3-third"><span style="font-weight: bold"> ' . $p_desc . '&euro;</span></div></div>' .
            '<div class="w3-container">' . $fila['descripcion'] . '<br/>Unidades restantes: ' . $fila['cantidad_disponible'] . '<br/>Vendedor: <a class="linkEmpresa" href="../front-end/mostrar_empresa.php?correo=' . $datosEmpresa["correo"] . '">' . $datosEmpresa["correo"] . '</a><br/>Localizaci&oacute;n: ' . $fila['localizacion'] . '<br/></div></div><br/>' .
            '<div id="relleno"></div><div class="w3-container w3-card" id="map-canvas"></div></div>';


    return $table;
}

/**
 * Muestra los datos del producto que existe en el carrito cuyo id sea el dado
 * por parámetro.
 * @param string $id
 * @return string
 */
function muestraProductoCarrito($id) {
    global $arrayComunidades;
    global $arrayCategorias;
    global $esquema;
    $query = "SELECT * FROM producto WHERE id_producto='$id'";
    $result = realizarQuery($esquema, $query);
    $fila = mysqli_fetch_array($result);
    $precio = $fila['precio'] - ($fila['precio'] * ($fila['porcentaje_descuento'] / 100));
    $sql = "SELECT * FROM lanzamientos WHERE id_producto='$id'";
    $result = realizarQuery($esquema, $sql);
    $datosEmpresa = mysqli_fetch_array($result);
    $p_desc = (100 - $fila["porcentaje_descuento"]) * $fila["precio"] / 100;

    $table = '<div class="w3-container w3-white w3-border w3-round w3-section" style="padding:3%"><a href="producto.php?id='.$id.'"><div class="contenedorProducto"></div><div class="w3-container w3-third"><div class="zoom"><img class="w3-image w3-card" src="' . '../imagenesSubidas/' . $fila['ruta_imagen'] . '"alt="' . $fila["nombre"] . '"/></div></div>' .
            '<div class="w3-container w3-twothird"><div class="w3-container w3-half"><h2>' . $fila['nombre'] . '</h2></div><div class="w3-container w3-half"><div class="w3-container w3-third"><span style="text-decoration: line-through">' . $fila["precio"] . '&euro;</span></div><div class="w3-container w3-third"><span class="w3-tag w3-padding w3-red" style="transform:rotate(-5deg)">-' . $fila['porcentaje_descuento'] . '%</span></div><div class="w3-container w3-third"><span style="font-weight: bold"> ' . $p_desc . '&euro;</span></div></div>' .
            '<div class="w3-container">' . $fila['descripcion'] . '<br/>Unidades restantes: ' . $fila['cantidad_disponible'] . '<br/>Vendedor: <a class="linkEmpresa" href="../front-end/mostrar_empresa.php?correo=' . $datosEmpresa["correo"] . '">' . $datosEmpresa["correo"] . '</a><br/>Localizaci&oacute;n: ' . $fila['localizacion'] . '<br/></div></div><br/>' .
            '</a></div>';


    return $table;
}

/**
 * Muestra el botón para añadir un producto cuyo id viene dado por parámtro al 
 * carrito.
 * @param string $id
 */
function mostrarBotonAnadir($id) {
    $cookieCarrito = $_COOKIE["carrito"];
    global $esquema;
    $query = "SELECT * FROM producto WHERE id_producto='$id'";
    $result = realizarQuery($esquema, $query);
    $fila = mysqli_fetch_array($result);
    echo '<button class="w3-btn w3-block w3-flat-orange w3-large" onclick="addCarrito(\'' . $id . '\', '.$fila['cantidad_disponible'].')" style="margin-top: 1%">A&ntilde;adir a Carrito 🛒</button>';
}
?>
