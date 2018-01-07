<?php

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

if (isset($_POST['borrar']) && isset($_POST['check'])) {
    $id = $_COOKIE['catalogoVisitado'];
    

    $sql = "UPDATE PRODUCTO SET id_catalogo=NULL WHERE id_catalogo='$id'";
    realizarQuery($esquema, $sql); 
    $sql = "DELETE FROM CATALOGO WHERE id_catalogo=$id";
    realizarQuery($esquema, $sql);  //OP DELETE SOBRE
    //header('Location: ../back-end/logout.php'); LLEVALRO AL MENU PRINCIPAL?
}

// $sql = "UPDATE CUENTA SET PWD='$hash' WHERE CORREO='$correo'";
function muestraFormularioBorrar() {
    return '<form action="" method="post">
                    <input type="submit" name="borrar" value="Borrar Cat&aacute;logo"/> Marcar si est&aacute;s seguro de que quieres borrar el cat&aacute;logo <input type="checkbox" name="check" value="Borrar"/>
                </form>';
}

?>