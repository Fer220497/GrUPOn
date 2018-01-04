<?php

require_once '../back-end/libs/recaptchalib.php';
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

//Si el usuario ha enviado...
if (isset($_POST['registroEmpresa'])) {
    //Checkeo de que no hayan tocado el HTML
    if(!isset($_POST['nombre_empresa'])){
        $error[] = 'Debes poner el nombre de la empresa';
    }
    if (!isset($_POST['correo'])) {
        $error[] = 'Debes introducir correo';
    }
    if (!isset($_POST['pwd'])) {
        $error[] = 'Debes introducir contrase&ntilde;a';
    }
    if (!isset($_POST['pwd_confirmar'])) {
        $error[] = 'Debes introducir la confirmacion de la contrase&ntilde;a';
    }
    if (!isset($_POST['nif_empresa'])) {
        $error[] = 'Debes introducir el NIF de la empresa';
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
    if (!isset($_POST['comunidad_autonoma'])) {
        $error[] = 'Debes introducir la comunidad aut&oacute;noma';
    }
    if(!isset($_POST['direccion_empresa'])){
        $error[] = 'Debes introducir una direcci&oacute;n de empresa.';
    }
    if (!isset($_POST['g-recaptcha-response'])) {
        $error[] = 'Has trampeado el reCaptcha';
    }
    //RESTRICCION: Check de que las comunidades autonomas estén bien
    if (!array_key_exists($_POST['comunidad_autonoma'], $arrayComunidades)) {
        $error[] = 'Has trampeado las comunidades aut&oacute;nomas, campe&oacute;n';
    }
    //RESTRICCION: Contraseñas deben ser iguales:
    if ($_POST['pwd'] !== $_POST['pwd_confirmar']) {
        $error[] = 'Las contrase&ntilde;as no coinciden';
    }
    //RESTRICCION: QUE NO HAYA COSAS VACIAS:
    if(trim($_POST['nombre_empresa']) == '' || strlen($_POST['nombre_empresa']) > $tamNombreEmpresa){
        $error[] = 'Nombre empresa no cumple criterios de tama&ntilde;o';
    }
    if (trim($_POST['correo']) == ''|| strlen($_POST['correo']) > $tamCorreo) {
        $error[] = 'Correo de cuenta no cumple criterios de tama&ntilde;o';
    }
    if (trim($_POST['pwd']) == '') {
        $error[] = 'Contrase&ntilde;a empresa no cumple criterios de tama&ntilde;o';
    }
    if (trim($_POST['web_empresa']) == '' || strlen($_POST['web_empresa']) > $tamWeb) {
        $error[] = 'Web de la empresa no cumple criterios de tama&ntilde;o';
    }
    if (trim($_POST['mail_empresa']) == '' || strlen($_POST['mail_empresa']) > $tamCorreo) {
        $error[] = 'Mail de contacto de la empresa no cumple criterios de tama&ntilde;o';
    }
    if(trim($_POST['direccion_empresa']) == '' || strlen($_POST['direccion_empresa']) > $tamDireccion){
        $error[] = 'Direcci&oacute;n de la empresa no cumple criterios de tama&ntilde;o';
    }
    //RESTRICCION: Captcha funcionando:
    $response = null;
    $recap = new ReCaptcha($secret);
    if (!isset($error)) {
        $response = $recap->verifyResponse(
                $_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]
        );
        if ($response == null && !$response->success) {
            $error[] = 'BOT DETECTADO.';
        }
    }
    //Checkeo de entradas correctas
    $filtros = array(
        "correo"=>FILTER_VALIDATE_EMAIL,
        "nif_empresa"=>array(
            "filter"=>FILTER_VALIDATE_REGEXP,
            "options"=>array("regexp"=>"/^([A-HJUV]\d{8})|([NP-SW]\d{7}[A-Z])$/")
            ),
        "web_empresa"=>FILTER_VALIDATE_URL,
        "telefono_empresa"=>array(
            "filter"=>FILTER_VALIDATE_REGEXP,
            "options"=>array("regexp"=>"/^\d{9}$/")
            ),
        "cuenta_bancaria"=>array(
            "filter"=>FILTER_VALIDATE_REGEXP,
            "options"=>array("regexp"=>"/^\d{20}$/")
            ),
        "mail_empresa"=>FILTER_VALIDATE_EMAIL
        );
    $result = filter_input_array(INPUT_POST, $filtros);
    if(!$result['correo'] || !$result['mail_empresa']){
        $error[] = 'El correo no tiene el formato adecuado';
    }
    if(!$result['nif_empresa']){
        $error[] = 'El NIF no tiene el formato adecuado';
    }
    if(!$result['web_empresa']){
        $error[] = 'La web no tiene el formato adecuado';
    }
    if(!$result['cuenta_bancaria']){
        $error[] = 'La cuenta bancaria no tiene el formato adecuado';
    }
    if(!$result['telefono_empresa']){
        $error[] = 'El telefono no tiene el formato adecuado';
    }
        
    if (!isset($error)) {
        //Depuracion de entradas (sanitize)
        $correo = sanitarString($_POST['correo']);
        $pwd = sanitarString($_POST['pwd']);
        $nombre_empresa = sanitarString($_POST['nombre_empresa']);
        $nif_empresa = sanitarString($_POST['nif_empresa']);
        $web_empresa = sanitarString($_POST['web_empresa']);
        $cuenta_bancaria = $_POST['cuenta_bancaria'];
        $telefono_empresa = $_POST['telefono_empresa'];
        $mail_empresa = sanitarString($_POST['mail_empresa']);
        $comunidad_autonoma = $_POST['comunidad_autonoma'];
        $direccion_empresa = sanitarString($_POST['direccion_empresa']);

        //Check de si existia ya la cuenta.
        if (existeCorreo($correo)) {
            $error[] = 'Ya exist&iacute;a ese correo.';
        } else {
            //No existe esa cuenta, creo una nueva.
            $hash = password_hash($pwd, PASSWORD_BCRYPT); //60 chars wide.
            $sql = "INSERT INTO CUENTA VALUES('$correo','$comunidad_autonoma', '$hash')";
            realizarQuery('grupon', $sql);
            $sql = "INSERT INTO EMPRESA VALUES('$correo','$nombre_empresa',"
                    . "'$direccion_empresa',$nif_empresa,'$web_empresa',$cuenta_bancaria,"
                    . "$telefono_empresa, '$mail_empresa')";
            realizarQuery('grupon', $sql);
            //Finalmente redirigimos al usuario
            header('Location: login.php');
        }
    }
}

//Si el usuario no ha enviado el formulario o existe el error
if (!isset($_POST['registroEmpresa']) || isset($error)) {
    if (isset($error)) {
        echo muestraErrores($error);
    }
    echo formularioRegistroEmpresa();
}

/*
 * Esta funcion genera un formulario para que las empresas puedan registrarse en forma de string
 * @return string
 */

function formularioRegistroEmpresa() {

    global $recaptcha;
    global $selectComunidadesAutonomas;
    $form = '<form action="../back-end/formulario_registro_empresa.php" method="post">' .
            'Correo: <input type="email" name="correo" required/><br/>' .
            'Contrase&ntilde;a: <input type="password" name="pwd" required/><br/>' .
            'Confirmar Contrase&ntilde;a: <input type="password" name="pwd_confirmar" required/ ><br/>' .
            'Nombre Empresa: <input type="text" name="nombre_empresa" required/><br/>' .
            'NIF: <input type="text" name="nif_empresa" required/><br/>' .
            'Web Empresa: <input type="text" name="web_empresa" required/> <br/>' .
            'Cuenta Bancaria: <input type="number" name="cuenta_bancaria" required/ ><br/>' .
            'Tel&eacute;fono: <input type="number" name="telefono_empresa" required/><br/>' .
            'Correo Electr&oacute;nico: <input type="email" name="mail_empresa" required/> <br/>' .
            'Comunidad Aut&oacute;noma: <select name="comunidad_autonoma">'.opcionesComunidades().'</select><br>' .
            'Direcci&oacute;n Empresa: <input type="text" name="direccion_empresa" required />'.
            $recaptcha .
            '<input type="submit" name="registroEmpresa" value="Enviar"/>' .
            '</form>';
    return $form;
}
?>

