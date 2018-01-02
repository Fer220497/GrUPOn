<?php
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';
    
    $correo = $_SESSION['cuenta'];
    if($_SESSION['tipo'] === 'cliente'){
        $sql = "SELECT * FROM CUENTA,CLIENTE WHERE CUENTA.CORREO='$correo' AND CLIENTE.CORREO='$correo'";
        $result = realizarQuery('grupon', $sql);
        $fila = mysqli_fetch_array($result);
        echo muestraDatosCliente($fila);
    }else{
        $sql = "SELECT * FROM CUENTA,EMPRESA WHERE EMPRESA.CORREO='$correo' AND CUENTA.CORREO='$correo'";
        $result = realizarQuery('grupon', $sql);
        $fila = mysqli_fetch_array($result);
        echo muestraDatosEmpresa($fila);
    }
    
    if(isset($_POST['borrar']) && isset($_POST['check'])){
        $sql = "DELETE FROM CUENTAS WHERE CORREO='$correo'";
        header('Location: ../back-end/logout.php');
    }
    
    echo muestraFormularioBorrar();
    
    /**
     * Muestra los datos del cliente.
     * @param type $arrayClientes
     */
    function muestraDatosCliente($fila){
        return '<table border="1"><tr><td>Correo</td><td><span class="dato">' . $_SESSION['cuenta'] . '</span></td></tr>' . 
               '<tr><td>Nombre</td><td><span class="dato">' . $_SESSION['nombre'] . '</span></td>' .
               '<tr><td>Apellidos</td><td><span class="dato">' . $fila['apellidos_cliente'] . '</span></td></table>';
    }
    
    /**
     * Muestra los datos de la empresa
     * @param type $arrayEmpresas
     */
    function muestraDatosEmpresa($fila){
        return '<table border="1"><tr><td>Correo</td><td><span class="dato">' . $_SESSION['cuenta'] . '</span></td></tr>' . 
               '<tr><td>Nombre</td><td><span class="dato">' . $_SESSION['nombre'] . '</span></td>' .
               '<tr><td>Direcci&oacute;n</td><td><span class="dato">' . $fila['direccion_empresa'] . '</span></td>' .
               '<tr><td>NIF</td><td><span class="dato">' . $fila['nif_empresa'] . '</span></td>' .
               '<tr><td>Web</td><td><span class="dato">' . $fila['web_empresa'] . '</span></td>' .
               '<tr><td>Cuenta Bancaria</td><td><span class="dato">' . $fila['cuenta_bancaria'] . '</span></td>' .
               '<tr><td>Tel&eacute;fono</td><td><span class="dato">' . $fila['telefono_empresa'] . '</span></td>' .
               '<tr><td>Email para Clientes</td><td><span class="dato">' . $fila['email_empresa'] . '</span></td></table>' ;
        
    }
    
    /**
     * Muestra el botón de borrar
     * @return string
     */
    function muestraFormularioBorrar(){
        return '<form action="" method="post">
                    <input type="submit" name="borrar" value="Borrar Cuenta"/> Marcar si est&aacute;s seguro de que quieres borrrar la cuenta <input type="checkbox" name="check" value="Borrar"/>
                </form>';
        
    }

?>

