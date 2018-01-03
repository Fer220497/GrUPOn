<?php

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

echo $_SESSION['cuenta'];
if (!isset($_SESSION)) {
    echo 'desdefinida';
}
$correo = $_SESSION['cuenta'];

if (isset($_POST['modificarEmpresa'])) {


    if (!isset($_POST['correo'])) {
        $error[] = 'Debes introducir correo';
    }
    if (!isset($_POST['nombre_empresa'])) {
        $error[] = 'Debes introducir el nombre de la empresa';
    }
    if (!isset($_POST['nif_empresa'])) {
        $error[] = 'Debes introducir el NIF de la empresa';
    }
    if (!isset($_POST['web_empresa'])) {
        $error[] = 'Debes introducir la web de la empresa';
    }
    if (!isset($_POST['web_empresa'])) {
        $error[] = 'Debes introducir la web de la empresa';
    }
    if (!isset($_POST['cuenta_bancaria'])) {
        $error[] = 'Debes introducir la cuenta bancaria';
    }
    if (!isset($_POST['telefono_empresa'])) {
        $error[] = 'Debes introducir el tel&eacute;fono de la empresa';
    }
    if (!isset($_POST['mail_empresa'])) {
        $error[] = 'Debes introducir el email de la empresa';
    }
    if (!isset($_POST['web_empresa'])) {
        $error[] = 'Debes introducir la web de la empresa';
    }
    if (!isset($_POST['comunidad_autonoma'])) {
        $error[] = 'Debes introducir la comunidad aut&oacute;noma';
    }
    if (!isset($_POST['direccion_empresa'])) {
        $error[] = 'Debes introducir una direcci&oacute;n de empresa.';
    }
    //RESTRICCION: Check de que las comunidades autonomas estén bien
    if (!in_array($_POST['comunidad_autonoma'], $arrayComunidades)) {
        $error[] = 'Has trampeado las comunidades aut&oacute;nomas, campe&oacute;n';
    }

    //RESTRICCION: SI EL CORREO INTRODUCIDO ES NUEVO, DEBE CHECKEARSE QUE NO EXISTA YA.
    if ($correo !== $_POST['correo']) {
        if (existeCorreo($_POST['correo'])) {
            $error[] = 'Ese correo ya existe';
        }
    }
    if (!isset($error)) {

        $correonuevo = sanitarString($_POST['correo']);

        $nombre_empresa = sanitarString($_POST['nombre_empresa']);
        $nif_empresa = sanitarString($_POST['nif_empresa']);
        $web_empresa = sanitarString($_POST['web_empresa']);
        $cuenta_bancaria = $_POST['cuenta_bancaria'];
        $telefono_empresa = $_POST['telefono_empresa'];
        $mail_empresa = sanitarString($_POST['mail_empresa']);
        $comunidad_autonoma = $_POST['comunidad_autonoma'];
        $direccion_empresa = sanitarString($_POST['direccion_empresa']);



        $sql = "UPDATE CUENTA SET CORREO='$correonuevo', NOMBRE_CA='$comunidad_autonoma' WHERE CORREO='$correo'";

        realizarQuery('grupon', $sql);
        $sql = "UPDATE EMPRESA SET nombre_empresa='$nombre_empresa', direccion_empresa='$direccion_empresa', "
                . "nif_empresa='$nif_empresa', web_empresa='$web_empresa', cuenta_bancaria='$cuenta_bancaria', "
                . "telefono_empresa='$telefono_empresa', email_empresa='$mail_empresa' WHERE correo='$correonuevo'";
        realizarQuery('grupon', $sql);
        $_SESSION['cuenta'] = $correonuevo;
        $_SESSION['nombre'] = $nombre_empresa;
        header('Location: modificar_cuenta_empresa.php');
    }
}

if (isset($_POST['cambioContrasenya'])) {
    if (!isset($_POST['pwd_antigua'])) {
        $error[] = 'Debes introducir contrase&ntilde;a';
    }
    if (!isset($_POST['pwd'])) {
        $error[] = 'Debes introducir contrase&ntilde;a';
    }
    if (!isset($_POST['pwd_confirmar'])) {
        $error[] = 'Debes introducir la confirmacion de la contrase&ntilde;a';
    }
    //RESTRICCION: Contraseña antigua debe ser correcta
    $sql = "SELECT * FROM CUENTA WHERE CORREO='$correo'";
    $result = realizarQuery("grupon", $sql);
    $datopwd = mysqli_fetch_array($result);
    $contra = $datopwd["pwd"];
    echo $contra;
    echo $_POST['pwd_antigua'];
    if (!password_verify($_POST['pwd_antigua'], $contra)) {
        $error[] = "La contraseña antigua es incorrecta";
    }
    //RESTRICCION: Contraseñas deben ser iguales:
    if ($_POST['pwd'] != $_POST['pwd_confirmar']) {
        $error[] = 'Las contrase&ntilde;as nuevas no coinciden';
    }
    //A
    //A

    if (!isset($error)) {
        $pwd = $_POST['pwd'];
        $hash = password_hash($pwd, PASSWORD_BCRYPT); //60 chars wide.
        $sql = "UPDATE CUENTA SET PWD='$hash' WHERE CORREO='$correo'";
        realizarQuery('grupon', $sql);
    }
}

if (isset($error)) {
    echo muestraErrores($error);
}
echo formularioModEmpresa();

function formularioModEmpresa() {
    $correo = $_SESSION["cuenta"];
    $sql = "SELECT * FROM EMPRESA,CUENTA WHERE EMPRESA.CORREO='$correo' AND CUENTA.CORREO='$correo'";
    $result = realizarQuery("grupon", $sql);
    $datosempresa = mysqli_fetch_array($result);
    $nombre_empresa = $datosempresa["nombre_empresa"];
    $direccion_empresa = $datosempresa["direccion_empresa"];
    $nif_empresa = $datosempresa["nif_empresa"];
    $web_empresa = $datosempresa["web_empresa"];
    $cuenta_bancaria = $datosempresa["cuenta_bancaria"];
    $telefono_empresa = $datosempresa["telefono_empresa"];
    $email_empresa = $datosempresa["email_empresa"];
    $ca = $datosempresa["nombre_ca"];
    echo $ca;


    $form = '<form action="" method="post">' .
            'Correo: <input type="text" name="correo" value="' . $correo . '"/><br/>' .
            'Nombre Empresa: <input type="text" name="nombre_empresa" value="' . $nombre_empresa . '"/><br/>' .
            'NIF : <input type="text" name="nif_empresa" value="' . $nif_empresa . '"/><br/>' .
            'Web Empresa: <input type="text" name="web_empresa" value="' . $web_empresa . '" /> <br/>' .
            'Cuenta Bancaria: <input type="number" name="cuenta_bancaria" value="' . $cuenta_bancaria . '" /><br/>' .
            'Tel&eacute;fono: <input type="number" name="telefono_empresa" value="' . $telefono_empresa . '"/><br/>' .
            'Correo Electr&oacute;nico: <input type="email" name="mail_empresa" value="' . $email_empresa . '"/> <br/>' .
            'Comunidad Aut&oacute;noma: <select name="comunidad_autonoma" value="'.$ca.'">' .
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
            'Direcci&oacute;n Empresa: <input type="text" name="direccion_empresa" value="' . $direccion_empresa . '" />' .
            '<input type="submit" name="modificarEmpresa" value="Enviar"/>' .
            '</form>' .
            '<form action="" method="post">' .
            'Contrase&ntilde;a Antigua: <input type="password" name="pwd_antigua" /><br/>' .
            'Contrase&ntilde;a Nueva: <input type="password" name="pwd" /><br/>' .
            'Confirmar Contrase&ntilde;a Nueva: <input type="password" name="pwd_confirmar" /><br/>' .
            '<input type="submit" name="cambioContrasenya" value="Enviar"/>' .
            '</form>';

    return $form;
}

?>