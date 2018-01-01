<?php
    require_once '../back-end/libs/recaptchalib.php';
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';
    
    if(isset($_POST['registroCliente'])){
        
    }else{
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