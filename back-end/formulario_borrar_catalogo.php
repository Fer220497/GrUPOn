<?php

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

if (isset($_POST['borrar']) && isset($_POST['check'])) {
    $id = $_GET['id'];
    

    $sql = "UPDATE producto SET id_catalogo=NULL WHERE id_catalogo='$id'";
    realizarQuery($esquema, $sql); 
    $sql = "DELETE FROM catalogo WHERE id_catalogo=$id";
    realizarQuery($esquema, $sql); 
    header('Location: cuenta.php'); 
}

/**
 * Función que muestra el botón para borrar el catálogo.
 * @return string
 */
function muestraFormularioBorrar() {
    return '<form class="w3-panel w3-red w3-topbar w3-bottombar w3-border-red" action="" method="post">
                    <input type="submit" class="w3-btn w3-hover-pale-red w3-border w3-round" name="borrar" value="Borrar Cat&aacute;logo"/><input class="w3-checkbox w3-margin" type="checkbox" name="check" value="Borrar"/>Marcar si est&aacute;s seguro de que quieres borrar el cat&aacute;logo
                </form>';
}

?>