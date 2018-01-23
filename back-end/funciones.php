<?php

require_once '../back-end/conexion_db.php';

/**
 * Un cliente solo puede comentar si:
 * Está loggeado, ha comprado el produto y NO ha comentado.
 * @param type $correo
 * @return string
 */
function puedeComentar($correo, $producto) {
    global $esquema;
    $query = "SELECT * FROM compra WHERE correo='$correo' AND id_producto='$producto'";
    $result = realizarQuery($esquema, $query);
    if (mysqli_num_rows($result) > 0) {   //Ha comprado
        $query = "SELECT * FROM comentarios WHERE correo='$correo' AND id_producto='$producto'";
        $result = realizarQuery($esquema, $query);
        if (mysqli_num_rows($result) > 0) {   //Ha comentado
            return false;
        } else {
            return true;    //No ha comentado
        }
    } else {
        return false;
    }
}

/**
 * Función que devuelve un formulario con un valor numérico para indicar la 
 * valoración de un producto y un campo de texto para dejar un comentario.
 * @return string
 */
function mostrarCajaComentario() {
    $form = '<form method="post" action="">'
            . '<textarea class="w3-input" name="comentario" placeholder="Comenta algo!" maxlength="5000"></textarea>'
            . '<input class="w3-input" type="number" name="valoracion" min="0" max="5" value="3"/>'
            . '<input class="w3-margin w3-btn w3-hover-pale-green w3-border w3-round" type="submit" name="enviado" value="Enviar comentario"/></form>';
    return $form;
}

/**
 * Devuelve todos los comentarios del producto del id dado.
 * @param id $producto
 * @return string
 */
function mostrarComentarios($producto) {
    global $esquema;
    $query = "SELECT * FROM comentarios,cliente WHERE comentarios.correo=cliente.correo AND id_producto='$producto'";
    $result = realizarQuery($esquema, $query);
    if (mysqli_num_rows($result) > 0) {
        $sumaPuntuaciones = 0;
        $str = '<div class="w3-container w3-white w3-border w3-round w3-section"><h1>Comentarios</h1>';
        while ($fila = mysqli_fetch_array($result)) {
            $str .= '<div class="w3-panel w3-light-grey"><span style="font-size:150px;line-height:0.6em;opacity:0.2">❝</span>'
                    . ' <p class="w3-xlarge" style="margin-top:-40px">' . $fila['comentario'] . '</p>'
                    . $fila['nombre_cliente'] . ' ' . $fila['apellidos_cliente'] . ', valoraci&oacute;n: ' . $fila['valoracion'] . '/5</div>';
            $sumaPuntuaciones += $fila['valoracion'];
        }
        $puntuacion = $sumaPuntuaciones / mysqli_num_rows($result);
        if ($puntuacion < 1.6) {
            $htmlPuntuacion = '<div class="w3-panel w3-pale-red w3-leftbar w3-rightbar w3-border-red"><h1>Valoraci&oacute;n media: ' . $puntuacion .
                    '/5</h1></div>';
        } else if ($puntuacion < 3.2) {
            $htmlPuntuacion = '<div class="w3-panel w3-pale-yellow w3-leftbar w3-rightbar w3-border-yellow"><h1>Valoraci&oacute;n media: ' . $puntuacion .
                    '/5</h1></div>';
        } else {
            $htmlPuntuacion = '<div class="w3-panel w3-pale-green w3-leftbar w3-rightbar w3-border-green"><h1>Valoraci&oacute;n media: ' . $puntuacion .
                    '/5</h1></div>';
        }
        return $htmlPuntuacion . $str . '</div>';
    } else {
        return '<div class="w3-panel w3-pale-red w3-leftbar w3-border-red"><h1>No hay comentarios</h1></div>';
    }
}

/**
 * Función que devuelve un string con todos los productos cuyo vendedor es el 
 * cual tiene el correo dado por parámetros.
 * @param string $correo
 * @return string
 */
function mostrarProductosVendedor($correo) {
    $cookie_name = 'productoVisitado';
    $productos = 1;
    $numpaginas = 1;
    global $esquema;
    $query = "SELECT * FROM lanzamientos,producto WHERE producto.id_producto = lanzamientos.id_producto AND lanzamientos.correo = '$correo'";
    $result = realizarQuery($esquema, $query);
    if (mysqli_num_rows($result) == 0) {
        return '<p>No tiene productos en venta</p>';
    } else {
        $str = '<div class="w3-container w3-white w3-border w3-round w3-section tab-content current" id="tab-' . $numpaginas . '"  >';
        while ($fila = mysqli_fetch_array($result)) {
            $productos++;
            $numpaginas = 1;
            if ($productos == 11) {
                $productos = 0;
                $numpaginas++;
                $str .= '</div>';
                $str .= '<div class="w3-container w3-white w3-border w3-round w3-section tab-content" id="tab-' . $numpaginas . '" >';
            }//productos
            $str .= '<div class="w3-container w3-center w3-section w3-border w3-border-white w3-hover-border-blue w3-third"><a href="modificar_producto.php?id=' . $fila["id_producto"] . '")" >';
            $p_desc = (100 - $fila["porcentaje_descuento"]) * $fila["precio"] / 100;
            $str .= '<div class="w3-container"><div class="zoom"><img class="w3-image" src="' . '../imagenesSubidas/' . $fila['ruta_imagen'] . '"alt="' . $fila["nombre"] . '"/></div></div>' .
                    '<div class="w3-container"><div class="w3-container"><span style="font-weight: bold">' . $fila["nombre"] . ' </span><span class="w3-tag w3-small w3-padding w3-red" style="transform:rotate(-5deg)">-' . $fila["porcentaje_descuento"] . '%</span></div>' .
                    '<div class="w3-container"><span style="text-decoration: line-through">' . $fila["precio"] . '&euro;</span><span style="font-weight: bold"> ' . $p_desc . '&euro;</div></div>';
            $str .= '</a></div>';
        }
        $str .= '</div>';
        $i = 1;
        $str .= '<ul class="tabs w3-bar">';
        $str .= '<li class="tab-link current w3-button w3-border" data-tab="tab-' . $i . '">' . $i . '</li>';
        $i = 2;
        while ($i <= $numpaginas) {
            $str .= '<li class="tab-link w3-button w3-border" data-tab="tab-' . $i . '">' . $i . '</li>';
            $i++;
        }
        $str .= '</ul>';
        return $str;
    }
}

/**
 * Devuelve un boolean si la empresa es la vendedora del producto, ambos 
 * parámetros.
 * @param type $id_prod
 * @param type $correo
 * @return boolean
 */
function esVendedor($id_prod, $correo) {
    global $esquema;
    $query = "SELECT * FROM lanzamientos WHERE correo='$correo' AND id_producto='$id_prod'";
    $result = realizarQuery($esquema, $query);
    if (mysqli_num_rows($result) == 0) {
        return false;
    } else {
        return true;
    }
}

/**
 * Función que devuelve un string con los productos que ha comprado el cliente 
 * cuyo correo es el dado por parámetros.
 * @param string $correo
 * @return string
 */
function historialCliente($correo) {
    global $esquema;
    $sql = "SELECT * FROM compra,producto WHERE compra.correo='$correo' AND compra.id_producto = producto.id_producto";
    $result = realizarQuery($esquema, $sql);
    $html = '<div class="w3-container w3-white w3-border w3-round w3-section ">';
    while ($fila = mysqli_fetch_array($result)) {
        $html .= '<div class="w3-btn w3-block w3-flat-silver w3-round w3-margin"><a href="producto.php?id=' . $fila['id_producto'] . '" onclick="setCookie(' . $fila['id_producto'] . ',1)"><div class="w3-container w3-quarter">' . $fila['nombre'] . '</div><div class="w3-container w3-quarter">' . $fila['fecha'] . '</div><div class="w3-container w3-quarter">Cantidad: ' . $fila['cantidad'] . '</div><div class="w3-container w3-quarter">Precio: ' . $fila['precio'] . '&euro;</div></a></div>';
    }
    $html .= '</div>';
    return $html;
}

/**
 * Función que devuelve un string con los productos que hayan sido puesto en 
 * venta por la empresa cuyo correo es el dado por parámetros.
 * @param string $correo
 * @return string
 */
function historialVentas($correo) {
    $correo = $_SESSION["cuenta"];
    global $esquema;
    $sql = "SELECT * FROM lanzamientos,producto WHERE lanzamientos.correo='$correo' AND lanzamientos.id_producto=producto.id_producto";
    $result = realizarQuery($esquema, $sql);
    $html = '<div class="w3-container w3-white w3-border w3-round w3-section">';
    while ($fila = mysqli_fetch_array($result)) {
        $html .= '<div class="w3-btn w3-block w3-flat-silver w3-round w3-margin"><a href="producto.php?id=' . $fila['id_producto'] . '" onclick="setCookie(' . $fila['id_producto'] . ',1)"><div class="w3-container w3-quarter">' . $fila['nombre'] . '</div><div class="w3-container w3-quarter">' . $fila['fecha_ini'] . '</div><div class="w3-container w3-quarter">N&uacute;mero de ventas: ' . $fila['num_ventas'] . '</div><div class="w3-container w3-quarter">Beneficio obtenido: ' . $fila['num_ventas'] * $fila['precio'] . '</div></a></div>';
    }
    $html .= '</div>';
    return $html;
}

/**
 * Función que checkea si existe un correo que se le pase ya en la DB.
 * @param string $correo
 * @return boolean
 */
function existeCorreo($correo) {
    global $esquema;
    $sql = "SELECT * FROM cuenta WHERE correo='" . $correo . "'";
    $result = realizarQuery($esquema, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

/**
 * Devuelve true si el fichero pasado por parámetro posee un tipo MIME aceptado.
 * @param array $fichero
 * @return boolean
 */
function esImagen($fichero) {
    $tiposAceptados = Array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
    return in_array($fichero['type'], $tiposAceptados);
}

/**
 * Devuelve true si el fichero pasado por parámetro cumple el tamaño permitido.
 * @param array $fichero
 * @return boolean
 */
function limiteTamanyo($fichero, $limite) {
    return $fichero['size'] <= $limite;
}

$arrayComunidades = array(
    "andalucia" => "Andaluc&iacute;a",
    "aragon" => "Arag&oacute;n",
    "asturias" => "Asturias",
    "canarias" => "Canarias",
    "cantabria" => "Cantabria",
    "castilla_la_mancha" => "Castilla La Mancha",
    "castilla_y_leon" => "Castilla y Le&oacute;n",
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
$arrayCategoriasNoLogged = array(
    "general" => "General",
    "viajes" => "Viajes",
    "entretenimiento" => "Entretenimiento",
    "gastronomia" => "Gastronom&iacute;a",
    "electronica" => "Electr&oacute;nica",
    "ropa" => "Ropa",
    "salud_y_belleza" => "Salud y belleza",
    "deporte" => "Deporte",
);
$arrayCategoriasLogged = array(
    "general" => "General",
    "tus_gustos" => "Tus Gustos",
    "viajes" => "Viajes",
    "entretenimiento" => "Entretenimiento",
    "gastronomia" => "Gastronom&iacute;a",
    "electronica" => "Electr&oacute;nica",
    "ropa" => "Ropa",
    "salud_y_belleza" => "Salud y belleza",
    "deporte" => "Deporte",
);

/**
 * Función que devuelve unos enlaces a cada categoría.
 * @return string
 */
function menuCategorias() {
    global $arrayCategoriasNoLogged;
    global $arrayCategoriasLogged;
    $form = '';
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == 'empresa') {

        foreach ($arrayCategoriasNoLogged as $key => $val) {
            $form .= '<a href="index.php?categoria=' . $key . '"><div class="w3-btn w3-block w3-hover-pale-green">' . $val . '</div></a>';
        }
    } else {
        foreach ($arrayCategoriasLogged as $key => $val) {
            $form .= '<a href="index.php?categoria=' . $key . '"><div class="w3-btn w3-block w3-hover-pale-green">' . $val . '</div></a>';
        }
    }
    return $form;
}

/**
 * Devuelve un string con unos option para cada Comunidad Autónoma.
 * @return string
 */
function opcionesComunidades() {
    $opt = '';
    global $arrayComunidades;
    foreach ($arrayComunidades as $key => $val) {
        $opt .= '<option value="' . $key . '">' . $val . '</option>';
    }

    return $opt;
}

/**
 * Función que genera options con las comunidades autonomas y una seleccionada 
 * dada por parámetro.
 * @param int $comunidadAutonoma
 * @return string
 */
function opcionesComunidadSeleccionada($comunidadAutonoma) {
    $opt = '';
    global $arrayComunidades;
    foreach ($arrayComunidades as $key => $val) {
        if ($comunidadAutonoma == $key) {
            $opt .= '<option value="' . $key . '" selected="selected">' . $val . '</option>';
        } else {
            $opt .= '<option value="' . $key . '">' . $val . '</option>';
        }
    }
    return $opt;
}

/**
 * Función que genera checkboxes con las categorias.
 * @return string
 */
function checkboxesCategorias() {
    global $arrayCategorias;
    $form = '';
    foreach ($arrayCategorias as $key => $val) {
        $form .= '<span class="w3-half">' . $val . '</span><input class="w3-check w3-quarter" type="checkbox" name="' . $key . '" value="' . $key . '"/><br/>';
    }
    return $form;
}

/**
 * Función que genera checkboxes con las categorias, seleccionando las que 
 * vienen dadas por parámetro.
 * @param array $afinidades
 * @return string
 */
function checkboxesCategoriasSeleccionadas($afinidades) {
    global $arrayCategorias;
    $form = '';
    foreach ($arrayCategorias as $key => $val) {
        if (in_array($key, $afinidades)) {
            $form .= '<span class="w3-half">' . $val . ':</span><input class="w3-check w3-quarter" type="checkbox" name="' . $key . '" value="' . $key . '" checked/><br/>';
        } else {
            $form .= '<span class="w3-half">' . $val . ':</span><input class="w3-check w3-quarter" type="checkbox" name="' . $key . '" value="' . $key . '"/><br/>';
        }
    }
    return $form;
}

/**
 * Función que genera options con las categorias.
 * @return string
 */
function optionCategorias() {
    global $arrayCategorias;
    $form = '';
    global $arrayCategorias;
    foreach ($arrayCategorias as $key => $val) {
        $form .= '<option value="' . $key . '">' . $val . '</option>';
    }
    return $form;
}

/**
 * Función que genera options con las categorias y una seleccionada dada por 
 * parámetro.
 * @param int $cat
 * @return string
 */
function optionCategoriasSeleccionadas($cat) {
    $opt = '';
    global $arrayCategorias;
    foreach ($arrayCategorias as $key => $val) {
        if ($cat == $key) {
            $opt .= '<option value="' . $key . '" selected="selected">' . $val . '</option>';
        } else {
            $opt .= '<option value="' . $key . '">' . $val . '</option>';
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
    $bloqueHTML = '<div class="w3-panel w3-red w3-display-container">
  <span onclick="this.parentElement.style.display=\'none\'"
  class="w3-button w3-red w3-large w3-display-topright">&times;</span><h1>Se han producido los siguientes errores:</h1><ul>';
    foreach ($error as $err) {
        $bloqueHTML .= "<li>$err</li>";
    }
    $bloqueHTML .= '</ul></div>';
    return $bloqueHTML;
}

/**
 * Inicializa la base de datos
 */
function inicializarDB() {
    global $arrayCategorias;
    global $arrayComunidades;
    global $esquema;
    foreach ($arrayComunidades as $key => $val) {
        $sql = 'SELECT * FROM comunidad_autonoma';
        $result = realizarQuery($esquema, $sql);
        if (mysqli_num_rows($result) != count($arrayComunidades)) {
            $sql = "INSERT INTO comunidad_autonoma VALUES ('$key')";
            realizarQuery($esquema, $sql);
        }
    }
    foreach ($arrayCategorias as $key => $val) {
        $sql = 'SELECT * FROM categoria';
        $result = realizarQuery($esquema, $sql);
        if (mysqli_num_rows($result) != count($arrayCategorias)) {
            $sql = "INSERT INTO categoria VALUES ('$key')";
            realizarQuery($esquema, $sql);
        }
    }
}

/**
 * Devuelve true si es un cliente, false empresa.
 * @param string $correo
 * @return boolean
 */
function tipoCuenta($correo) {
    global $esquema;
    $cuenta = TRUE;
    $query = "SELECT * FROM cliente WHERE correo = '$correo'";
    $result = realizarQuery($esquema, $query);

    if (mysqli_num_rows($result) == 0) {
        $cuenta = FALSE;
    }
    return $cuenta;
}

/**
 * Genera la preview del producto.
 * @param type $result
 * @return string
 */
function previewProducto($result) {
    if (mysqli_num_rows($result) > 0) {
        $productos = 0;
        $productosRecorridos = 0;
        $productosTotales = mysqli_num_rows($result);
        $numpaginas = 1;
        $str = '<div class="w3-container w3-white w3-border w3-round w3-section tab-content current" id="tab-' . $numpaginas . '"  >';
        while ($fila = mysqli_fetch_array($result)) {
            $productosRecorridos++;
            $productos++;
            $str .= '<div class="w3-container w3-center w3-section w3-border w3-border-white w3-hover-border-blue w3-third"><a href="producto.php?id=' . $fila["id_producto"] . '&categoria='.$_GET['categoria'].'")" >';
            $p_desc = (100 - $fila["porcentaje_descuento"]) * $fila["precio"] / 100;
            $str .= '<div class="w3-container"><div class="zoom"><img class="w3-image" src="' . '../imagenesSubidas/' . $fila['ruta_imagen'] . '"alt="' . $fila["nombre"] . '"/></div></div>' .
                    '<div class="w3-container"><div class="w3-container"><span style="font-weight: bold">' . $fila["nombre"] . ' </span></div><span class="w3-tag w3-small w3-padding w3-red" style="transform:rotate(-5deg)">-' . $fila["porcentaje_descuento"] . '%</span>' .
                    '<div class="w3-container"><span style="text-decoration: line-through">' . $fila["precio"] . '&euro;</span><span style="font-weight: bold"> ' . $p_desc . '&euro;</div></div>';
            $str .= '</a></div>';
			if ($productos == 9 && $productosRecorridos < $productosTotales) {
                $productos = 0;
                $numpaginas++;
                $str .= '</div>';
                $str .= '<div class="w3-container w3-white w3-border w3-round w3-section tab-content" id="tab-' . $numpaginas . '" >';
            }//productos
        }
		$str .= '</div>';
        $i = 1;
        $str .= '<ul class="tabs w3-bar">';
        $str .= '<li class="tab-link current w3-button w3-border" data-tab="tab-' . $i . '">' . $i . '</li>';
        $i = 2;
        while ($i <= $numpaginas) {
            $str .= '<li class="tab-link w3-button w3-border" data-tab="tab-' . $i . '">' . $i . '</li>';
            $i++;
        }
        $str .= '</ul>';
    } else {
        $str = ' <div class="w3-panel w3-pale-red w3-leftbar w3-border-red">
                <p>No hay productos de esta categor&iacute;a para su comunidad
                o bien no se han publicado productos en esta categor&iacute;a a&uacute;n.</p>
                </div> ';
    }
    return $str;
}

/**
 * Devuelve un string con la página principal según la categoría dada.
 * @param type $categoria
 * @return string
 */
function desplegarPaginaPrincipal($categoria) {
    global $esquema;
    $str = '';

    //BÚSQUEDA NACIONAL
    if (!isset($_SESSION['cuenta'])) {
        //BÚSQUEDA CON CATEGORIA
        if (isset($categoria) && ($categoria != 'general')) {
            $sql = 'SELECT * FROM producto WHERE nombre_categoria LIKE "' . $categoria . '" AND cantidad_disponible > 0';
            $result = realizarQuery($esquema, $sql);
        }
        //BÚSQUEDA SIN CATEGORIA
        else {
            $sql = 'SELECT * FROM producto WHERE cantidad_disponible > 0';
            $result = realizarQuery($esquema, $sql);
            //echo 'hola';
            //echo previewProducto($result);
        }
    }
    //BÚSQUEDA LOCAL
    else {
        $sql = "SELECT * FROM cuenta WHERE correo ='" . $_SESSION['cuenta'] . "'";
        $result = realizarQuery($esquema, $sql);
        $ca = mysqli_fetch_row($result)[1];
        //BÚSQUEDA CON CATEGORIA
        if ($categoria != 'general' && $categoria != 'tus_gustos') {
            $sql = 'SELECT * FROM producto WHERE nombre_categoria LIKE "' . $categoria . '" AND nombre_ca LIKE "' . $ca . '" AND cantidad_disponible > 0';
            $result = realizarQuery($esquema, $sql);
        }
        //BUSQUEDA DE LOS GUSTOS DE UN USUARIO CLIENTE
        else if ($_SESSION['tipo'] == 'cliente' && $categoria == 'tus_gustos') {
            $correo = $_SESSION['cuenta'];
            $sql = 'SELECT * FROM producto WHERE nombre_categoria IN'
                    . "(SELECT DISTINCT nombre_categoria FROM cuenta,afinidades WHERE cuenta.correo='$correo' AND afinidades.correo='$correo') AND cantidad_disponible > 0";
            $result = realizarQuery("grupon", $sql);
        }
        //BÚSQUEDA SIN CATEGORIA
        else {
            $sql = 'SELECT * FROM producto WHERE nombre_ca LIKE "' . $ca . '" AND cantidad_disponible > 0';
            $result = realizarQuery("grupon", $sql);
        }
    }
    $str .= previewProducto($result);
    return $str;
}

/**
 * Devuelve un string con el menú de navegación
 * @return string
 */
function navigation() {
    $nav = '';
    if (isset($_SESSION["cuenta"])) {
        if ($_SESSION["tipo"] == "cliente") {// LOGEADO COMO CLIENTE
            $nav .= '<a class="w3-col m4 w3-bar-item w3-btn w3-mobile w3-hover-pale-yellow" href="mostrar_carrito.php">Carrito</a>' .
                    '<a class="w3-col m4 w3-bar-item w3-btn w3-mobile w3-hover-pale-yellow" href="../front-end/cuenta.php">Perfil</a>' .
                    '<a class="w3-col m4 w3-bar-item w3-btn w3-mobile w3-hover-pale-yellow" href="../back-end/logout.php">Desconectar</a>';
        } else {// LOGEADO COMO EMPRESA
            $nav .= '<a class="w3-col w3-bar-item w3-btn w3-mobile w3-hover-pale-yellow" style="width: 30%" href="creacion_producto.php">Crear Producto</a>' .
                    '<a class="w3-col w3-bar-item w3-btn w3-mobile w3-hover-pale-yellow" style="width: 30%" href="creacion_catalogo.php">Crear Cat&aacute;logo</a>' .
                    '<a class="w3-col w3-bar-item w3-btn w3-mobile w3-hover-pale-yellow" style="width: 15%" href="../front-end/cuenta.php">Perfil</a>' .
                    '<a class="w3-col w3-bar-item w3-btn w3-mobile w3-hover-pale-yellow" style="width: 25%" href="../back-end/logout.php">Desconectar</a>';
        }
    } else {//NO LOGEADO
        $nav .= '<a class="w3-col m6 w3-bar-item w3-btn w3-mobile w3-hover-pale-yellow" id="boton_login" href="login.php">Login y Registro</a>' .
                '<a class="w3-col m6 w3-bar-item w3-btn w3-mobile w3-hover-pale-yellow" href="mostrar_carrito.php">Carrito</a>';
    }
    return $nav;
}

/**
 * Devuelve un string con los catálogos de la cuenta a la que pertenezca la 
 * sesión.
 * @return string
 */
function busquedaCatalogo() {
    global $esquema;
    $form = '<div class="w3-container w3-white w3-border w3-round w3-section ">';
    $correo = $_SESSION["cuenta"];
    $sql = "SELECT * FROM catalogo WHERE correo='$correo'";
    $result = realizarQuery($esquema, $sql);
    $cookie_name = "catalogo_visitado";
    while ($listaCatalogos = mysqli_fetch_array($result)) {
        $form .= '<a href="../front-end/modificar_catalogo.php?id=' . $listaCatalogos["id_catalogo"] . '"><div class="w3-btn w3-block w3-flat-silver w3-round w3-margin">' . $listaCatalogos["nombre"] . '</div></a>';
    }
    $form .= '</div>';
    return $form;
}

/**
 * Devuelve el cuadro de búsqueda del menú de navegación.
 * @return string
 */
function formularioBusquedaProducto() {
    if (isset($_SESSION["cuenta"])) {
        $form = '<form class="w3-row" action="busqueda.php" method="get">'
                . '<input type="hidden" name="categoria" value="' . $_GET['categoria'] . '">' .
                '<input class="w3-input w3-col m8 w3-white" type="text" name="nombre" placeholder="Busca algo!"/>' .
                '<input class="w3-input w3-col m2 w3-button w3-flat-clouds w3-center" type="submit" value="🔍" name="busqueda"/>' .
                '<div class="w3-col m2">Nacional <input type="checkbox" name="nacional" value="nacional"/></div></form>';
    } else {
        $form = '<form class="w3-row" action="busqueda.php" method="get">'
                . '<input type="hidden" name="categoria" value="' . $_GET['categoria'] . '">' .
                '<input class="w3-col m8 w3-input w3-white" type="text" name="nombre" placeholder="Busca algo!"/>' .
                '<input class="w3-input w3-col m4 w3-button w3-flat-clouds w3-cell" type="submit" value="🔍" name="busqueda"/></form>';
    }
    return $form;
}

/* * TAMAÑOS MAXIMOS DE LAS VARIABLES EN LA DB* */
$tamCorreo = 75;
$tamNombreEmpresa = 100;
$tamNIF = 9;
$tamWeb = 255;
$tamDireccion = 255;
$tamCuentaBancaria = 20;
$tamTelefono = 9;
$tamNombreCliente = 50;
$tamApellidosCliente = 50;
?>



