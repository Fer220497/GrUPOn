<?php

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';




if (isset($_POST['modificarProducto'])) {
    if (!isset($_POST['nombre'])) {
        $errores[] = 'Debes introducir nombre.';
    }
    if (!isset($_POST['precio'])) {
        echo "error2";
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
    if ($_FILES['imagen']['name'] != '') {
        echo $_FILES["imagen"]["name"];
        if (!esImagen($_FILES['imagen'])) {
            print_r($_FILES["imagen"]);
            $errores[] = "NO ES UNA IMAGEN";
        }
        if (!limiteTamanyo($_FILES["imagen"], 1000 * 5120)) {
            $errores[] = "TAMAÑO MAXIMO";
        }
    }

    if (!isset($errores)) {
        if (!isset($_FILES['imagen'])) {
            $foto = $producto["ruta_imagen"];
        } else {

            $foto = $_FILES['imagen']['name'];
        }

        $sql = 'SELECT * FROM PRODUCTO WHERE id_producto = "' . $_COOKIE['productoVisitado'] . '"';
        $result = realizarQuery($esquema, $sql);
        $producto = mysqli_fetch_array($result);
        $cantidadVendida = $producto["cantidad_vendida"];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $localizacion = $_POST['localizacion'];
        $porcentaje_descuento = $_POST['porcentaje_descuento'];
        $categoria = $_POST['categoria'];
        $comunidad = $_POST['comunidad'];
        $cantidad = $_POST['cantidad'];
        if ($_POST["id_catalogo"] == "") {
            $id_catalogo = "NULL";
        } else {
            $id_catalogo = $_POST['id_catalogo'];
        }
        //$arch = $_FILES['imagen']['name'];
        if ($_FILES['imagen']['name'] != '') {
            $fichero = explode('.', $_FILES['imagen']['name']);
            //print_r($fichero);
            $extension = '.' . $fichero[count($fichero) - 1];
            $nombreFichero = microtime() . $extension;
        } else {
            $nombreFichero = $producto["ruta_imagen"];
        }

        //  echo $nombreFichero;
        $total = $cantidadVendida + $cantidad;
        $sql = "UPDATE PRODUCTO SET nombre_categoria = '" . $categoria . "', nombre_ca = '" . $comunidad . "', nombre = '" . $nombre . "'"
                . ", precio = '" . $precio . "', descripcion = '" . $descripcion . "', localizacion = '" . $localizacion . "'"
                . ", cantidad_disponible = '" . $cantidad . "', cantidad_total ='" . $total . "', "
                . "porcentaje_descuento = '" . $porcentaje_descuento . "', ruta_imagen ='" . $nombreFichero . "', id_catalogo = " . $id_catalogo . " WHERE id_producto ='" . $_COOKIE['productoVisitado'] . "'";
        echo $sql;
        realizarQuery($esquema, $sql);
        $tmp = $_FILES['imagen']['tmp_name'];
        move_uploaded_file($tmp, "../imagenesSubidas/$nombreFichero");
        header('Location: ../front-end/cuenta.php');
    }
}

if (!isset($_POST['modificarProducto']) || isset($errores)) {

    if (isset($errores)) {
        echo "1";
        muestraErrores($errores);
    }
    echo formularioModificarProducto($_GET['id']);
}

function formularioModificarProducto($id) {
    global $esquema;
    $sql = 'SELECT * FROM PRODUCTO WHERE id_producto = "' . $id . '"';
    $result = realizarQuery($esquema, $sql);
    $producto = mysqli_fetch_array($result);
    $form = '<form action="" method="post" enctype="multipart/form-data">' .
            'Nombre: <input type="text" name="nombre" value="' . $producto["nombre"] . '"/><br/>' .
            'Precio: <input type="number" name="precio" value="' . $producto["precio"] . '"/><br/>' .
            'ID_Catalogo:<input type="number" name="id_catalogo" value="' . $producto["id_catalogo"] . '"/><br/>' .
            'Descripci&oacute;n: <textarea name="descripcion" rows="4" cols="10">' . $producto["descripcion"] . '</textarea><br/>' .
            'Categor&iacute;a: <select name="categoria">' . optionCategoriasSeleccionadas($producto["nombre_categoria"]) . '</select><br/>' .
            'Comunidad aut&oacute;noma: <select name="comunidad">' . opcionesComunidadSeleccionada($producto["nombre_ca"]) . '</select><br/>' .
            'Localizaci&oacute;n: <input type="text" name="localizacion" value="' . $producto["localizacion"] . '" /><br/>' .
            'Porcentaje descuento: <input type="number" name="porcentaje_descuento" value="' . $producto["porcentaje_descuento"] . '" /><br/>' .
            'Cantidad disponible: <input type="number" name="cantidad" value="' . $producto["cantidad_disponible"] . '" /><br/>' .
            'Imagen: <div><img alt="' . $producto["nombre"] . '" src="../imagenesSubidas/' . $producto['ruta_imagen'] . '" height = "200"></div>' .
            '<input type="file" name="imagen"/><br/>' .
            '<input type="submit" name="modificarProducto" value="Enviar"/>' .
            '</form>';

   
    return $form;
}

?>