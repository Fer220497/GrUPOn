<?php

$correo = $_SESSION['cuenta'];

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';







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
   if(!isset($error)){
       
       
       $nombre= sanitarString($_POST['nombre']);
       $nombre_categoria=sanitarString($_POST['categoria']);
       $id_catalogo=$_COOKIE['id_catalogo'];
       $sql="UPDATE CATALOGO SET nombre='$nombre', nombre_categoria='$nombre_categoria' WHERE id_catalogo='$id_catalogo'";
       realizarQuery('grupon', $sql);
       //header('Location: modificar_catalogo.php');
   }
}
if (isset($error)) {
    //echo muestraErrores($error);
    print_r($error);
}
echo formularioModificacionCatalogo("Botines23");

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

function formularioModificacionCatalogo($nombreCatalogo) {
    $correo = $_SESSION['cuenta'];
    $sql = "SELECT * FROM CATALOGO WHERE CORREO='$correo' AND NOMBRE='$nombreCatalogo'";
    $result = realizarQuery("grupon", $sql);
    $datosCatalogo = mysqli_fetch_array($result);
    print_r($datosCatalogo);
    $ca = $datosCatalogo["nombre_categoria"];
    $nombre = $datosCatalogo["nombre"];
    $id=$datosCatalogo["id_catalogo"];
    setcookie("id_catalogo", $id);

    $form = ' <form action="" method="post">' .
            'Nombre: <input type="text" name="nombre" value="' . $nombre . '"> ' .
            'Categoria: <select name="categoria">' . opcionesCatSeleccionada($ca) . '</select><br>' .
            ' <input type="submit" name="modificarCatalogo" value="Enviar"/>' .
            ' </form>';
    return $form;
}

?>