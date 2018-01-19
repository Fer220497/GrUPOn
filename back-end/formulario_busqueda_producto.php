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
        echo '<h3>Productos</h3><table border="1">';
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
        /*
        $str = '<table border=1>';
            while ($fila = mysqli_fetch_array($result)) {
                $str .= '<tr><a href="producto.php?id='.$fila["id_producto"].'")" ><img src="' . '../imagenesSubidas/' . $fila['ruta_imagen'] . '"alt="IMAGEN" height="200"/></a></tr>' .
                        '<tr><td><a href="producto.php?id='.$fila["id_producto"].'")" >' . $fila["nombre"] . '</a></td></tr>' .
                        '</td><td> Precio: ' . $fila["precio"] . '</td><td> Descuento: ' . $fila["porcentaje_descuento"] . '</td></tr>';
            }
        $str .= '</table>';
        */
        $str = previewProducto($result);
        $str .= '<h3>Cat&aacute;logos</h3><table border = 1>';
        //$nombre = $_GET['nombre'];
        if ($_GET['categoria'] != 'general') {
            $sql = 'SELECT * FROM catalogo WHERE nombre LIKE "%' . $nombre . '%" AND nombre_categoria = "' . $_GET['categoria'] . '"';
        } else {
            $sql = 'SELECT * FROM catalogo WHERE nombre LIKE "%' . $nombre . '%"';
        }
        $result = realizarQuery($esquema, $sql);
        while ($fila = mysqli_fetch_row($result)) {
            $cookie_name = "catalogoVisitado";
            $str .= '<tr><td><a href="catalogo.php?id='.$fila[0].'&categoria='.$_GET['categoria'].'">' . $fila[3] . '</td></a><td>' . $fila[2] . '</td></tr>';
        }
        echo $str . '</table>';
    }
}

/*

  if (isset($_GET['busqueda'])) {
  if (!isset($_GET['nombre'])) {
  $errores[] = 'Debes introducir nombre';
  }
  if (!isset($errores)) {
  $nombre = $_GET['nombre'];
  $sql = 'SELECT * FROM PRODUCTO WHERE nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%"';
  $result = realizarQuery("grupon", $sql);
  echo '<table border=1>';
  while ($fila = mysqli_fetch_row($result)) {
  echo '<tr><td>' . $fila[4] . '</td><td>' . $fila[6] . '</tr>';
  }
  echo '</table>';
  }
  }

 */
if (isset($error)) {
    echo muestraErrores($error);
}

/**LA FUNCION QUE GENERA ESTE FORMULARIO ESTÁ EN FUNCIONES.PHP POR RESTRICCION DE DISEÑO DE LA WEB**/
