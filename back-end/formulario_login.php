<?php
session_start();
require_once '../back-end/libs/recaptchalib.php';
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

if (isset($_POST['login'])) {
    if (!isset($_POST['correo'])) {
        $error[] = "Debes introducir correo.";
    }
    if (!isset($_POST['pwd'])) {
        $error[] = "Debes introducir contrase&ntilde;a.";
    }
    if (!preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $_POST['correo'])) {
        $error[] = "Correo electr&oacute;nico incorrecto.";
    }
    if (!isset($_POST['g-recaptcha-response'])) {
        $error[] = 'Has trampeado el reCaptcha';
    }
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
    if (!isset($error)) {
        $correo = sanitarString($_POST['correo']);
        $pwd = $_POST['pwd'];
        $query = "SELECT * FROM CUENTA WHERE CORREO='$correo'";
        $result = realizarQuery($esquema, $query);
        $fila = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) > 0 && password_verify($pwd, $fila['pwd'])) {
            $_SESSION['cuenta'] = $fila['correo'];
            $queryEmpresa = "SELECT * FROM CUENTA,EMPRESA WHERE CUENTA.CORREO='$correo' AND EMPRESA.CORREO='$correo'";
            $queryCliente = "SELECT * FROM CUENTA,CLIENTE WHERE CUENTA.CORREO='$correo' AND CLIENTE.CORREO='$correo'";
            $resultadoEmpresa = realizarQuery($esquema, $queryEmpresa);
            $resultadoCliente = realizarQuery($esquema, $queryCliente);
            if(mysqli_num_rows($resultadoEmpresa) > 0){
                $_SESSION['tipo'] = 'empresa';
                $fila = mysqli_fetch_array($resultadoEmpresa);
                $_SESSION['nombre'] = $fila['nombre_empresa'];
            }else{
                $_SESSION['tipo'] = 'cliente';
                $fila = mysqli_fetch_array($resultadoCliente);
                $_SESSION['nombre'] = $fila['nombre_cliente'];
            }
            header('Location: seleccion_accion.php');
        } else {
            $error[] = "Credenciales incorrectas.";
        }
    }
}if (!isset($_POST['login']) || isset($error)) {
    if (isset($error)) {
        echo muestraErrores($error);
    }
    echo formularioLogin();
}

/**
 * Esta funcion genera un login en forma de string
 * @return string
 */
function formularioLogin() {

    global $recaptcha;

    $form = ' <form action="" method="post">' .
            ' Correo: <input type="text" name="correo" /><br/>' .
            ' Contrase&ntilde;a: <input type="password" name="pwd" /><br/>' .
            $recaptcha .
            ' <input type="submit" name="login" value="Enviar"/>' .
            ' </form>';
    return $form;
}

?>
