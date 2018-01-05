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
    if (!isset($_POST['foto'])) {
        $errores[] = 'Debes introducir una foto.';
    }
    if (isset($_FILES['foto']) && $_FILES['foto']['size'] > 1024 * 5120){
        $errores[] = 'Error en el tama&ntilde;o de la foto.';
    }
    if (isset($_FILES['foto']) && $_FILES['foto']['type'] == 'image/jpeg'){
        $errores[] = 'Error en el formato de la foto.';
    }
    if (!isset($errores)) {
        if (!isset($_FILES['foto'])) {
            $foto = $producto[13];
        } else {
            move_uploaded_file($_FILES['foto']['temp_name'], '..\img\\');
            $foto = $_FILES['foto']['name'];
        }
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
        $sql = "UPDATE PRODUCTO SET nombre_categoria = '" . $categoria . "', nombre_ca = '" . $comunidad . "', nombre = '" . $nombre . "', precio = '" . $precio . "', descripcion = '" . $descripcion . "', localizacion = '" . $localizacion . "', cantidad_disponible = '" . $cantidad . "', cantidad_total ='" . $total . "', porcentaje_descuento = '" . $porcentaje_descuento . "', ruta_imagen ='" . $foto . "' WHERE id_producto = 2";
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
    $form = '<form action="" method="post" enctype="multipart/form-data">' .
            'Nombre: <input type="text" name="nombre" value="' . $producto[5] . '"/><br/>' .
            'Precio: <input type="number" name="precio" value="' . $producto[6] . '"/><br/>' .
            'Descripci&oacute;n: <textarea name="descripcion" rows="4" cols="10">' . $producto[7] . '</textarea><br/>' .
            'Categor&iacute;a: <select name="categoria">' . optionCategoriasSeleccionadas($producto[2]) . '</select><br/>' .
            'Comunidad aut&oacute;noma: <select name="comunidad">' . opcionesComunidadSeleccionada($producto[3]) . '</select><br/>' .
            'Localizaci&oacute;n: <input type="text" name="localizacion" value="' . $producto[8] . '" /><br/>' .
            'Porcentaje descuento: <input type="number" name="porcentaje_descuento" value="' . $producto[9] . '" /><br/>' .
            'Cantidad disponible: <input type="number" name="cantidad" value="' . $producto[12] . '" /><br/>' .
            'Imagen: <div><img alt="' . $producto[5] . '" src = "..\img\\' . $producto[13] . '" height = 200/></div>' .
            '<input type="file" name="foto"/><br/>' .
            '<input type="submit" name="modificarProducto" value="Enviar"/>' .
            '</form>';
    return $form;
}

?>