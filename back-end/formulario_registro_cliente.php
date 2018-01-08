<?php

require_once '../back-end/libs/recaptchalib.php';
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';
//Si el usuario ha enviado

if (isset($_POST['registroCliente'])) {
    //Comprobacion del captcha
    if (!isset($_POST['g-recaptcha-response'])) {
        $error[] = 'Has trampeado el reCaptcha';
    }
    if (!isset($_POST["correo"])) {
        $error[] = "Debes introducir correo";
    }
    if (!isset($_POST["pwd"])) {
        $error[] = "Debes introducir una contrase&ntilde;a";
    }
    if (!isset($_POST["pwd_confirmar"])) {
        $error[] = "Debes introducir la confirmacion de la contrase&ntilde;a";
    }
    if (!isset($_POST["nombre_cliente"])) {
        $error[] = "Debes introducir un nombre";
    }
    if (!isset($_POST["apellidos_cliente"])) {
        $error[] = "Debes introducir los apellidos";
    }
    if (!isset($_POST["comunidad_autonoma"])) {
        $error[] = "Debes introducir una comunidad aut&oacute;noma";
    }

    //RESTRICCION: Para evitar el cambio de una comunidad autonoma
    if (!array_key_exists($_POST['comunidad_autonoma'], $arrayComunidades)) {
        $error[] = 'Has trampeado las comunidades aut&oacute;nomas, campe&oacute;n';
    }

    //RESTRICCIONES Para evitar el cambio de afinidad
    $contador = 0;
    foreach ($arrayCategorias as $categoria => $val) {
        if (isset($_POST[$categoria])) {
            if (!array_key_exists($_POST[$categoria], $arrayCategorias)) {
                $error[] = "No existe la categoria";
            } else {
                $contador++;
            }
        }
    }
    if ($contador == 0) {
        $error[] = "Tiene que seleccionar una categoria";
    }
    if ($_POST['pwd'] !== $_POST['pwd_confirmar']) {
        $error[] = 'Las contrase&ntilde;as no coinciden';
    }

    //RESTRICCION: Captcha funcionando:
    $response = null;
    $recap = new ReCaptcha($secret);
    if ($_POST["g-recaptcha-response"]) {
        $response = $recap->verifyResponse(
                $_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]
        );
        if ($response == null && !$response->success) {
            $error[] = 'BOT DETECTADO.';
        }
    }

    if (trim($_POST['correo']) == '' || strlen($_POST['correo']) > $tamCorreo) {
        $error[] = 'Correo de cuenta no cumple criterios de tama&ntilde;o';
    }
    if (trim($_POST['nombre_cliente']) == '' || strlen($_POST['nombre_cliente']) > $tamNombreCliente) {
        $error[] = 'Nombre de cliente no cumple criterios de tama&ntilde;o';
    }
    if (trim($_POST['apellidos_cliente']) == '' || strlen($_POST['apellidos_cliente']) > $tamApellidosCliente) {
        $error[] = 'Apellidos de cliente no cumple criterios de tama&ntilde;o';
    }
    if (trim($_POST['pwd']) == '') {
        $error[] = 'Contrase&ntilde;a no cumple criterios de tama&ntilde;o';
    }
    
    //Checkeo de entradas correctas
    $filtros = array(
        "correo" => FILTER_VALIDATE_EMAIL
    );
    $result = filter_input_array(INPUT_POST, $filtros);
    if(!$result['correo']){
        $error[] = 'El correo no tiene el formato adecuado';
    }else{
        $error[] = 'No has checkeado el reCaptcha';
    }

    if (!isset($error)) {
        $correo = sanitarString($_POST["correo"]);
        $pwd = sanitarString($_POST["pwd"]);
        $nombre_cliente = sanitarString($_POST["nombre_cliente"]);
        $apellidos_cliente = sanitarString($_POST["apellidos_cliente"]);
        $comunidad = sanitarString($_POST["comunidad_autonoma"]);
        if (existeCorreo($correo)) {
            $error[] = "Ya existe este correo";
        } else {
            $hash = password_hash($pwd, PASSWORD_BCRYPT);
            $sql = "INSERT INTO CUENTA VALUES('" . $correo . "', '" . $comunidad . "', '" . $hash . "')";
            realizarQuery("grupon", $sql);
            $sql = "INSERT INTO CLIENTE VALUES('" . $correo . "', '" . $nombre_cliente . "', '" . $apellidos_cliente . "')";
            realizarQuery("grupon", $sql);
            foreach ($arrayCategorias as $categoria => $val) {
                if (isset($_POST[$categoria])) {
                    $sql = "INSERT INTO AFINIDADES VALUES ('$correo', '$categoria')";
                    realizarQuery($esquema, $sql);
                }
            }
            //Finalmente redirigimos al usuario
            header('Location: login.php');
        }
    }
}

if (!isset($_POST["registroCliente"]) || isset($error)) {
    if (isset($error)) {
        echo muestraErrores($error);
    }

    echo formularioRegistroCliente();
}

/*
 * Esta funcion genera un formulario para que los clientes puedan registrarse en forma de string
 */

function formularioRegistroCliente() {

    global $recaptcha;
    global $selectComunidadAutonoma;
    $form = '<form action="" method="post">' .
            'Correo: <input type="text" name="correo" /><br/>' .
            'Contrase&ntilde;a: <input type="password" name="pwd"/><br/>' .
            'Confirmar Contraseña: <input type="password" name="pwd_confirmar" /><br/>' .
            'Nombre: <input type="text" name="nombre_cliente"/><br/>' .
            'Apellidos: <input type="text" name="apellidos_cliente"/> <br/>' .
            'Comunidad Aut&oacute;noma: <select name="comunidad_autonoma">' . opcionesComunidades() . '</select><br>' .
            'Afinidades:<br/>' . checkboxesCategorias() . '<br/>' .
            $recaptcha .
            '<input type="submit" name="registroCliente" value="Enviar"/>' .
            '</form>';
    return $form;
}

?>