
<?php
$correo=$_SESSION["cuenta"];
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

if (isset($_POST['registroCliente'])) {
//


    if (!in_array($_POST["nombre_categoria"], $arrayCategorias)) {
        $error[] = "No existe la categoria";
    }

    if (!in_array($_POST["nombre_ca"], $arrayComunidades)) {
        $error[] = "No existe la categoria";
    }
   /////TERMINAR LA SQL
    $id_catalogo=$_POST["id_catalogo"];
    $sql = "SELECT id_catalogo, nombre FROM CATALOGO WHERE correo='$correo ' AND id_catalogo='$id_catalogo'";
    $result = realizarQuery('grupon', $sql);
    if (mysqli_num_rows($result) > 0) {
            $error[] = "No existe ese catalogo";
    }
   
    if (!isset($_POST["nombre"])) {
        $error[] = "Debes introducir un nombre";
    }
    if (!isset($_POST["precio"])) {
        $error[] = "Debes introducir precio";
    }
    if (!isset($_POST["descripcion"])) {
        $error[] = "Debes introducir descripcion";
    }
    if (!isset($_POST["localizacion"])) {
        $error[] = "Debes introducir localizacion";
    }
    if (!isset($_POST["porcentaje_descuento"])) {
        $error[] = "Debes introducir un porcentaje";
    }
    if (!isset($_POST["cantidad_disponible"])) {
        $error[] = "Debes introducir cantidad";
    }
    if($_POST["cantidad_disponible"]==0){
        $error[]="Ponga una cantidad";
    }
    
    if (!isset($error)) {
        $nombre=sanitarString($_POST["nombre"]);
        $precio=sanitarString($_POST["precio"]);
        $descripcion=sanitarString($_POST["descripcion"]);
        $localizacion=sanitarString($_POST["localizacion"]);
        $porcentaje_descuento=sanitarString($_POST["porcentaje_descuento"]);
        $cantidad_disponible=sanitarString($_POST["cantidad_disponible"]);
        $id_catalogo=$_POST['id_catalogo'];
        $nombre_categoria=$_POST['nombre_categoria'];
        $hoy = getdate();
        $sql="INSERT INTO PRODUCTO VALUES('".$_POST['nombre_categoria']."','".$_POST['nombre_ca']."','".$_POST['id_catalogo']."','".$nombre.
                "','".$precio."','".$descripcion."','".$localizacion."','".$porcentaje_descuento."','0','".$cantidad_disponible."','".$cantidad_disponible."')";
        realizarQuery("grupon", $sql);
        $sql="SELECT id_producto, cantidad_total WHERE nombre='".$nombre."'";
        $result=realizarQuery("grupon", $sql);
        $datospro=mysql_fetch_array($result);
        $sql="INSERT INTO LANZAMIENTOS VALUES('$correo','$datospro[0]','$hoy','','$datospro[1]')";
        realizarQuery("grupon", $sql);
        if(isset($_POST["id_catalogo"])){
             $sql="INSERT INTO CATALOGOS VALUES('$id_catalogo','$correo','$nombre_categoria')";
        }
    }
}

if (!isset($_POST["registroCliente"]) || isset($error)) {
    if (isset($error)) {
        echo muestraErrores($error);
    }

    echo formularioCrearProducto();
}


/*
 * Esta funcion genera un formulario para que los clientes puedan registrarse en forma de string
 */

function formularioCrearProducto() {



    $form = '<form action="" method="post">' .
            'Categor&iacute;a: <select name="nombre_categoria">' .
            '<option value="viajes">Viajes</option>' .
            '<option value="entretenimiento">Entretenimiento</option>' .
            '<option value="gastronomia">Gastronom&iacute;a</option>' .
            '<option value="electronica">Electr&oacute;nica</option>' .
            '<option value="ropa">Ropa</option>' .
            '<option value="salud_belleza">Salud y belleza </option>' .
            '<option value="deporte">Deporte </option>' .
            '</select><br>' .
            'Comunidad Aut&oacute;noma: <select name="nombre_ca">' .
            '<option value="andalucia">Andalucia</option>' .
            '<option value="aragon">Arag&oacute;n</option>' .
            '<option value="asturias">Asturias</option>' .
            '<option value="canarias">Canarias</option>' .
            '<option value="cantabria">Cantabria</option>' .
            '<option value="castilla_la_mancha">Castilla La Mancha </option>' .
            '<option value="castillo_y_leon">Castilla y Le&oacute;n </option>' .
            '<option value="catalunya">Catalu&ntilde;a</option>' .
            '<option value="ceuta">Ceuta</option>' .
            '<option value="extremadura">Extremadura</option>' .
            '<option value="galicia">Galicia </option>' .
            '<option value="islas_baleares">Islas Baleares</option>' .
            '<option value="la_rioja">La Rioja</option>' .
            '<option value="madrid">Madrid</option>' .
            '<option value="melilla"> Melilla</option>' .
            '<option value="murcia">Murcia</option>' .
            '<option value="navarra">Navarra</option>' .
            '<option value="pais_vasco">Pa&iacute;s Vasco</option>' .
            '<option value="valencia">Valencia</option>' .
            '</select><br>' .
            'Cat&aacute;logo <select name="id_catalogo">' .
            '<option value=""></option>'; ///////////POR AÑADIR
    $sql = "SELECT id_catalogo, nombre FROM CATALOGO WHERE correo='$correo'";
    $result = realizarQuery('grupon', $sql);
    while ($fila = mysqli_fetch_row($result)) {
        $form .= '<option value="' . $fila[0] . '">' . $fila[1] . '</option>';
    }
    $form .= '</select><br>' .
            'Nombre: <input type="text" name="nombre" /><br/>' .
            'Precio: <input type="number" name="precio" /><br/>' .
            'Descripci&oacute;n: <textarea name="descripcion" rows="4" cols="10"></textarea><br/>' .
            'Localizaci&oacute;n: <input type="text" name="localizacion" /><br/>' .
            'Porcentaje Descuento: <input type="number" name="porcentaje_descuento" /><br/>' .
            'Cantidad Disponible: <input type="number" name="cantidad_disponible" /><br/>' .
            '<input type="submit" name="crearProducto" value="Enviar"/>' .
            '</form>';
    return $form;
}

?>