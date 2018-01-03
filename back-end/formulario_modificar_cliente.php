<?php

    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';

    $correo = $_SESSION['cuenta'];

    //Primero traemos los datos del cliente de la DB
    $sql = "SELECT * FROM CUENTA,CLIENTE WHERE CUENTA.CORREO='$correo' AND CLIENTE.CORREO='$correo'";

    $resultado = realizarQuery('grupon', $sql);
    $fila = mysqli_fetch_array($resultado);

    $nombre = $fila['nombre_cliente'];
    $apellidos = $fila['apellidos_cliente'];
    $ca = $fila['nombre_ca'];

    //Después obtengo los datos de sus afinidades.
    $sql = "SELECT * FROM AFINIDADES WHERE CORREO='$correo'";
    $resultado = realizarQuery('grupon', $sql);
    while ($fila = mysqli_fetch_array($resultado)) {
        $afinidades[] = $fila['categoria'];
    }

    if (isset($_POST['cambiarDatos'])) {
        if (!isset($_POST["correo"])) {
            $error[] = "Debes introducir correo";
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
    } else if (isset($_POST['cambiarPwd'])) {

    }
    
    if(isset($error)){
        muestraErrores($error);
    }
    echo muestraFormularioDatos($correo, $ca, $nombre, $apellidos, $afinidades);
    echo muestraFormularioPwd();

    function muestraFormularioDatos($correo, $ca, $nombre, $apellidos, $afinidades) {
        $form = '<form action="" method="post">' .
                'Correo: <input type="text" name="correo" value="' . $correo . '"/><br/>' .
                'Nombre: <input type="text" name="nombre_cliente" value="' . $nombre . '"/><br/>' .
                'Apellidos: <input type="text" name="apellidos_cliente" value"' . $apellidos . '"/> <br/>' .
                'Comunidad Aut&oacute;noma: <select name="comunidad_autonoma" value="' . $ca . '">' .
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
        '<br>' .
                'Afinidades:<br/>';
        if (in_array('viajes', $afinidades)) {
            $form .= 'Viajes: <input type="checkbox" name="viajes" value="viajes" checked/><br/>';
        } else {
            $form .= 'Viajes: <input type="checkbox" name="viajes" value="viajes"/><br/>';
        }
        if (in_array('entretenimiento', $afinidades)) {
            $form .= 'Entretenimiento: <input type="checkbox" name="entretenimiento" value="entretenimiento" checked/><br/>';
        } else {
            $form .= 'Entretenimiento: <input type="checkbox" name="entretenimiento" value="entretenimiento"/><br/>';
        }
        if (in_array('gastronomia', $afinidades)) {
            $form .= 'Gastronom&iacute;a: <input type="checkbox" name="gastronomia" value="gastronomia" checked/><br/>';
        } else {
            $form .= 'Gastronom&iacute;a: <input type="checkbox" name="gastronomia" value="gastronomia" /><br/>';
        }
        if (in_array('electronica', $afinidades)) {
            $form .= 'Electr&oacute;nica: <input type="checkbox" name="electronica" value="electronica" checked/><br/>';
        } else {
            $form .= 'Electr&oacute;nica: <input type="checkbox" name="electronica" value="electronica" /><br/>';
        }
        if (in_array('ropa', $afinidades)) {
            $form .= 'Ropa: <input type="checkbox" name="ropa" value="ropa" checked /><br/>';
        } else {
            $form .= 'Ropa: <input type="checkbox" name="ropa" value="ropa" /><br/>';
        }
        if (in_array('salud_belleza')) {
            $form .= 'Salud y belleza: <input type="checkbox" name="salud_belleza" value="salud_belleza" checked /><br/>';
        } else {
            $form .= 'Salud y belleza: <input type="checkbox" name="salud_belleza" value="salud_belleza"/><br/>';
        }
        if (in_array('deporte', $afinidades)) {
            $form .= 'Deporte: <input type="checkbox" name="deporte" value="deporte" checked/><br/>';
        } else {
            $form .= 'Deporte: <input type="checkbox" name="deporte" value="deporte"/><br/>';
        }
        $form .= $recaptcha .
                '<input type="submit" name="cambiarDatos" value="Guardar"/>' .
                '</form>';
        return $form;
    }

    function muestraFormularioPwd() {
        $form = '<form action="" method="post">' .
                'Contrase&ntilde;a antigua: <input type="password" name="pwd_old"/><br/>' .
                'Nueva contrase&ntilde;a: <input type="password" name="pwd_new" /><br/>' .
                'Confirmar nueva contrase&ntilde;a: <input type="password" name="pwd_new_confirm" /><br/>' .
                '<input type="submit" name="cambiarPwd" value="Guardar cambios"/>' .
                '</form>';
        return $form;
    }

?>