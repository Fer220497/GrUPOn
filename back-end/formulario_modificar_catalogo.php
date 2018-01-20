<?php

$correo = $_SESSION['cuenta'];

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';
require_once '../back-end/formulario_borrar_catalogo.php';






if (isset($_POST['modificarCatalogo'])) {
    if (!isset($_POST['nombre'])) {
        $error[] = 'Debes introducir un nombre';
    }
     if (!isset($_POST['categoria'])) {
        $error[] = 'Debes introducir una categoria';
   }
   if(!array_key_exists($_POST['categoria'], $arrayCategorias)){
       $error="La categoria no existe";
   }
   $_POST['nombre'] = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
   if(!isset($error)){
       
       
       $nombre= sanitarString($_POST['nombre']);
       $nombre_categoria=sanitarString($_POST['categoria']);
       $id_catalogo=$_COOKIE['id_catalogo'];
       $sql="UPDATE catalogo SET nombre='$nombre', nombre_categoria='$nombre_categoria' WHERE id_catalogo='$id_catalogo'";
       realizarQuery($esquema, $sql);
       //header('Location: modificar_catalogo.php');
   }
}
if (isset($error)) {
    //echo muestraErrores($error);
    print_r($error);
}
echo formularioModificacionCatalogo($_GET['id']);
echo muestraFormularioBorrar();
/* BUSQUEDA DE CATALOGOS
  if (isset($_POST['seleccionarCatalogo'])) {
  if (!isset($_POST['nombre_catalogo'])) {
  $error[] = 'Debes introducir un catalogo';
  }
  $sql = "SELECT * FROM CATALOGO WHERE CORREO='$correo'";
  $result = realizarQuery("grupon", $sql);

  if (!mysqli_num_rows($result) > 0) {
  $error[] = "Catalogo no existe";
  }
  if (!isset($error)) {
  formularioModificacionCatalogo($_POST['nombre_catalogo']);
  }
  }
  if (isset($error)) {
  echo muestraErrores($error);
  }
  echo mostrarCatalogos();
 * */

/*
  function mostrarCatalogos() {
  $correo = $_SESSION['cuenta'];
  $sql = "SELECT nombre FROM CATALOGO WHERE CORREO='$correo'";
  $result = realizarQuery("grupon", $sql);


  $form = ' <form action="" method="post">' .
  'Catalogos: <select name="nombre_catalogo">';

  while ($datos = mysqli_fetch_array($result)) {
  $form .= '<option value="' . $datos["nombre"] . '">' . $datos["nombre"] . '</option>';
  }
  $form .= '</select><br>' .
  ' <input type="submit" name="seleccionarCatalogo" value="Enviar"/>' .
  ' </form>';
  return $form;
  }
 */

function formularioModificacionCatalogo($catalogoVisitado) {
    global $esquema;
    $correo = $_SESSION['cuenta'];
    $sql = "SELECT * FROM catalogo WHERE correo='$correo' AND id_catalogo='$catalogoVisitado'";
    $result = realizarQuery($esquema, $sql);
    $datosCatalogo = mysqli_fetch_array($result);
    //print_r($datosCatalogo);
    $ca = $datosCatalogo["nombre_categoria"];
    $nombre = $datosCatalogo["nombre"];

    $form = '<div class="w3-container w3-white w3-border w3-round w3-section ">' .
            '<form action="" method="post">' .
            '<br/>Nombre: <input class="w3-input" type="text" name="nombre" value="' . $nombre . '"> ' .
            'Categoria: <select class="w3-input" name="categoria">' . opcionesCatSeleccionada($ca) . '</select><br>' .
            ' <input class="w3-btn w3-light-grey w3-border w3-block w3-round w3-hover-pale-green w3-margin" type="submit" name="modificarCatalogo" value="Enviar"/>' .
            ' </form></div>';
    return $form;
}

?>