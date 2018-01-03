<?php
    require_once '../back-end/conexion_db';
    
    /**
     * Función que checkea si existe un correo que se le pase ya en la DB.
     * @param type $correo
     * @return boolean
     */
    function existeCorreo($correo){
        $sql = "SELECT * FROM CUENTA WHERE CORREO='" . $correo . "'";
        $result = realizarQuery("grupon", $sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        }else{
            return false;
        }
    }
    
    $arrayComunidades[] = "andalucia";
    $arrayComunidades[] = "catalunya";
    $arrayComunidades[] = "galicia";
    $arrayComunidades[] = "castillo_y_leon";
    $arrayComunidades[] = "pais_vasco";
    $arrayComunidades[] = "canarias";
    $arrayComunidades[] = "valencia";
    $arrayComunidades[] = "madrid";
    $arrayComunidades[] = "castilla_la_mancha";
    $arrayComunidades[] = "murcia";
    $arrayComunidades[] = "aragon";
    $arrayComunidades[] = "islas_baleares";
    $arrayComunidades[] = "extremadura";
    $arrayComunidades[] = "asturias";
    $arrayComunidades[] = "navarra";
    $arrayComunidades[] = "cantabria";
    $arrayComunidades[] = "la_rioja";
    $arrayComunidades[] = "melilla";
    $arrayComunidades[] = "ceuta";
    
    $arrayCategorias[] = "viajes";
    $arrayCategorias[] = "entretenimiento";
    $arrayCategorias[] = "gastronomia";
    $arrayCategorias[] = "electronica";
    $arrayCategorias[] = "ropa";
    $arrayCategorias[] = "salud_y_belleza";
    $arrayCategorias[] = "deporte";
    
    $selectComunidadesAutonomas = '<select name="comunidad_autonoma">' .
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
            '</select>';
    
    
    //Hay que cambiar la KEY ya que esta es de prueba.
    $recaptcha = '<div data-theme="dark" class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>';
    //KEY secreta del Recaptcha 
    $secret = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';

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
?>