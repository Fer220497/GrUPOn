<?php

$correo = $_SESSION["cuenta"];
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

if (isset($_POST['crearProducto'])) {
//


    if (!in_array($_POST["nombre_categoria"], $arrayCategorias)) {
        $error[] = "No existe la categoria";
    }

    if (!in_array($_POST["nombre_ca"], $arrayComunidades)) {
        $error[] = "No existe la categoria";
    }

    if (!isset($_POST["id_catalogo"])) {
        $error[] = "Debes introducir un catalogo";
    }
    $id_catalogo = $_POST["id_catalogo"];
    if ($_POST["id_catalogo"] != "") {
        $sql = "SELECT id_catalogo FROM CATALOGO WHERE correo='$correo ' AND id_catalogo='$id_catalogo'";
        $result = realizarQuery('grupon', $sql);
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

    if (!isset($error)) {
        $nombre = sanitarString($_POST["nombre"]);
        $precio = sanitarString($_POST["precio"]);
        $descripcion = sanitarString($_POST["descripcion"]);
        $localizacion = sanitarString($_POST["localizacion"]);
        $porcentaje_descuento = sanitarString($_POST["porcentaje_descuento"]);
        $cantidad_disponible = sanitarString($_POST["cantidad_disponible"]);
        $id_catalogo = $_POST['id_catalogo'];
        $nombre_categoria = $_POST['nombre_categoria'];

        if ($_POST["id_catalogo"] == "") {
            $id_catalogo = "NULL";
            $sql = "INSERT INTO PRODUCTO (nombre_categoria, nombre_ca, id_catalogo, nombre, precio, descripcion, localizacion, porcentaje_descuento, cantidad_vendida, cantidad_total, cantidad_disponible )"
                    . " VALUES('" . $_POST['nombre_categoria'] . "','" . $_POST['nombre_ca'] . "'," . $id_catalogo . ",'" . $nombre .
                    "','" . $precio . "','" . $descripcion . "','" . $localizacion . "','" . $porcentaje_descuento . "','0','" . $cantidad_disponible . "','" . $cantidad_disponible . "')";
        } else {
            $sql = "INSERT INTO PRODUCTO (nombre_categoria, nombre_ca, id_catalogo, nombre, precio, descripcion, localizacion, porcentaje_descuento, cantidad_vendida, cantidad_total, cantidad_disponible )"
                    . " VALUES('" . $_POST['nombre_categoria'] . "','" . $_POST['nombre_ca'] . "','" . $_POST['id_catalogo'] . "','" . $nombre .
                    "','" . $precio . "','" . $descripcion . "','" . $localizacion . "','" . $porcentaje_descuento . "','0','" . $cantidad_disponible . "','" . $cantidad_disponible . "')";
        }
        realizarQuery("grupon", $sql);
        $sql = "SELECT id_producto FROM PRODUCTO WHERE NOMBRE='" . $nombre . "'";
        $result = realizarQuery("grupon", $sql);
        $datospro = mysqli_fetch_array($result);
        $idproducto = $datospro['id_producto'];

        $sql = "INSERT INTO LANZAMIENTOS VALUES('$correo','$idproducto',curdate(),'NULL ','0')";
        realizarQuery("grupon", $sql);
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
    $correo = $_SESSION["cuenta"];


    $form = '<form action="" method="post">' .
            'Categor&iacute;a: <select name="nombre_categoria">' .
            '<option value="viajes">Viajes</option>' .
            '<option value="entretenimiento">Entretenimiento</option>' .
            '<option value="gastronomia">Gastronom&iacute;a</option>' .
            '<option value="electronica">Electr&oacute;nica</option>' .
            '<option value="ropa">Ropa</option>' .
            '<option value="salud_belleza">Salud y belleza </option>' .
            '<option value="deporte">Deporte </option>' .
            '</select><br>' .
            'Comunidad Aut&oacute;noma: <select name="nombre_ca">' .
            '<option value="andalucia">Andalucia</option>' .
            '<option value="aragon">Arag&oacute;n</option>' .
            '<option value="asturias">Asturias</option>' .
            '<option value="canarias">Canarias</option>' .
            '<option value="cantabria">Cantabria</option>' .
            '<option value="castilla_la_mancha">Castilla La Mancha </option>' .
            '<option value="castillo_y_leon">Castilla y Le&oacute;n </option>' .
            '<option value="catalunya">Catalu&ntilde;a</option>' .
            '<option value="ceuta">Ceuta</option>' .
            '<option value="extremadura">Extremadura</option>' .
            '<option value="galicia">Galicia </option>' .
            '<option value="islas_baleares">Islas Baleares</option>' .
            '<option value="la_rioja">La Rioja</option>' .
            '<option value="madrid">Madrid</option>' .
            '<option value="melilla"> Melilla</option>' .
            '<option value="murcia">Murcia</option>' .
            '<option value="navarra">Navarra</option>' .
            '<option value="pais_vasco">Pa&iacute;s Vasco</option>' .
            '<option value="valencia">Valencia</option>' .
            '</select><br>' .
            'Cat&aacute;logo <select name="id_catalogo">' .
            '<option value=""></option>'; ///////////POR AÑADIR
    $sql = "SELECT id_catalogo, nombre FROM CATALOGO WHERE correo='$correo'";
    $result = realizarQuery('grupon', $sql);
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
            '<input type="submit" name="crearProducto" value="Enviar"/>' .
            '</form>';
    return $form;
}

?>