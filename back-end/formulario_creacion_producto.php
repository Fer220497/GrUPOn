<?php

$correo = $_SESSION["cuenta"];
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

if (isset($_POST['crearProducto'])) {
//


    if (!array_key_exists($_POST["nombre_categoria"], $arrayCategorias)) {
        $error[] = "No existe la categoria";
    }

    if (!array_key_exists($_POST["nombre_ca"], $arrayComunidades)) {
        $error[] = "No existe la categoria";
    }

    if (!isset($_POST["id_catalogo"])) {
        $error[] = "Debes introducir un catalogo";
    }
    $id_catalogo = $_POST["id_catalogo"];
    if ($_POST["id_catalogo"] != "") {
        $sql = "SELECT id_catalogo FROM catalogo WHERE correo='$correo ' AND id_catalogo='$id_catalogo'";
        $result = realizarQuery($esquema, $sql);
        if (mysqli_num_rows($result) == 0) {
            $error[] = "No existe ese catalogo";
        }
    }

    if (!isset($_POST["nombre"])) {
        $error[] = "Debes introducir un nombre";
    }
    if (!isset($_POST["precio"])) {
        $error[] = "Debes introducir precio";
    }
    if (!isset($_POST["descripcion"])) {
        $error[] = "Debes introducir descripcion";
    }
    if (!isset($_POST["localizacion"])) {
        $error[] = "Debes introducir localizacion";
    }
    if (!isset($_POST["porcentaje_descuento"])) {
        $error[] = "Debes introducir un porcentaje";
    }
    if (!isset($_POST["cantidad_disponible"])) {
        $error[] = "Debes introducir cantidad";
    }
    if ($_POST["cantidad_disponible"] == 0) {
        $error[] = "Ponga una cantidad";
    }
    if (!isset($_FILES["imagen"])) {
        $error[] = "Debes introducir una imagen";
    }
    if (!(esImagen($_FILES['imagen']))) {
        $error[] = "NO ES UNA IMAGEN";
    }
    if (!limiteTamanyo($_FILES["imagen"], 1000 * 5120)) {
        $error[] = "TAMAÑO MAXIMO";
    }
    $nombre = sanitarString($_POST["nombre"]);
    $sql = "SELECT nombre FROM producto WHERE nombre='$nombre'";
    $result = realizarQuery("grupon", $sql);
    if (mysqli_num_rows($result) > 0) {
        $error[] = "Nombre ya existente";
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
    if(!filter_var($_POST['cantidad_disponible'], FILTER_VALIDATE_INT) ||
            $_POST['cantidad_disponible'] <= 0){
        $error[] = 'Cantidad disponible incorrecta';
    }else{
        $_POST['cantidad_disponible'] = filter_var($_POST['cantidad_disponible'],FILTER_SANITIZE_NUMBER_INT);
    }
    
    if (!isset($error)) {
        $nombre = sanitarString($_POST["nombre"]);
        $precio = sanitarString($_POST["precio"]);
        $descripcion = sanitarString($_POST["descripcion"]);
        $localizacion = sanitarString($_POST["localizacion"]);
        $porcentaje_descuento = sanitarString($_POST["porcentaje_descuento"]);
        $cantidad_disponible = sanitarString($_POST["cantidad_disponible"]);
        $imagen = sanitarString($_FILES["imagen"]["name"]);
        $id_catalogo = $_POST['id_catalogo'];
        $nombre_categoria = $_POST['nombre_categoria'];


        
        $dirpath = realpath(dirname(getcwd()));
        $arch=$_FILES['imagen']['name'];
        $fichero=explode('.',$_FILES['imagen']['name']);
        //print_r($fichero);
        $extension = '.'.$fichero[count($fichero)-1];
        $nombreFichero = microtime() . $extension;
        if ($_POST["id_catalogo"] == "") {
            $id_catalogo = "NULL";
            $sql = "INSERT INTO producto (nombre_categoria, nombre_ca, id_catalogo, nombre, precio, descripcion, localizacion, porcentaje_descuento, cantidad_vendida, cantidad_total, cantidad_disponible, ruta_imagen  )"
                    . " VALUES('" . $_POST['nombre_categoria'] . "','" . $_POST['nombre_ca'] . "'," . $id_catalogo . ",'" . $nombre .
                    "','" . $precio . "','" . $descripcion . "','" . $localizacion . "','" . $porcentaje_descuento . "','0','" . $cantidad_disponible . "','" . $cantidad_disponible . "','" .$nombreFichero . "')";
        } else {
            $sql = "INSERT INTO producto (nombre_categoria, nombre_ca, id_catalogo, nombre, precio, descripcion, localizacion, porcentaje_descuento, cantidad_vendida, cantidad_total, cantidad_disponible, ruta_imagen )"
                    . " VALUES('" . $_POST['nombre_categoria'] . "','" . $_POST['nombre_ca'] . "','" . $_POST['id_catalogo'] . "','" . $nombre .
                    "','" . $precio . "','" . $descripcion . "','" . $localizacion . "','" . $porcentaje_descuento . "','0','" . $cantidad_disponible . "','" . $cantidad_disponible . "','" . $nombreFichero . "')";
        }
        realizarQuery("grupon", $sql);
        $sql = "SELECT id_producto FROM producto WHERE nombre='" . $nombre . "'";
        $result = realizarQuery("grupon", $sql);
        $datospro = mysqli_fetch_array($result);
        $idproducto = $datospro['id_producto'];

        $sql = 'INSERT INTO lanzamientos(correo, id_producto, fecha_ini, fecha_fin, num_ventas ) VALUES("' . $correo . '",' . $idproducto . ',curdate(),curdate() ,0)';
        realizarQuery("grupon", $sql);
        $uploadroot="/docs";
        $arch=$_FILES['imagen']['name'];
        $tmp=$_FILES['imagen']['tmp_name'];
        //echo $dirpath;
        move_uploaded_file($tmp,"../imagenesSubidas/$nombreFichero");
    }
}



if (!isset($_POST["crearProducto"]) || isset($error)) {
    if (isset($error)) {
        echo muestraErrores($error);
    }

    echo formularioCrearProducto();
}


/*
 * Esta funcion genera un formulario para que los clientes puedan registrarse en forma de string
 */

function formularioCrearProducto() {
    global $esquema;
    $correo = $_SESSION["cuenta"];


    $form = '<div class="w3-container w3-white w3-border w3-round w3-section ">' .
            '<form action="" method="post" enctype="multipart/form-data">' .
            'Nombre: <input class="w3-input" type="text" name="nombre" /><br/>' .
            'Precio: <input class="w3-input"  type="number" name="precio" /><br/>' .
            'Descripci&oacute;n: <textarea name="descripcion" rows="4" cols="10"></textarea><br/>' .
            'Categor&iacute;a: <select name="nombre_categoria">' . optionCategorias() .
            '</select><br>' .
            'Comunidad Aut&oacute;noma: <select name="nombre_ca">' . opcionesComunidades() .
            '</select><br>' .
            'Cat&aacute;logo <select name="id_catalogo">' .
            '<option value=""></option>'; ///////////POR AÑADIR
    $sql = "SELECT id_catalogo, nombre FROM catalogo WHERE correo='$correo'";
    $result = realizarQuery($esquema, $sql);
    while ($fila = mysqli_fetch_row($result)) {
        $form .= '<option value="' . $fila[0] . '">' . $fila[1] . '</option>';
    }
    $form .= '</select><br>' .
            'Localizaci&oacute;n: <input  class="w3-input" type="text" name="localizacion" /><br/>' .
            'Porcentaje Descuento: <input  class="w3-input" type="number" name="porcentaje_descuento" /><br/>' .
            'Cantidad Disponible: <input class="w3-input"  type="number" name="cantidad_disponible" /><br/>' .
            'Imagen:<input type="file" name="imagen"/></br>' .
            '<input class="w3-button w3-light-grey w3-round w3-col m6" type="submit" name="crearProducto" value="Enviar"/>' .
            '</form></div>';
    return $form;
}

?>