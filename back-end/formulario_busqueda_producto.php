<?php

session_start();

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

echo formularioBusquedaProducto() . '<br/>';


if (isset($_POST['busqueda'])) {
    $correo = $_SESSION["cuenta"];
    if (!isset($_POST["nombre"])) {
        $error[] = "Nombre no introducido";
    }
    if (!isset($error)) {
        //BÚSQUEDA NACIONAL
        if (!isset($_SESSION['cuenta']) || isset($_POST['nacional'])) {
            //BÚSQUEDA CON CATEGORIA
            if ($_COOKIE['categoria'] != 'general') {
                $nombre = $_POST['nombre'];
                $sql = 'SELECT * FROM PRODUCTO WHERE nombre_categoria LIKE "' . $_COOKIE['categoria'] . '" AND (nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%")';
                $result = realizarQuery("grupon", $sql);
                echo '<table border=1>';
                while ($fila = mysqli_fetch_row($result)) {
                    $cookie_name="productoVisitado";
                    echo '<tr><td><a href="producto.php" onclick="setCookie(\''.$cookie_name.'\',\''.$fila[0].'\',1)">' . $fila[4] . '</td></a><td>' . $fila[6] . '</tr>';
                }
                echo '</table>';
            }
            //BÚSQUEDA SIN CATEGORIA
            else {
                $nombre = $_POST['nombre'];
                $sql = 'SELECT * FROM PRODUCTO WHERE nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%"';
                $result = realizarQuery("grupon", $sql);
                echo '<table border=1>';
                while ($fila = mysqli_fetch_row($result)) {
                    $cookie_name="productoVisitado";
                    echo '<tr><td><a href="producto.php" onclick="setCookie(\''.$cookie_name.'\',\''.$fila[0].'\',1)" >' . $fila[4] . '</td></a><td>' . $fila[6] . '</tr>';
                }
                echo '</table>';
            }
        }
        //BÚSQUEDA LOCAL
        else {
            $sql = "SELECT * FROM CUENTA WHERE correo ='" . $_SESSION['cuenta'] . "'";
            $result = realizarQuery($esquema, $sql);
            $ca = mysqli_fetch_row($result)[1];
            //BÚSQUEDA CON CATEGORIA
            if ($_COOKIE['categoria'] != 'general') {
                $nombre = $_POST['nombre'];
                $sql = 'SELECT * FROM PRODUCTO WHERE nombre_categoria LIKE "' . $_COOKIE['categoria'] . '" AND (nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%") AND nombre_ca LIKE "' . $ca . '"';
                $result = realizarQuery("grupon", $sql);
                echo '<table border=1>';
                while ($fila = mysqli_fetch_row($result)) {
                    $cookie_name="productoVisitado";
                    echo '<tr><td><a href="producto.php" onclick="setCookie(\''.$cookie_name.'\',\''.$fila[0].'\',1)">' . $fila[4] . '</td></a><td>' . $fila[6] . '</tr>';
                }
                echo '</table>';
            }
            //BÚSQUEDA SIN CATEGORIA
            else {
                $nombre = $_POST['nombre'];
                $sql = 'SELECT * FROM PRODUCTO WHERE (nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%") AND nombre_ca LIKE "' . $ca . '"';
                $result = realizarQuery("grupon", $sql);
                echo '<table border=1>';
                while ($fila = mysqli_fetch_row($result)) {
                    $cookie_name="productoVisitado";
                    echo '<tr><td><a href="producto.php" onclick="setCookie(\''.$cookie_name.'\',\''.$fila[0].'\',1)">' . $fila[4] . '</td></a><td>' . $fila[6] . '</tr>';
                }
                echo '</table>';
            }
        }
    }
}

/*

  if (isset($_POST['busqueda'])) {
  if (!isset($_POST['nombre'])) {
  $errores[] = 'Debes introducir nombre';
  }
  if (!isset($errores)) {
  $nombre = $_POST['nombre'];
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
    muestraErrores($error);
}

function formularioBusquedaProducto() {
    $form = '<form action="" method="post">' .
            '<input type="text" name="nombre"/>';
    if (isset($_SESSION["cuenta"])) {
        $form .= ' Nacional <input type="checkbox" name="nacional" value="nacional"><br>';
    }

    $form .= '<input type="submit" value="Buscar" name="busqueda"/>' .
            '</form>';

    return $form;
}
