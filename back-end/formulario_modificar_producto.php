<?php

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';




if (isset($_POST['modificarProducto'])) {
    if (!isset($_POST['nombre'])) {
        $errores[] = 'Debes introducir nombre.';
    }
    if (!isset($_POST['precio'])) {
        //echo "error2";
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
    
    /**
     * AHORA PROCEDEMOS A LA VALIDACION/SANEAMIENTO DE ENTRADAS
     */
    
    //Nombre: SANITAR STRING
    $_POST['nombre'] = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    //Precio: VALIDAR FLOAT, COMPROBAR LIMITES Y SANEAR
    if(!filter_var($_POST['precio'], FILTER_VALIDATE_FLOAT) || $_POST['precio'] <= 0){
        $error[] = 'Precio incorrecto';
    }else{
        $_POST['precio'] = filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT);
    }
    //Descripción: SANITAR STRING
    $_POST['descripcion'] = filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING);
    //Localización: SANITAR STRING
    $_POST['localizacion'] = filter_var($_POST['localizacion'], FILTER_SANITIZE_STRING);
    //Descuento: VALIDAR INT, COMPROBAR LIMITES Y SANEAR
    if(!filter_var($_POST['porcentaje_descuento'], FILTER_VALIDATE_INT) ||
            $_POST['porcentaje_descuento'] < 1 || $_POST['porcentaje_descuento'] > 99){
        $error[] = 'Porcentaje de descuento incorrecto';
    }else{
        $_POST['porcentaje_descuento'] = filter_var($_POST['porcentaje_descuento'], FILTER_SANITIZE_NUMBER_INT);
    }
    //Cantidad: VALIDAR INT, COMPROBAR LIMITES Y SANEAR
    if(!filter_var($_POST['cantidad'], FILTER_VALIDATE_INT) ||
            $_POST['cantidad'] <= 0){
        $error[] = 'Cantidad disponible incorrecta';
    }else{
        $_POST['cantidad'] = filter_var($_POST['cantidad'],FILTER_SANITIZE_NUMBER_INT);
    }

    if (!isset($errores)) {
        if (!isset($_FILES['imagen'])) {
            $foto = $producto["ruta_imagen"];
        } else {

            $foto = $_FILES['imagen']['name'];
        }

        $sql = 'SELECT * FROM producto WHERE id_producto = "' . $_GET['id'] . '"';
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
        $sql = "UPDATE producto SET nombre_categoria = '" . $categoria . "', nombre_ca = '" . $comunidad . "', nombre = '" . $nombre . "'"
                . ", precio = '" . $precio . "', descripcion = '" . $descripcion . "', localizacion = '" . $localizacion . "'"
                . ", cantidad_disponible = '" . $cantidad . "', cantidad_total ='" . $total . "', "
                . "porcentaje_descuento = '" . $porcentaje_descuento . "', ruta_imagen ='" . $nombreFichero . "', id_catalogo = " . $id_catalogo . " WHERE id_producto ='" . $_GET['id'] . "'";
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
    $correo = $_SESSION['cuenta'];
    global $esquema;
    $sql = 'SELECT * FROM producto WHERE id_producto = "' . $id . '"';
    $result = realizarQuery($esquema, $sql);
    $producto = mysqli_fetch_array($result);
    $form = '<div class="w3-container w3-white w3-border w3-round w3-section ">' .
            '<form action="" method="post" enctype="multipart/form-data">' .
            'Nombre: <input  class="w3-input" type="text" name="nombre" value="' . $producto["nombre"] . '" required/><br/>' .
            'Precio: <input class="w3-input"  type="number" name="precio" value="' . $producto["precio"] . '" required/><br/>' .
            'Descripci&oacute;n: <textarea name="descripcion" rows="4" cols="10" required>' . $producto["descripcion"] . '</textarea><br/>' .
            'Categor&iacute;a: <select class="w3-input" name="categoria">' . optionCategoriasSeleccionadas($producto["nombre_categoria"]) . '</select><br/>' .
            'Comunidad aut&oacute;noma: <select class="w3-input" name="comunidad">' . opcionesComunidadSeleccionada($producto["nombre_ca"]) . '</select><br/>' .
            'Cat&aacute;logo <select class="w3-input" name="id_catalogo">' .
            '<option value=""></option>'; ///////////POR AÑADIR
    $sql = "SELECT id_catalogo, nombre FROM catalogo WHERE correo='$correo'";
    $result = realizarQuery($esquema, $sql);
    while ($fila = mysqli_fetch_row($result)) {
        $form .= '<option value="' . $fila[0] . '">' . $fila[1] . '</option>';
    }
    $form .= '</select><br>' .
            'Localizaci&oacute;n: <input  class="w3-input"  type="text" name="localizacion" value="' . $producto["localizacion"] . '" required/><br/>' .
            'Porcentaje descuento: <input  class="w3-input"  type="number" name="porcentaje_descuento" value="' . $producto["porcentaje_descuento"] . '" required/><br/>' .
            'Cantidad disponible: <input class="w3-input"  type="number" name="cantidad" value="' . $producto["cantidad_disponible"] . '" required/><br/>' .
            'Imagen: <div><img alt="' . $producto["nombre"] . '" src="../imagenesSubidas/' . $producto['ruta_imagen'] . '" height = "200"></div>' .
            '<input type="file" name="imagen"/><br/>' .
            '<input class="w3-btn w3-light-grey w3-round w3-block w3-hover-pale-green w3-margin w3-border" type="submit" name="modificarProducto" value="Enviar"/>' .
            '</form></div>';

   
    return $form;
}

?>