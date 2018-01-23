<?php
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

if (isset($_GET['busqueda'])) {
    if (isset($_SESSION['cuenta'])) {
        $correo = $_SESSION['cuenta'];
    }
    if (!isset($_GET['nombre'])) {
        $error[] = "Nombre no introducido";
    }
    if (!isset($error)) {
        $nombre = sanitarString($_GET['nombre']);
        echo '<h3>Productos</h3>';
        //BÚSQUEDA NACIONAL
        if (!isset($_SESSION['cuenta']) || isset($_GET['nacional'])) {
            //BÚSQUEDA CON CATEGORIA
            if ($_GET['categoria'] != 'general') {
                $sql = 'SELECT * FROM producto WHERE nombre_categoria LIKE "' . $_GET['categoria'] . '" AND (nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%") AND cantidad_disponible > 0';
                $result = realizarQuery($esquema, $sql);
            }
            //BÚSQUEDA SIN CATEGORIA
            else {
                $sql = 'SELECT * FROM producto WHERE (nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%") AND cantidad_disponible > 0';
                $result = realizarQuery($esquema, $sql);
            }
        }
        //BÚSQUEDA LOCAL
        else {
            $sql = "SELECT * FROM cuenta WHERE correo ='" . $_SESSION['cuenta'] . "'";
            $result = realizarQuery($esquema, $sql);
            $ca = mysqli_fetch_row($result)[1];
            //BÚSQUEDA CON CATEGORIA
            if ($_GET['categoria'] != 'general') {
                $sql = 'SELECT * FROM producto WHERE nombre_categoria LIKE "' . $_GET['categoria'] . '" AND (nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%") AND nombre_ca LIKE "' . $ca . '" AND cantidad_disponible > 0';
                $result = realizarQuery($esquema, $sql);
            }
            //BÚSQUEDA SIN CATEGORIA
            else {
                $sql = 'SELECT * FROM producto WHERE (nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%") AND nombre_ca LIKE "' . $ca . '" AND cantidad_disponible > 0';
                $result = realizarQuery($esquema, $sql);
            }
        }
        $str = previewProducto($result);
        $str .= '<h3>Cat&aacute;logos</h3>';
        if ($_GET['categoria'] != 'general') {
            $sql = 'SELECT * FROM catalogo WHERE nombre LIKE "%' . $nombre . '%" AND nombre_categoria = "' . $_GET['categoria'] . '"';
        } else {
            $sql = 'SELECT * FROM catalogo WHERE nombre LIKE "%' . $nombre . '%"';
        }
        $result = realizarQuery($esquema, $sql);
        if(mysqli_num_rows($result) > 0){
        $str .= '<div class="w3-container w3-white w3-border w3-round w3-section ">';
        while ($fila = mysqli_fetch_row($result)) {
            $cookie_name = "catalogoVisitado";
            $str .= '<a class="w3-btn w3-block w3-flat-silver w3-round w3-margin" href="catalogo.php?id='.$fila[0].'&categoria='.$_GET['categoria'].'"><div class="w3-third" >Nombre: ' . $fila[3] . '</div><div class="w3-third">  Categor&iacute;a: ' . $fila[2] . '</div><div class="w3-third">Empresa: ' . $fila[1] . '</div></a>';
        }
        $str .= '</div>';
        }else{
            $str .=  '<div class="w3-panel w3-pale-red w3-leftbar w3-border-red">
            <p>No hay cat&aacute;logos.</p></div>';
        }
        echo $str;
    }
}
if (isset($error)) {
    echo muestraErrores($error);
}

/**LA FUNCION QUE GENERA ESTE FORMULARIO ESTÁ EN FUNCIONES.PHP POR RESTRICCION DE DISEÑO DE LA WEB**/
