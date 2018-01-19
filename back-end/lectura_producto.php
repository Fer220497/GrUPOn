<?php

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

/**
 * Muestra el producto pasado por referencia
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
    //$dirpath = realpath(dirname(getcwd()));
    $sql = "SELECT * FROM lanzamientos WHERE id_producto='$id'";
    $result = realizarQuery($esquema, $sql);
    $datosEmpresa = mysqli_fetch_array($result);
    //echo $sql;
    $p_desc = (100 - $fila["porcentaje_descuento"]) * $fila["precio"] / 100;

//    $table = '<input type="hidden" id="localizacion" value="' . $fila['localizacion'] . '"/>'
//            . '<table border="1">'
//            . '<tr>'
//            . '<td>' . $fila['nombre'] . '</td></tr>' .
//            ' <tr><td>Imagen:</td><td><img src="' . '../imagenesSubidas/' . $fila['ruta_imagen'] . '"alt="IMAGEN" height="200"/>'
//            . '<tr><td>Descripci&oacute;n: ' . $fila['descripcion'] . '</td></tr>'
//            . '<tr><td>Descuento: ' . $fila['porcentaje_descuento'] . '%</td><td>Precio: ' . $fila['precio'] . '&euro;</td><td>Unidades Restantes:' . $fila['cantidad_disponible'] . '</td></tr>'
//            . '<tr><td>Precio: ' . $precio . '&euro;</td></tr> '
//            . '<tr><td>Vendedor: <a href="../front-end/mostrar_empresa.php?correo=' . $datosEmpresa["correo"] . '">' . $datosEmpresa["correo"] . '</a></td></tr>'
//            . '<tr><td>Categor&iacute;a: ' . $arrayCategorias[$fila['nombre_categoria']] . '</td><td>Ofertado en: ' . $arrayComunidades[$fila['nombre_ca']] . '</td></tr>'
//            . '<tr><td>Localizacion: ' . $fila["localizacion"] . ''
//            . '<tr><td><div id="map-canvas"></div></td></tr>'
//            . '</td></tr></table>';

    $table = '<input type="hidden" id="localizacion" value="' . $fila['localizacion'] . '"/>' .
            '<div class="w3-container w3-white w3-border w3-round"><div class="w3-container w3-third"><div class="zoom"><img class="w3-image" src="' . '../imagenesSubidas/' . $fila['ruta_imagen'] . '"alt="' . $fila["nombre"] . '"/></div></div>' .
            '<div class="w3-container w3-twothird"><div class="w3-container w3-half">' . $fila['nombre'] . '</div><div class="w3-container w3-half"><div class="w3-container w3-third"><span style="text-decoration: line-through">' . $fila["precio"] . '&euro;</span></div><div class="w3-container w3-third"><span class="w3-tag w3-padding w3-red" style="transform:rotate(-5deg)">-' . $fila['porcentaje_descuento'] . '%</span></div><div class="w3-container w3-third"><span style="font-weight: bold"> ' . $p_desc . '&euro;</span></div></div>' .
            '<div class="w3-container">' . $fila['descripcion'] . '<br/>Unidades restantes: ' . $fila['cantidad_disponible'] . '<br/>Vendedor: <a href="../front-end/mostrar_empresa.php?correo=' . $datosEmpresa["correo"] . '">' . $datosEmpresa["correo"] . '</a><br/>Localizaci&oacute;n: ' . $fila['localizacion'] . '<br/></div></div><br/>' .
            '<div class="w3-container" id="map-canvas"></div></div>';


    return $table;
}

function mostrarBotonAnadir($id) {
    $cookieCarrito = $_COOKIE["carrito"];
    echo '<button onclick="addCarrito(\'' . $id . '\',' . $cookieCarrito . ')">A&ntilde;adir a Carrito</button>';
}

?>
