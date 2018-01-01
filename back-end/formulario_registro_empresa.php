<?php
    require_once '../back-end/libs/recaptchalib.php';
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';
    
    //Si el usuario ha enviado...
    if(isset($_POST['registroEmpresa'])){
        //Checkeo de que no hayan tocado el HTML
        if(!isset($_POST['correo'])){
            $error[] = 'Debes introducir correo';
        }
        if(!isset($_POST['pwd'])){
            $error[] = 'Debes introducir contrase&ntilde;a';
        }
        if(!isset($_POST['pwd_confirmar'])){
            $error[] = 'Debes introducir la confirmacion de la contrase&ntilde;a';
        }
        if(!isset($_POST['nif_empresa'])){
            $error[] = 'Debes introducir el NIF de la empresa';
        }
        if(!isset($_POST['web_empresa'])){
            $error[] = 'Debes introducir la web de la empresa';
        }
        if(!isset($_POST['web_empresa'])){
            $error[] = 'Debes introducir la web de la empresa';
        }
        if(!isset($_POST['cuenta_bancaria'])){
            $error[] = 'Debes introducir la cuenta bancaria';
        }
        if(!isset($_POST['telefono_empresa'])){
            $error[] = 'Debes introducir el tel&eacute;fono de la empresa';
        }
        if(!isset($_POST['mail_empresa'])){
            $error[] = 'Debes introducir el email de la empresa';
        }
        if(!isset($_POST['web_empresa'])){
            $error[] = 'Debes introducir la web de la empresa';
        }
        if(!isset($_POST['comunidad_autonoma'])){
            $error[] = 'Debes introducir la comunidad aut&oacute;noma';
        }
        //RESTRICCION: Check de que las comunidades autonomas estén bien
        if(!in_array($_POST['comunidad_autonoma'], $arrayComunidades)){
            $error[] = 'Has trampeado las comunidades aut&oacute;nomas, campe&oacute;n';
        }
        //RESTRICCION: Contraseñas deben ser iguales:
        if($_POST['pwd'] !== $_POST['pwd_confirmar']){
            $error[] = 'Las contrase&ntilde;as no coinciden';
        }
        //Checkeo de entradas correctas
        //Depuracion de entradas (sanitize)
        if(!isset($error)){
            $correo = $_POST['correo'];
            $pwd = $_POST['pwd'];
            $nombre_empresa = $_POST['nombre_empresa'];
            $nif_empresa = $_POST['nif_empresa'];
            $web_empresa = $_POST['web_empresa'];
            $cuenta_bancaria = $_POST['cuenta_bancaria'];
            $telefono_empresa = $_POST['telefono_empresa'];
            $mail_empresa = $_POST['mail_empresa'];
            $comunidad_autonoma = $_POST['comunidad_autonoma'];
            $sql = "SELECT * FROM CUENTA WHERE CORREO='$correo'";
            $result = realizarQuery('grupon', $sql);
            if(mysqli_num_row($result) > 0){
                $error[] = 'Ya exist&iacute;a ese correo.';
            }
            
        }
    }
    
    //Si el usuario no ha enviado el formulario o existe el error
    if(!isset($_POST['registroEmpresa']) || isset($error)){
        if(isset($error)){
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

        $form = '<form action="../back-end/tratamiento_formulario_registro_empresa.php" method="post">' .
                'Correo: <input type="text" name="correo"/ ><br/>' .
                'Contrase&ntilde;a: <input type="password" name="pwd" /><br/>' .
                'Confirmar Contrase&ntilde;a: <input type="password" name="pwd_confirmar"/ ><br/>' .
                'Nombre Empresa: <input type="text" name="nombre_empresa"/><br/>' .
                'NIF : <input type="text" name="nif_empresa"/><br/>' .
                'Web Empresa: <input type="text" name="web_empresa" /> <br/>' .
                'Cuenta Bancaria: <input type="number" name="cuenta_bancaria"/ ><br/>' .
                'Tel&eacute;fono: <input type="number" name="telefono_empresa"/><br/>' .
                'Correo Electr&oacute;nico: <input type="email" name="mail_empresa"/> <br/>' .
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
                $recaptcha .
                '<input type="submit" name="registroEmpresa" value="Enviar"/>' .
                '</form>';
        return $form;
    }

?>

