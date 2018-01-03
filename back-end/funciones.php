<?php
    require_once '../back-end/conexion_db.php';
    
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
    
    $arrayComunidades = array(
    "andalucia" => "Andalucia",
    "aragon" => "Arag&oacute;n",
    "asturias" => "Asturias",
    "canarias" => "Canarias",
    "cantabria" => "Cantabria",
    "castilla_la_mancha" => "Castilla La Mancha",
    "castillo_y_leon" => "Castilla y Le&oacute;n",
    "catalunya" => "Catalu&ntilde;a",
    "ceuta" => "Ceuta",
    "extremadura" => "Extremadura",
    "galicia" => "Galicia",
    "islas_baleares" => "Islas Baleares",
    "la_rioja" => "La Rioja",
    "madrid" => "Madrid",
    "melilla" => "Melilla",
    "murcia" => "Murcia",
    "navarra" => "Navarra",
    "pais_vasco" => "Pa&iacute;s Vasco",
    "valencia" => "Valencia",
    );
    
    $arrayCategorias = array(
       "viajes" => "Viajes",
       "entretenimiento" => "Entretenimiento",
       "gastronomia" => "Gastronom&iacute;a",
       "electronica" => "Electr&oacute;nica",
       "ropa" => "Ropa",
       "salud_y_belleza" => "Salud y belleza",
       "deporte" => "Deporte",
    );
    
    /**
     * Función que genera options con las comunidades autonomas
     */
    function opcionesComunidades(){
        global $arrayComunidades;
        $opt = '';
        foreach($arrayComunidades as $key=>$val){
            $opt .= '<option value="'.$key.'">'.$val.'</option>';
        }
        return $opt;
    }
    /**
     * Función que genera options con las comunidades autonomas y una seleccionada.
     * @param type $comunidadAutonoma
     */
    function opcionesComunidadSeleccionada($comunidadAutonoma){
        global $arrayComunidades;
        $opt = '';
        foreach($arrayComunidades as $key=>$val){
            if($comunidadAutonoma == $key){
                $opt .= '<option value="'.$key.'" selected="selected">'.$val.'</option>';
            }else{
                $opt .= '<option value="'.$key.'">'.$val.'</option>';
            }
        }
        return $opt;
    }
    
    function checkboxesCategorias(){
        global $arrayCategorias;
        $form .= '';
        foreach($arrayCategorias as $key=>$val){
            $form .= $value .': <input type="checkbox" name="'.$key.'" value="'.$key.'"/><br/>';
        }
        return $form;
    }
    
    function checkboxesCategoriasSeleccionadas($afinidades){
        global $arrayCategorias;
        $form = '';
        foreach($arrayCategorias as $key=>$val){
            if(in_array($key, $afinidades)){
                $form .= $val .': <input type="checkbox" name="'.$key.'" value="'.$key.'" checked/><br/>';
            }else{
                $form .= $val .': <input type="checkbox" name="'.$key.'" value="'.$key.'"/><br/>';
            }
        }
        return $form;
    }
    
    function optionCategorias(){
        global $arrayCategorias;
        $form = '';
        foreach($arrayCategorias as $key=>$val){
            $form .= '<option value="'.$key.'" selected="selected">'.$val.'</option>';
        }
        return $form;
    }
    
    function optionCategoriasSeleccionadas($cat){
        global $arrayCategorias;
        $opt = '';
        foreach($arrayCategorias as $key=>$val){
            if($cat == $key){
                $opt .= '<option value="'.$key.'" selected="selected">'.$val.'</option>';
            }else{
                $opt .= '<option value="'.$key.'">'.$val.'</option>';
            }
        }
        return $opt;
    }

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
    
    function inicializarDB() {
    global $arrayCategorias;
    global $arrayComunidades;
    foreach ($arrayComunidades as $key => $val) {
        $sql = 'SELECT * FROM COMUNIDAD_AUTONOMA';
        $result = realizarQuery('grupon', $sql);
        if (mysqli_num_rows($result) != count($arrayComunidades)) {
            $sql = "INSERT INTO COMUNIDAD_AUTONOMA VALUES ('$key')";
            realizarQuery('grupon', $sql);
        }
    }
    foreach ($arrayCategorias as $key => $val) {
        $sql = 'SELECT * FROM CATEGORIA';
        $result = realizarQuery('grupon', $sql);
        if (mysqli_num_rows($result) != count($arrayCategorias)) {
            $sql = "INSERT INTO CATEGORIA VALUES ('$key')";
            realizarQuery('grupon', $sql);
        }
    }
}
?>