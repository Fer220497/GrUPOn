<?php

session_start();

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

echo formularioBusquedaProducto() . '<br/>';


if (isset($_POST['busqueda'])) {
   
    $correo = $_SESSION["cuenta"];
    if (isset($_POST["nombre"])) {
        $error[] = "Nombre no introducido";
    }
    if (!isset($error)) {
         
        if (isset($_SESSION["cuenta"])) {//ESTA LOGEADO
            if ($_POST['nacional'] != 'nacional') {
                $error[] = "HTML MODIFICADO";
            } else {
                if ($_POST["nacional"]) {//BUSQUEDA NACIONAL
                    if ($_COOKIE["categoria"] != "general") {///BUSQUEDA NACIONAL CON CATEGORIA
                        
                        $nombre = $_POST['nombre'];
                        $sql = 'SELECT * FROM PRODUCTO WHERE nombre_categoria="' . $_COOKIE["categoria"] . ' " AND (nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%")';
                        echo "NACIONAL CON CATEGORIA";
                        echo $sql;
                        $result = realizarQuery("grupon", $sql);
                        echo '<table border=1>';
                        while ($fila = mysqli_fetch_row($result)) {
                            echo '<tr><td>' . $fila[4] . '</td><td>' . $fila[6] . '</tr>';
                        }
                        echo '</table>';
                    } else {//////BUSQUEDA NACIONAL SIN CATEGORIA
                        $nombre = $_POST['nombre'];
                        $sql = 'SELECT * FROM PRODUCTO WHERE nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%"';
                        echo "NACIONAL SIN CATEGORIA";
                        echo $sql;
                        $result = realizarQuery("grupon", $sql);
                        echo '<table border=1>';
                        while ($fila = mysqli_fetch_row($result)) {
                            echo '<tr><td>' . $fila[4] . '</td><td>' . $fila[6] . '</tr>';
                        }
                        echo '</table>';
                    }
                } else {//BUSQUEDA LOCAL
                    if ($_COOKIE["categoria"] != "general") {///BUSQUEDA LOCAL CON CATEGORIA
                       
                        $sql = "SELECT nombre_ca FROM CUENTA WHERE correo='$correo'";
                        $result = realizarQuery("grupon", $sql);
                        $datos = mysqli_fetch_array($result);
                        $nombre_ca = $datos["nombre_ca"];
                        $sql = 'SELECT * FROM PRODUCTO WHERE nombre_categoria="' . $_COOKIE["categoria"] . ' " AND nombre_ca ="' . $nombre_ca . ' AND "(nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%")';
                        echo "LOCAL CON CATEGORIA";
                        echo $sql;
                        $result = realizarQuery("grupon", $sql);
                        echo '<table border=1>';
                        while ($fila = mysqli_fetch_row($result)) {
                            echo '<tr><td>' . $fila[4] . '</td><td>' . $fila[6] . '</tr>';
                        }
                        echo '</table>';
                    } else {//////BUSQUEDA LOCAL  SIN CATEGORIA
                       
                        $sql = "SELECT nombre_ca FROM CUENTA WHERE correo='$correo'";
                        $result = realizarQuery("grupon", $sql);
                        $datos = mysqli_fetch_array($result);
                        $nombre_ca = $datos["nombre_ca"];
                        $sql = 'SELECT * FROM PRODUCTO WHERE nombre_ca="' . $nombre_ca . ' " AND (nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%")';
                        echo "LOCAL SIN CATEGORIA";
                        echo $sql;
                        $result = realizarQuery("grupon", $sql);
                        echo '<table border=1>';
                        while ($fila = mysqli_fetch_row($result)) {
                            echo '<tr><td>' . $fila[4] . '</td><td>' . $fila[6] . '</tr>';
                        }
                        echo '</table>';
                    }
                }
            }
        } else {//NO ESTA LOGEADO
            if ($_COOKIE["categoria"] != "general") {///BUSQUEDA NACIONAL CON CATEGORIA
               
                $nombre = $_POST['nombre'];
                $sql = 'SELECT * FROM PRODUCTO WHERE nombre_categoria="' . $_COOKIE["categoria"] . ' " AND (nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%")';
                echo "NACIONAL CON CATEGORIA";
                echo $sql;
                $result = realizarQuery("grupon", $sql);

                echo '<table border=1>';
                while ($fila = mysqli_fetch_row($result)) {
                    echo '<tr><td>' . $fila[4] . '</td><td>' . $fila[6] . '</tr>';
                }
                echo '</table>';
            } else {//////BUSQUEDA NACIONAL  SIN CATEGORIA
               
                $nombre = $_POST['nombre'];
                $sql = 'SELECT * FROM PRODUCTO WHERE nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%"';
                echo "NACIONAL SIN CATEGORIA";
                echo $sql;
                $result = realizarQuery("grupon", $sql);
                echo '<table border=1>';
                while ($fila = mysqli_fetch_row($result)) {
                    echo '<tr><td>' . $fila[4] . '</td><td>' . $fila[6] . '</tr>';
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
    $correo = $_SESSION["cuenta"];
    echo "<br>".$correo."<br>";
    $form = '<form action="" method="post">' .
            '<input type="text" name="nombre"/>';
    if (isset($_SESSION["cuenta"])) {
        $form .= ' Nacional <input type="checkbox" name="nacional" value="nacional"><br>';
    }

    $form .= '<input type="submit" value="Buscar" name="busqueda"/>' .
            '</form>';

    return $form;
}
