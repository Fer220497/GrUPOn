<?php

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

/*
 * Muestra los datos de un catálogo cuyo id se corresponde con el pasado por 
 * parámetro.
 * @param int $id
 */
function mostrarCatalogo($id) {
    global $esquema;
    global $arrayCategorias;
    $html = "";
    $sql = "SELECT * FROM catalogo WHERE id_catalogo='$id'";
    $result = realizarQuery($esquema, $sql);
    $fila = mysqli_fetch_array($result);
    $html .= '<div class="w3-container w3-white w3-border w3-round w3-section tab-content current"><div class="w3-container w3-half">' . $fila["nombre"] . '</div><div class="w3-container w3-half">' . $arrayCategorias[$fila["nombre_categoria"]] . '</div></div>';

    $sql = "SELECT * FROM producto WHERE id_catalogo='$id'";
    $result = realizarQuery($esquema, $sql);
    if (mysqli_num_rows($result)) {
        $html .= previewProducto($result);
    } else {
        $html .= ' <div class="w3-panel w3-pale-red w3-leftbar w3-border-red">
                <p>El cat&aacute;logo est&aacute; vac&iacute;o.</p>
                </div> ';
    }
    return $html;
}
?>

