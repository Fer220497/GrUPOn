<?php

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

if (isset($_POST['modificarProducto'])) {
    if (!isset($_POST['nombre'])) {
        $errores[] = 'Debes introducir nombre.';
    }
    if (!isset($_POST['precio'])) {
        $errores[] = 'Debes introducir precio.';
    }
    if (!isset($_POST['descripcion'])) {
        $errores[] = 'Debes introducir descripci&oacute;n.';
    }
    if (!isset($_POST['localizacion'])) {
        $errores[] = 'Debes introducir localizaci&oacute;n.';
    }
    if (!isset($_POST['porcentaje_descuento'])) {
        $errores[] = 'Debes introducir porcentaje de descuento.';
    }
    if (!isset($errores)) {
        $sql = 'SELECT * FROM PRODUCTO WHERE id_producto = "' . 2 . '"';
        $result = realizarQuery($esquema, $sql);
        $producto = mysqli_fetch_row($result);
        $cantidadVendida = $producto[9];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $localizacion = $_POST['localizacion'];
        $porcentaje_descuento = $_POST['porcentaje_descuento'];
        $categoria = $_POST['categoria'];
        $comunidad = $_POST['comunidad'];
        $cantidad = $_POST['cantidad'];
        $total = $cantidadVendida + $cantidad;
        $sql = "UPDATE PRODUCTO SET nombre_categoria = '" . $categoria . "', nombre_ca = '" . $comunidad . "', nombre = '" . $nombre . "', precio = '" . $precio . "', descripcion = '" . $descripcion . "', localizacion = '" . $localizacion . "', cantidad_disponible = '" . $cantidad . "', cantidad_total ='" . $total . "', porcentaje_descuento = '" . $porcentaje_descuento . "' WHERE id_producto = 2";
        realizarQuery($esquema, $sql);
    }
}
if (!isset($_POST['modificarProducto']) || isset($errores)) {
    if (isset($errores)) {
        muestraErrores($errores);
    }
    echo formularioModificarProducto(2);
}

function formularioModificarProducto($id_producto) {
    global $esquema;
    $sql = 'SELECT * FROM PRODUCTO WHERE id_producto = "' . $id_producto . '"';
    $result = realizarQuery($esquema, $sql);
    $producto = mysqli_fetch_row($result);
    $form = '<form action="" method="post">' .
            'Nombre: <input type="text" name="nombre" value="' . $producto[4] . '"/><br/>' .
            'Precio: <input type="number" name="precio" value="' . $producto[5] . '"/><br/>' .
            'Descripci&oacute;n: <textarea name="descripcion" rows="4" cols="10">' . $producto[6] . '</textarea><br/>' .
            'Categor&iacute;a: <select name="categoria">' . optionCategoriasSeleccionadas($producto[1]) . '</select><br/>' .
            'Comunidad aut&oacute;noma: <select name="comunidad">' . opcionesComunidadSeleccionada($producto[2]) . '</select><br/>' .
            'Localizaci&oacute;n: <input type="text" name="localizacion" value="' . $producto[7] . '" /><br/>' .
            'Porcentaje descuento: <input type="number" name="porcentaje_descuento" value="' . $producto[8] . '" /><br/>' .
            'Cantidad disponible: <input type="number" name="cantidad" value="' . $producto[11] . '" /><br/>' .
            '<input type="submit" name="modificarProducto" value="Enviar"/>' .
            '</form>';
    return $form;
}

?>