<?php

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

if (isset($_SESSION['cuenta'])) {
    $correo = $_SESSION['cuenta'];
}

function muestraCuenta() {
    global $correo;
    global $esquema;

    if ($_SESSION['tipo'] === 'cliente') {
        $sql = "SELECT * FROM cuenta,cliente WHERE cuenta.correo='$correo' AND cliente.correo='$correo'";
        $result = realizarQuery($esquema, $sql);
        $fila = mysqli_fetch_array($result);    //OP READ SOBRE CLIENTE
        $string = muestraDatosCliente($fila);
    } else {
        $sql = "SELECT * FROM cuenta,empresa WHERE empresa.correo='$correo' AND cuenta.correo='$correo'";
        $result = realizarQuery($esquema, $sql);
        $fila = mysqli_fetch_array($result);    //OP READ SOBRE EMPRESA
        $string = muestraDatosEmpresa($fila);
    }
    return $string;
}

/**
 * Muestra los datos del cliente.
 * @param type $arrayClientes
 */
function muestraDatosCliente($fila) {
    global $arrayComunidades;
    return '<table border="1"><tr><td>Correo</td><td><span class="dato">' . $_SESSION['cuenta'] . '</span></td></tr>' .
            '<tr><td>Comunidad Aut&oacute;noma</td><td>' . $arrayComunidades[$fila['nombre_ca']] . '</td></tr>' .
            '<tr><td>Nombre</td><td><span class="dato">' . $_SESSION['nombre'] . '</span></td>' .
            '<tr><td>Apellidos</td><td><span class="dato">' . $fila['apellidos_cliente'] . '</span></td></table>';
}

/**
 * Muestra los datos de la empresa
 * @param type $arrayEmpresas
 */
function muestraDatosEmpresa($fila) {
    global $esquema;
    global $arrayComunidades;
    return '<table border="1"><tr><td>Correo</td><td><span class="dato">' . $_SESSION['cuenta'] . '</span></td></tr>' .
            '<tr><td>Comunidad Aut&oacute;noma</td><td>' . $arrayComunidades[$fila['nombre_ca']] . '</td></tr>' .
            '<tr><td>Nombre</td><td><span class="dato">' . $_SESSION['nombre'] . '</span></td>' .
            '<tr><td>Direcci&oacute;n</td><td><span class="dato">' . $fila['direccion_empresa'] . '</span></td>' .
            '<tr><td>NIF</td><td><span class="dato">' . $fila['nif_empresa'] . '</span></td>' .
            '<tr><td>Web</td><td><span class="dato">' . $fila['web_empresa'] . '</span></td>' .
            '<tr><td>Cuenta Bancaria</td><td><span class="dato">' . $fila['cuenta_bancaria'] . '</span></td>' .
            '<tr><td>Tel&eacute;fono</td><td><span class="dato">' . $fila['telefono_empresa'] . '</span></td>' .
            '<tr><td>Email para Clientes</td><td><span class="dato">' . $fila['email_empresa'] . '</span></td></table>';
}

/**
 * Muestra los datos de la empresa
 * @param type $arrayEmpresas
 */
function muestraDatosEmpresaMapa($correo) {
    global $esquema;
    global $arrayComunidades;
    $sql = "SELECT * FROM empresa,cuenta WHERE cuenta.correo='$correo' AND empresa.correo='$correo'";
    $result = realizarQuery($esquema, $sql);
    $fila = mysqli_fetch_array($result);
//    $str = '<input type=hidden id="localizacion" value="' . $fila['direccion_empresa'] . '"/>'
//            . '<table border="1"><tr><td>Correo</td><td><span class="dato">' . $fila['correo'] . '</span></td></tr>' .
//            '<tr><td>Comunidad Aut&oacute;noma</td><td>' . $arrayComunidades[$fila['nombre_ca']] . '</td></tr>' .
//            '<tr><td>Nombre</td><td><span class="dato">' . $fila['nombre_empresa'] . '</span></td>' .
//            '<tr><td>NIF</td><td><span class="dato">' . $fila['nif_empresa'] . '</span></td>' .
//            '<tr><td>Web</td><td><span class="dato">' . $fila['web_empresa'] . '</span></td>' .
//            '<tr><td>Cuenta Bancaria</td><td><span class="dato">' . $fila['cuenta_bancaria'] . '</span></td>' .
//            '<tr><td>Tel&eacute;fono</td><td><span class="dato">' . $fila['telefono_empresa'] . '</span></td>' .
//            '<tr><td>Email para Clientes</td><td><span class="dato">' . $fila['email_empresa'] . '</span></td>' .
//            '<tr><td>Direcci&oacute;n</td><td><span class="dato">' . $fila['direccion_empresa'] . '</span></td>' .
//            '<tr><td><div id="map-canvas"></div></td></tr></table>';

    $str = '<input type=hidden id="localizacion" value="' . $fila['direccion_empresa'] . '"/>' .
            '<div class="w3-container w3-half">' . $fila['nombre_empresa'] . '</div>' .
            '<div class="w3-container w3-half">NIF: ' . $fila['nif_empresa'] . '</div>' .
            '<div class="w3-container w3-half">Correo Electr&oacute;nico: ' . $fila['email_empresa'] . '</div>' .
            '<div class="w3-container w3-half">Tel&eacute;fono: ' . $fila['telefono_empresa'] . '</div>' .
            '<div class="w3-container w3-half">' . $fila['direccion_empresa'] . '</div>' .
            '<div class="w3-container w3-half">' . $arrayComunidades[$fila['nombre_ca']] . '</div>' .
            '<div class="w3-container">' . $fila['web_empresa'] . '</div>' .
            '<div id="map-canvas"></div>';

    return $str;
}

?>