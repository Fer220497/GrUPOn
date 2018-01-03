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
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $localizacion = $_POST['localizacion'];
        $porcentaje_descuento = $_POST['porcentaje_descuento'];
        $sql = "UPDATE PRODUCTO SET nombre = '" . $nombre . "', precio = '" . $precio . "', descripcion = '" . $descripcion . "', localizacion = '" . $localizacion . "', porcentaje_descuento = '" . $porcentaje_descuento . "' WHERE id_producto = 2";
        realizarQuery('grupon', $sql);
    }
}
if (!isset($_POST['modificarProducto']) || isset($errores)) {
    if (isset($errores)) {
        muestraErrores($errores);
    }
    echo formularioModificarProducto(2);
}

function formularioModificarProducto($id_producto) {

    $sql = 'SELECT * FROM PRODUCTO WHERE id_producto = "' . $id_producto . '"';
    $result = realizarQuery('grupon', $sql);
    $producto = mysqli_fetch_row($result);

    $form = '<form action="" method="post">' .
            'Nombre: <input type="text" name="nombre" value="' . $producto[4] . '"/><br/>' .
            'Precio: <input type="number" name="precio" value="' . $producto[5] . '"/><br/>' .
            'Descripci&oacute;n: <textarea name="descripcion" rows="4" cols="10">' .$producto[6] . '</textarea><br/>' .
            'Localizaci&oacute;n: <input type="text" name="localizacion" value="' . $producto[7] . '" /><br/>' .
            'Porcentaje Descuento: <input type="number" name="porcentaje_descuento" value="' . $producto[8] . '" /><br/>' .
            '<input type="submit" name="modificarProducto" value="Enviar"/>' .
            '</form>';
    return $form;
}

?>