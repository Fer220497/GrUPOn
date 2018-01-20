<?php
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';
    $correo = $_SESSION['cuenta'];
    
    if(isset($_POST['borrar']) && isset($_POST['check'])){
            if($_SESSION['tipo'] == 'empresa'){
                $sql = "UPDATE producto JOIN lanzamientos ON lanzamientos.id_producto=producto.id_producto SET producto.cantidad_disponible=0 "
                        . "WHERE lanzamientos.correo='$correo'";
                realizarQuery($esquema, $sql);
            }
            $sql = "DELETE FROM cuenta WHERE correo='$correo'";
            realizarQuery($esquema, $sql);  //OP DELETE SOBRE CUENTA, CLIENTE Y EMPRESA
            header('Location: ../back-end/logout.php');
        }
    
    
    /**
     * Muestra el botón de borrar
     * @return string
     */
    function muestraFormularioBorrar(){
        return '<form class="w3-panel w3-red w3-topbar w3-bottombar w3-border-red" action="" method="post">
                    <input class="w3-btn w3-hover-pale-red w3-border w3-round"  type="submit" name="borrar" value="Borrar Cuenta"/><input class="w3-check" type="checkbox" name="check" value="Borrar"/> Marcar si est&aacute;s seguro de que quieres borrar la cuenta
                </form>';
    }

?>

