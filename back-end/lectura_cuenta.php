<?php

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

if (isset($_SESSION['cuenta'])) {
    $correo = $_SESSION['cuenta'];
}

/**
 * Muestra los datos de una cuenta
 * @return string
 */
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
        $string = muestraDatosEmpresaMapa($correo);
    }
    return $string;
}

/**
 * Muestra los datos del cliente.
 * @param type $arrayClientes
 * @return 
 */
function muestraDatosCliente($fila) {
    global $arrayComunidades;
    return '<div class="w3-container w3-half">Nombre: ' . $fila['nombre_cliente'] . '</div>' .
            '<div class="w3-container w3-half">Apellidos: ' . $fila['apellidos_cliente'] . '</div>' .
            '<div class="w3-container w3-half">Correo Electr&oacute;nico: ' . $fila['correo'] . '</div>' .
            '<div class="w3-container w3-half">Comunidad Aut&oacute;noma: ' . $arrayComunidades[$fila['nombre_ca']] . '</div>';
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

    $str = '<input type=hidden id="localizacion" value="' . $fila['direccion_empresa'] . '"/>' .
            '<div class="w3-container w3-half"><h1>' . $fila['nombre_empresa'] . '</h1></div><div style="width:100%; clear:both;"></div>' .
            '<div class="w3-container w3-half">NIF: ' . $fila['nif_empresa'] . '</div>' .
            '<div class="w3-container w3-half">Correo Electr&oacute;nico: ' . $fila['email_empresa'] . '</div>' .
            '<div class="w3-container w3-half">Tel&eacute;fono: ' . $fila['telefono_empresa'] . '</div>' .
            '<div class="w3-container w3-half">Direcci&oacute;n: ' . $fila['direccion_empresa'] . '</div>' .
            '<div class="w3-container w3-half">Comunidad Aut&oacute;noma: ' . $arrayComunidades[$fila['nombre_ca']] . '</div>' .
            '<div class="w3-container">Web: <a class="linkEmpresa" href="'. $fila['web_empresa'] . '">' . $fila['web_empresa'] . '</a></div><div style="width:100%; clear:both;"></div>' .
            '<br/><div class="w3-container w3-card" id="map-canvas"></div><div style="width:100%; clear:both;"></div></div>';

    return $str;
}

?>