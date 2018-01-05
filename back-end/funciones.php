
<?php

require_once '../back-end/conexion_db.php';
/**
 * Recibe un id y un string de la siguiente forma 1,2,3,4
 * Añade el id al final
 * @param string $id
 * @param string $carritoActual
 * @return string
 */
function addCarrito($id, $carritoActual){
    $array = explode(',', $carritoActual);
    $array[] = $id;
    $string = implode(',', $array);
    return $string;
}
/**
 * Recibe un id y un string de la siguiente forma 1,2,3,4
 * Elimina el id
 * @param string $id
 * @param string $carritoActual
 * @return string
 */
function removeCarrito($id, $carritoActual){
    $array = explode(',', $carritoActual);
    $carrito = array_diff($carrito, [$id]);
    $string = implode(',', $carrito);
    return $string;
}

/**
 * Función que checkea si existe un correo que se le pase ya en la DB.
 * @param type $correo
 * @return boolean
 */
function existeCorreo($correo) {
    global $esquema;
    $sql = "SELECT * FROM CUENTA WHERE CORREO='" . $correo . "'";
    $result = realizarQuery($esquema, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function esImagen($fichero) {
    $tiposAceptados = Array('image/gif', 'image/jpeg', 'image/pjpeg' , 'image/png');
    return in_array($fichero['type'],$tiposAceptados);
}

function limiteTamanyo($fichero,$limite) {
    return $fichero['size']<=$limite;
}

$arrayComunidades = array(
    "andalucia" => "Andaluc&iacute;a",
    "aragon" => "Arag&oacute;n",
    "asturias" => "Asturias",
    "canarias" => "Canarias",
    "cantabria" => "Cantabria",
    "castilla_la_mancha" => "Castilla La Mancha",
    "castilla_y_leon" => "Castilla y Le&oacute;n",
    "catalunya" => "Catalu&ntilde;a",
    "ceuta" => "Ceuta",
    "extremadura" => "Extremadura",
    "galicia" => "Galicia",
    "islas_baleares" => "Islas Baleares",
    "la_rioja" => "La Rioja",
    "madrid" => "Madrid",
    "melilla" => "Melilla",
    "murcia" => "Murcia",
    "navarra" => "Navarra",
    "pais_vasco" => "Pa&iacute;s Vasco",
    "valencia" => "Valencia",
);

$arrayCategorias = array(
    "viajes" => "Viajes",
    "entretenimiento" => "Entretenimiento",
    "gastronomia" => "Gastronom&iacute;a",
    "electronica" => "Electr&oacute;nica",
    "ropa" => "Ropa",
    "salud_y_belleza" => "Salud y belleza",
    "deporte" => "Deporte",
);

function menuCategorias() {
    $form = "";
    global $arrayCategorias;
    $cookie_name = "categoria";

    foreach ($arrayCategorias as $key => $val) {

        $form .= '<a href="buscar_producto.php" onclick="setCookie(\'' . $cookie_name . '\',\'' . $key . '\', 1)">' . $val . '</a>   ';
    }

    $form .= '<a href="buscar_producto.php" onclick="setCookie(\'' . $cookie_name . '\',\'general\',1)">General</a>';
    return $form;
}

/**
 * Función que genera options con las comunidades autonomas
 */
function opcionesComunidades() {
    $opt = '';
    global $arrayComunidades;
    foreach ($arrayComunidades as $key => $val) {
        $opt .= '<option value="' . $key . '">' . $val . '</option>';
    }

    return $opt;
}

/**
 * Función que genera options con las comunidades autonomas y una seleccionada.
 * @param type $comunidadAutonoma
 */
function opcionesComunidadSeleccionada($comunidadAutonoma) {
    $opt = '';
    global $arrayComunidades;
    foreach ($arrayComunidades as $key => $val) {
        if ($comunidadAutonoma == $key) {
            $opt .= '<option value="' . $key . '" selected="selected">' . $val . '</option>';
        } else {
            $opt .= '<option value="' . $key . '">' . $val . '</option>';
        }
    }
    return $opt;
}

function opcionesCatSeleccionada($catsel) {
    $opt = '';
    global $arrayCategorias;
    foreach ($arrayCategorias as $key => $val) {
        if ($catsel == $key) {
            $opt .= '<option value="' . $key . '" selected="selected">' . $val . '</option>';
        } else {
            $opt .= '<option value="' . $key . '">' . $val . '</option>';
        }
    }
    return $opt;
}

function checkboxesCategorias() {
    global $arrayCategorias;
    $form = '';
    foreach ($arrayCategorias as $key => $val) {
        $form .= $val . ': <input type="checkbox" name="' . $key . '" value="' . $key . '"/><br/>';
    }
    return $form;
}

function checkboxesCategoriasSeleccionadas($afinidades) {
    global $arrayCategorias;
    $form = '';
    foreach ($arrayCategorias as $key => $val) {
        if (in_array($key, $afinidades)) {
            $form .= $val . ': <input type="checkbox" name="' . $key . '" value="' . $key . '" checked/><br/>';
        } else {
            $form .= $val . ': <input type="checkbox" name="' . $key . '" value="' . $key . '"/><br/>';
        }
    }
    return $form;
}

function optionCategorias() {
    global $arrayCategorias;
    $form = '';
    global $arrayCategorias;
    foreach ($arrayCategorias as $key => $val) {
        $form .= '<option value="' . $key . '">' . $val . '</option>';
    }
    return $form;
}

function optionCategoriasSeleccionadas($cat) {
    $opt = '';
    global $arrayCategorias;
    foreach ($arrayCategorias as $key => $val) {
        if ($cat == $key) {
            $opt .= '<option value="' . $key . '" selected="selected">' . $val . '</option>';
        } else {
            $opt .= '<option value="' . $key . '">' . $val . '</option>';
        }
    }
    return $opt;
}

//Hay que cambiar la KEY ya que esta es de prueba.
$recaptcha = '<div data-theme="dark" class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>';
//KEY secreta del Recaptcha 
$secret = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';

/**
 * Función que genera un HTML con un array de errores 
 * (el array de errores debe contener unicamente strings)
 * @param string $error
 * @return string
 */
function muestraErrores($error) {
    $bloqueHTML = '<div class="error"><h1>Se han producido los siguientes errores:</h1><ul>';
    foreach ($error as $err) {
        $bloqueHTML .= "<li>$err</li>";
    }
    $bloqueHTML .= '</ul></div>';
    return $bloqueHTML;
}

function inicializarDB() {
    global $arrayCategorias;
    global $arrayComunidades;
    global $esquema;
    foreach ($arrayComunidades as $key => $val) {
        $sql = 'SELECT * FROM COMUNIDAD_AUTONOMA';
        $result = realizarQuery($esquema, $sql);
        if (mysqli_num_rows($result) != count($arrayComunidades)) {
            $sql = "INSERT INTO COMUNIDAD_AUTONOMA VALUES ('$key')";
            realizarQuery($esquema, $sql);
        }
    }
    foreach ($arrayCategorias as $key => $val) {
        $sql = 'SELECT * FROM CATEGORIA';
        $result = realizarQuery($esquema, $sql);
        if (mysqli_num_rows($result) != count($arrayCategorias)) {
            $sql = "INSERT INTO CATEGORIA VALUES ('$key')";
            realizarQuery($esquema, $sql);
        }
    }
}

function tipoCuenta($correo){
    //True cliente, false empresa
    $cuenta = TRUE;
    $query = "SELECT * FROM CLIENTE WHERE correo = '$correo'";
    $result = realizarQuery($esquema, $query);
    $result = mysqli_fetch_array($result);
    if(mysqli_num_rows($result) == 0){
        $cuenta = FALSE;
    }
    return $cuenta;
}

/* * TAMAÑOS MAXIMOS DE LAS VARIABLES EN LA DB* */
$tamCorreo = 75;
$tamNombreEmpresa = 100;
$tamNIF = 9;
$tamWeb = 255;
$tamDireccion = 255;
$tamCuentaBancaria = 20;
$tamTelefono = 9;
$tamNombreCliente = 50;
$tamApellidosCliente = 50;
?>
