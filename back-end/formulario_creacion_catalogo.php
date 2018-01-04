<?php
session_start();

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

foreach ($arrayCategorias as $categoria=>$val) {
    $sql = 'SELECT * FROM CATEGORIA';
    $result = realizarQuery('grupon', $sql);
    if (mysqli_num_rows($result) != count($arrayCategorias)) {
        $sql = "INSERT INTO CATEGORIA VALUES ('$categoria')";
        realizarQuery('grupon', $sql);
    }
}

if (isset($_POST['nuevo_cat'])) {
    if (!isset($_POST['nombre'])) {
        $error[] = "Debes introducir nombre.";
    }
    if (!isset($_POST['categoria'])) {
        $error[] = "Debes introducir categor&iacutea.";
    }
    if (!isset($error)) {
        $correo = $_SESSION['cuenta'];
        $nombre = sanitarString($_POST['nombre']);
        $categoria = $_POST['categoria'];
        $query = "INSERT INTO CATALOGO (correo, nombre_categoria, nombre) VALUES ('". $correo ."', '". $categoria ."','". $nombre ."')";
        if(realizarQuery('grupon', $query)){
            echo 'placeholder bueno';
        } else {
            echo 'placeholder malo';
        }
    }
}if (!isset($_POST['login']) || isset($error)) {
    if (isset($error)) {
        echo muestraErrores($error);
    }
    echo formularioCreacionCatalogo();
}

/**
 * Esta funcion genera un login en forma de string
 * @return string
 */
function formularioCreacionCatalogo() {
    $form = ' <form action="" method="post">' .
            ' Nombre: <input type="text" name="nombre" /><br/>' .
            ' Categor&iacute;a: <select name="categoria">' . optionCategorias() .
            '</select>' .
            ' <input type="submit" name="nuevo_cat" value="Enviar"/>' .
            ' </form>';
    return $form;
}

?>