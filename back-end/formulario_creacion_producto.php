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
        $sql = "SELECT id_catalogo FROM CATALOGO WHERE correo='$correo ' AND id_catalogo='$id_catalogo'";
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
    $sql = "SELECT nombre FROM PRODUCTO WHERE nombre='$nombre'";
    $result = realizarQuery("grupon", $sql);
    if (mysqli_num_rows($result) > 0) {
        $error[] = "Nombre ya existente";
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
            $sql = "INSERT INTO PRODUCTO (nombre_categoria, nombre_ca, id_catalogo, nombre, precio, descripcion, localizacion, porcentaje_descuento, cantidad_vendida, cantidad_total, cantidad_disponible, ruta_imagen  )"
                    . " VALUES('" . $_POST['nombre_categoria'] . "','" . $_POST['nombre_ca'] . "'," . $id_catalogo . ",'" . $nombre .
                    "','" . $precio . "','" . $descripcion . "','" . $localizacion . "','" . $porcentaje_descuento . "','0','" . $cantidad_disponible . "','" . $cantidad_disponible . "','" .$nombreFichero . "')";
        } else {
            $sql = "INSERT INTO PRODUCTO (nombre_categoria, nombre_ca, id_catalogo, nombre, precio, descripcion, localizacion, porcentaje_descuento, cantidad_vendida, cantidad_total, cantidad_disponible, ruta_imagen )"
                    . " VALUES('" . $_POST['nombre_categoria'] . "','" . $_POST['nombre_ca'] . "','" . $_POST['id_catalogo'] . "','" . $nombre .
                    "','" . $precio . "','" . $descripcion . "','" . $localizacion . "','" . $porcentaje_descuento . "','0','" . $cantidad_disponible . "','" . $cantidad_disponible . "','" . $nombreFichero . "')";
        }
        realizarQuery("grupon", $sql);
        $sql = "SELECT id_producto FROM PRODUCTO WHERE nombre='" . $nombre . "'";
        $result = realizarQuery("grupon", $sql);
        $datospro = mysqli_fetch_array($result);
        $idproducto = $datospro['id_producto'];

        $sql = 'INSERT INTO LANZAMIENTOS(correo, id_producto, fecha_ini, fecha_fin, num_ventas ) VALUES("' . $correo . '",' . $idproducto . ',curdate(),curdate() ,0)';
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


    $form = '<form action="" method="post" enctype="multipart/form-data">' .
            'Categor&iacute;a: <select name="nombre_categoria">' . optionCategorias() .
            '</select><br>' .
            'Comunidad Aut&oacute;noma: <select name="nombre_ca">' . opcionesComunidades() .
            '</select><br>' .
            'Cat&aacute;logo <select name="id_catalogo">' .
            '<option value=""></option>'; ///////////POR AÑADIR
    $sql = "SELECT id_catalogo, nombre FROM CATALOGO WHERE correo='$correo'";
    $result = realizarQuery($esquema, $sql);
    while ($fila = mysqli_fetch_row($result)) {
        $form .= '<option value="' . $fila[0] . '">' . $fila[1] . '</option>';
    }
    $form .= '</select><br>' .
            'Nombre: <input type="text" name="nombre" /><br/>' .
            'Precio: <input type="number" name="precio" /><br/>' .
            'Descripci&oacute;n: <textarea name="descripcion" rows="4" cols="10"></textarea><br/>' .
            'Localizaci&oacute;n: <input type="text" name="localizacion" /><br/>' .
            'Porcentaje Descuento: <input type="number" name="porcentaje_descuento" /><br/>' .
            'Cantidad Disponible: <input type="number" name="cantidad_disponible" /><br/>' .
            'Imagen:<input type="file" name="imagen"/>' .
            '<input type="submit" name="crearProducto" value="Enviar"/>' .
            '</form>';
    return $form;
}

?>