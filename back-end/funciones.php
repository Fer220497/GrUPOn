<?php

require_once '../back-end/conexion_db.php';

/**
 * Un cliente solo puede comentar si:
 * Está loggeado, ha comprado el produto y NO ha comentado.
 * @global type $esquema
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

function mostrarCajaComentario() {
    $form = '<form method="post" action="">'
            . '<textarea name="comentario" placeholder="Comenta algo!" maxlength="5000"></textarea>'
            . '<input type="number" name="valoracion" min="0" max="5" value="3"/>'
            . '<input type="submit" name="enviado" value="Enviar comentario"/></form>';
    return $form;
}

function mostrarComentarios($producto) {
    global $esquema;
    $query = "SELECT * FROM comentarios,cliente WHERE comentarios.correo=cliente.correo AND id_producto='$producto'";
    $result = realizarQuery($esquema, $query);
    if (mysqli_num_rows($result) > 0) {
        $sumaPuntuaciones = 0;
        $str = '<div id="comentarios">';
        while ($fila = mysqli_fetch_array($result)) {
            $str .= '<h4>' . $fila['nombre_cliente'] . ', ' . $fila['valoracion'] . '</h4>'
                    . '<p>' . $fila['comentario'] . '</p>';
            $sumaPuntuaciones += $fila['valoracion'];
        }
        return '<div id="puntuacion_total"><h3>Valoraci&oacute;n media: ' . $sumaPuntuaciones / mysqli_num_rows($result) .
                '/5</h3></div>' . $str . '</div>';
    } else {
        return '<div id="comentarios">No hay comentarios</div>';
    }
}

function mostrarProductosVendedor($correo) {
    $cookie_name = 'productoVisitado';
    global $esquema;
    $query = "SELECT * FROM lanzamientos,producto WHERE producto.id_producto = lanzamientos.id_producto AND lanzamientos.correo = '$correo'";
    $result = realizarQuery($esquema, $query);
    if (mysqli_num_rows($result) == 0) {
        return '<p>No tiene productos en venta</p>';
    } else {
        $str = '<div class="producto">';
        while ($fila = mysqli_fetch_array($result)) {
            $str .= '<div><a href="modificar_producto.php?id=' . $fila["id_producto"] . '"><img src="' . '../imagenesSubidas/' . $fila['ruta_imagen'] . '"alt="IMAGEN" height="200"/></a></div>' .
                    '<div><a href="modificar_producto.php?id=' . $fila["id_producto"] . '" >' . $fila["nombre"] . '</a>' .
                    'Precio: ' . $fila["precio"] . '&euro; Descuento: ' . $fila["porcentaje_descuento"] . '%</div>';
        }
        return $str .= '</table>';
    }
}

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

function historialCliente($correo) {
    global $esquema;
    $sql = "SELECT * FROM compra,producto WHERE compra.correo='$correo' AND compra.id_producto = producto.id_producto";
    $result = realizarQuery($esquema, $sql);
    $html = '<table border="1"><tr>'
            . '<th>Nombre Producto</th><th>Fecha Compra</th><th>Cantidad</th><th>Precio</th></tr>';
    while ($fila = mysqli_fetch_array($result)) {
        $html .= '<tr><td><a href="producto.php?id=' . $fila['id_producto'] . '">' . $fila['nombre'] . '</a></td><td>' . $fila['fecha'] . '</td><td>' . $fila['cantidad'] . '</td><td>' . $fila['cantidad'] * $fila['precio'] . '</td></tr>';
    }
    $html .= '</table>';
    return $html;
}

function historialVentas($correo) {
    $correo = $_SESSION["cuenta"];
    global $esquema;
    $sql = "SELECT * FROM lanzamientos,producto WHERE lanzamientos.correo='$correo' AND lanzamientos.id_producto=producto.id_producto";
    $result = realizarQuery($esquema, $sql);
    $html = '<table border="1">'
            . '<th>Nombre Producto</th><th>Fecha Venta</th><th>N&uacute;mero Ventas</th><th>Beneficio Obtenido</th>';
    while ($fila = mysqli_fetch_array($result)) {
        $html .= '<tr><td><a href="producto.php" onclick="setCookie(' . $fila['id_producto'] . ',1)">' . $fila['nombre'] . '</a></td><td>' . $fila['fecha_ini'] . '</td><td>' . $fila['num_ventas'] . '</td><td>' . $fila['num_ventas'] * $fila['precio'] . '</td></tr>';
    }
    return $html;
}

/**
 * Función que checkea si existe un correo que se le pase ya en la DB.
 * @param type $correo
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

function esImagen($fichero) {
    $tiposAceptados = Array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
    return in_array($fichero['type'], $tiposAceptados);
}

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

function menuCategorias() {
    global $arrayCategorias;
    global $arrayCategoriasLogged;
    //$form = '<div><a href="index.php?categoria=general"';
    $form = '';
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == 'empresa') {

        foreach ($arrayCategorias as $key => $val) {

            $form .= '<div><a href="index.php?categoria=' . $key . '">' . $val . '</a></div>';
        }
    } else {
        foreach ($arrayCategoriasLogged as $key => $val) {

            $form .= '<div><a href="index.php?categoria=' . $key . '">' . $val . '</a></div>';
        }
    }
    return $form;
}

/**
 * Función que genera options con las comunidades autonomas
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
 * Función que genera options con las comunidades autonomas y una seleccionada.
 * @param type $comunidadAutonoma
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

function opcionesCatSeleccionada($catsel) {
    $opt = '';
    global $arrayCategorias;
    foreach ($arrayCategorias as $key => $val) {
        if ($catsel == $key) {
            $opt .= '<option value="' . $key . '" selected="selected">' . $val . '</option>';
        } else {
            $opt .= '<option value="' . $key . '">' . $val . '</option>';
        }
    }
    return $opt;
}

function checkboxesCategorias() {
    global $arrayCategorias;
    $form = '';
    foreach ($arrayCategorias as $key => $val) {
        $form .= $val . ': <input type="checkbox" name="' . $key . '" value="' . $key . '"/><br/>';
    }
    return $form;
}

function checkboxesCategoriasSeleccionadas($afinidades) {
    global $arrayCategorias;
    $form = '';
    foreach ($arrayCategorias as $key => $val) {
        if (in_array($key, $afinidades)) {
            $form .= $val . ': <input type="checkbox" name="' . $key . '" value="' . $key . '" checked/><br/>';
        } else {
            $form .= $val . ': <input type="checkbox" name="' . $key . '" value="' . $key . '"/><br/>';
        }
    }
    return $form;
}

function optionCategorias() {
    global $arrayCategorias;
    $form = '';
    global $arrayCategorias;
    foreach ($arrayCategorias as $key => $val) {
        $form .= '<option value="' . $key . '">' . $val . '</option>';
    }
    return $form;
}

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

function tipoCuenta($correo) {
    //True cliente, false empresa
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
    $str = '';
    while ($fila = mysqli_fetch_array($result)) {
        $str .= '<div class="producto">';
        $p_desc = (100 - $fila["porcentaje_descuento"]) * $fila["precio"] / 100;
        $str .= '<div class="img_prod"><a href="producto.php?id=' . $fila["id_producto"] . '")" ><img src="' . '../imagenesSubidas/' . $fila['ruta_imagen'] . '"alt="' . $fila["nombre"] . '" height="200"/></div>' .
                '<div class="desc_prod"><div class="nom_prod"><a href="producto.php?id=' . $fila["id_producto"] . '")" >' . $fila["nombre"] . '</a></div>' .
                '<div class="precio_prod"><span class="descontado">' . $fila["precio"] . '€</span> ' . $p_desc . '€</div></div>';
        $str .= '</div>';
    }
    return $str;
}

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


        /*
          $str .= '<table border=1>';
          while ($fila = mysqli_fetch_array($result)) {
          $str .= '<tr><a href="producto.php?id='.$fila["id_producto"].'")" ><img src="' . '../imagenesSubidas/' . $fila['ruta_imagen'] . '"alt="IMAGEN" height="200"/></a></tr>' .
          '<tr><td><a href="producto.php?id='.$fila["id_producto"].'")" >' . $fila["nombre"] . '</a></td></tr>' .
          '</td><td> Precio: ' . $fila["precio"] . '</td><td> Descuento: ' . $fila["porcentaje_descuento"] . '</td></tr>';
          }
          $str .= '</table>'; */
    }
    $str .= previewProducto($result);
    return $str;
}

function navigation() {
    $nav = '<ul class="nav navbar-nav navbar-right">';
    if (isset($_SESSION["cuenta"])) {
        if ($_SESSION["tipo"] == "cliente") {// LOGEADO COMO CLIENTE
            $nav .= '<li><a id="carrito" href="mostrar_carrito.php"><span class="glyphicon"></span>Carrito</a></li>' .
                    '<li><a id="perfil" href="../front-end/cuenta.php"><span class="glyphicon"></span>Perfil</a></li>' .
                    '<li><a id="logout" href="../back-end/logout.php"><span class="glyphicon"></span>Desconectar</a></li>';
        } else {// LOGEADO COMO EMPRESA
            $nav .= '<li><a id="crear_produto" href="creacion_producto.php"><span class="glyphicon"></span>Crear Producto</a></li>' .
                    '<li><a id="crear_catalogo" href="creacion_catalogo.php"><span class="glyphicon"></span>Crear Cat&aacute;logo</a></li>' .
                    '<li><a id="perfil" href="../front-end/cuenta.php"><span class="glyphicon"></span>Perfil</a></li>' .
                    '<li><a id="logout" href="../back-end/logout.php"><span class="glyphicon"></span>Desconectar</a></li>';
        }
    } else {//NO LOGEADO
        $nav .= '<li><a id="boton_login" href="login.php"><span class="glyphicon"></span>Login y Registro</a></li>' .
                '<li><a id="carrito" href="mostrar_carrito.php"><span class="glyphicon"></span>Carrito</a></li>';
    }
    $nav .= " </ul>";
    return $nav;
}

function busquedaCatalogo() {
    global $esquema;
    $form = "";
    $correo = $_SESSION["cuenta"];
    $sql = "SELECT * FROM catalogo WHERE correo='$correo'";
    $result = realizarQuery($esquema, $sql);
    $cookie_name = "catalogo_visitado";
    while ($listaCatalogos = mysqli_fetch_array($result)) {
        $form .= '<a href="../front-end/modificar_catalogo.php?id=' . $listaCatalogos["id_catalogo"] . '">' . $listaCatalogos["nombre"] . '</a>';
    }
    return $form;
}

function formularioBusquedaProducto() {
    $form = '<div class="jumbotron"><form class="form-inline">
    <div class="input-group">
      <input type="email" class="form-control" size="50" placeholder="Busca un producto!" required>
      <div class="input-group-btn">
        <button type="button" class="btn">Buscar</button>
      </div>
    </div>
  </form>
</div>';
    if (isset($_SESSION["cuenta"])) {
        $form .= '<div id="checknacional"> Nacional <input type="checkbox" name="nacional" value="nacional"/></div>';
    }
    $form .= '</div></form>';

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
