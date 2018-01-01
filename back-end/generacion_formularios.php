<?php

//Hay que cambiar la KEY ya que esta es de prueba.
$recaptcha = '<div data-theme="dark" class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>';

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

/**
 * Esta funcion genera un login en forma de string
 * @return string
 */
function formularioLogin() {

    $form = ' <form action="" method="post">' .
            ' Correo: <input type="text" name="correo" /><br/>' .
            ' Contrase&ntilde;a: <input type="password" name="pwd" /><br/>' .
            $recaptcha .
            ' <input type="submit" name="login" value="Enviar"/>' .
            ' </form>';
    return $form;
}

/*
 * Esta funcion genera un formulario para que las empresas puedan registrarse en forma de string
 * @return string
 */
function formularioRegistroEmpresa() {

    $form = '<form action="" method="post">' .
            'Correo: <input type="text" name="correo"/ ><br/>' .
            'Contrase&ntilde;a: <input type="password" name="pwd" /><br/>' .
            'Confirmar Contrase&ntilde;a: <input type="password" name="pwd_confirmar"/ ><br/>' .
            'Nombre Empresa: <input type="text" name="nombre_empresa"/><br/>' .
            'NIF : <input type="text" name="nif_empresa"/><br/>' .
            'Web Empresa: <input type="text" name="web_empresa" /> <br/>' .
            'Cuenta Bancaria: <input type="number" name="cuenta_bancaria"/ ><br/>' .
            'Tel&eacute;fono: <input type="number" name="telefono_empresa"/><br/>' .
            'Correo Electr&oacute;nico: <input type="email" name="mail_empresa"/> <br/>' .
            'Comunidad Aut&oacute;noma: <select>' .
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
            $recaptcha .
            '<input type="submit" name="registroEmpresa" value="Enviar"/>' .
            '</form>';
    return $form;
}


/*
 * Esta funcion genera un formulario para que los clientes puedan registrarse en forma de string
 */
function formularioRegistroCliente() {

    $form = '<form action="" method="post">' .
            'Correo: <input type="text" name="correo" /><br/>' .
            'Contrase&ntilde;a: <input type="password" name="pwd"/><br/>' .
            'Confirmar Contraseña: <input type="password" name="contraseña_confirmar" /><br/>' .
            'Nombre: <input type="text" name="nombre_cliente"/><br/>' .
            'Apellidos: <input type="text" name="apellidos_cliente"/> <br/>'.
            'Comunidad Aut&oacute;noma: <select>' .
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
            $recaptcha . 
            '<input type="submit" name="registroCliente" value="Enviar"/>' .
            '</form>';
    return $form;
}

?>