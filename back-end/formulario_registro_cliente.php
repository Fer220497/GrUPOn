<?php

require_once '../back-end/libs/recaptchalib.php';
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';
//Si el usuario ha enviado

foreach ($arrayComunidades as $comunidad) {
    $sql = 'SELECT * FROM COMUNIDAD_AUTONOMA';
    $result = realizarQuery('grupon', $sql);
    if (mysqli_num_rows($result) != count($arrayComunidades)) {
        $sql = "INSERT INTO COMUNIDAD_AUTONOMA VALUES ('$comunidad')";
        realizarQuery('grupon', $sql);
    }
}
foreach ($arrayCategorias as $categoria) {
    $sql = 'SELECT * FROM CATEGORIA';
    $result = realizarQuery('grupon', $sql);
    if (mysqli_num_rows($result) != count($arrayCategorias)) {
        $sql = "INSERT INTO CATEGORIA VALUES ('$categoria')";
        realizarQuery('grupon', $sql);
    }
}

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
    if (!in_array($_POST['comunidad_autonoma'], $arrayComunidades)) {
        $error[] = 'Has trampeado las comunidades aut&oacute;nomas, campe&oacute;n';
    }
    //RESTRICCIONES Para evitar el cambio de afinidad
    
    $contador = 0;
    foreach ($arrayCategorias as $categoria) {
        if (isset($_POST[$categoria])) {
            if (!in_array($_POST[$categoria], $arrayCategorias)) {
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
    //Checkeo entradas correctas
    //DepuracionEntradas

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
            $sql = "INSERT INTO CUENTA VALUES('" . $correo . "','" . $comunidad . "','" . $hash . "')";
            realizarQuery("grupon", $sql);
            $sql = "INSERT INTO CLIENTE VALUES('" . $correo . "','" . $nombre_cliente . "','" . $apellidos_cliente . "')";
            realizarQuery("grupon", $sql);
            foreach ($arrayCategorias as $categoria) {
                if (isset($_POST[$categoria])) {
                    $sql = "INSERT INTO AFINIDADES VALUES ('$correo','$categoria')";
                    realizarQuery('grupon', $sql);
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

    $form = '<form action="" method="post">' .
            'Correo: <input type="text" name="correo" /><br/>' .
            'Contrase&ntilde;a: <input type="password" name="pwd"/><br/>' .
            'Confirmar Contraseña: <input type="password" name="pwd_confirmar" /><br/>' .
            'Nombre: <input type="text" name="nombre_cliente"/><br/>' .
            'Apellidos: <input type="text" name="apellidos_cliente"/> <br/>' .
            'Comunidad Aut&oacute;noma: <select name="comunidad_autonoma">' .
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
            'Afinidades:<br/>' .
            'Viajes: <input type="checkbox" name="viajes" value="viajes"/><br/>' .
            'Entretenimiento: <input type="checkbox" name="entretenimiento" value="entretenimiento"/><br/>' .
            'Gastronom&iacute;a: <input type="checkbox" name="gastronomia" value="gastronomia" /><br/>' .
            'Electr&oacute;nica: <input type="checkbox" name="electronica" value="electronica" /><br/>' .
            'Ropa: <input type="checkbox" name="ropa" value="ropa" /><br/>' .
            'Salud y belleza: <input type="checkbox" name="salud_belleza" value="salud_belleza"/><br/>' .
            'Deporte: <input type="checkbox" name="deporte" value="deporte"/><br/>' .
            $recaptcha .
            '<input type="submit" name="registroCliente" value="Enviar"/>' .
            '</form>';
    return $form;
}

?>