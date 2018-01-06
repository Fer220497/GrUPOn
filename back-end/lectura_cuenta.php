<?php
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

    $correo = $_SESSION['cuenta'];
    
    function muestraCuenta(){
        global $correo;
        global $esquema;
        
        if($_SESSION['tipo'] === 'cliente'){
            $sql = "SELECT * FROM CUENTA,CLIENTE WHERE CUENTA.CORREO='$correo' AND CLIENTE.CORREO='$correo'";
            $result = realizarQuery($esquema, $sql);
            $fila = mysqli_fetch_array($result);    //OP READ SOBRE CLIENTE
            $string = muestraDatosCliente($fila);
        }else{
            $sql = "SELECT * FROM CUENTA,EMPRESA WHERE EMPRESA.CORREO='$correo' AND CUENTA.CORREO='$correo'";
            $result = realizarQuery($esquema, $sql);
            $fila = mysqli_fetch_array($result);    //OP READ SOBRE EMPRESA
            $string = muestraDatosEmpresa($fila);
        } 
        return $string;
    }
    
    
    /**
     * Muestra los datos del cliente.
     * @param type $arrayClientes
     */
    function muestraDatosCliente($fila){
        global $arrayComunidades;
        return '<table border="1"><tr><td>Correo</td><td><span class="dato">' . $_SESSION['cuenta'] . '</span></td></tr>' . 
                '<tr><td>Comunidad Aut&oacute;noma</td><td>'.$arrayComunidades[$fila['nombre_ca']].'</td></tr>'.
               '<tr><td>Nombre</td><td><span class="dato">' . $_SESSION['nombre'] . '</span></td>' .
               '<tr><td>Apellidos</td><td><span class="dato">' . $fila['apellidos_cliente'] . '</span></td></table>';
    }
    
    /**
     * Muestra los datos de la empresa
     * @param type $arrayEmpresas
     */
    function muestraDatosEmpresa($fila){
        global $esquema;
        global $arrayComunidades;
        return '<table border="1"><tr><td>Correo</td><td><span class="dato">' . $_SESSION['cuenta'] . '</span></td></tr>' .
                '<tr><td>Comunidad Aut&oacute;noma</td><td>'.$arrayComunidades[$fila['nombre_ca']].'</td></tr>'.
               '<tr><td>Nombre</td><td><span class="dato">' . $_SESSION['nombre'] . '</span></td>' .
               '<tr><td>Direcci&oacute;n</td><td><span class="dato">' . $fila['direccion_empresa'] . '</span></td>' .
               '<tr><td>NIF</td><td><span class="dato">' . $fila['nif_empresa'] . '</span></td>' .
               '<tr><td>Web</td><td><span class="dato">' . $fila['web_empresa'] . '</span></td>' .
               '<tr><td>Cuenta Bancaria</td><td><span class="dato">' . $fila['cuenta_bancaria'] . '</span></td>' .
               '<tr><td>Tel&eacute;fono</td><td><span class="dato">' . $fila['telefono_empresa'] . '</span></td>' .
               '<tr><td>Email para Clientes</td><td><span class="dato">' . $fila['email_empresa'] . '</span></td></table>' ;
        
    }
    
    /**
     * Muestra los datos de la empresa
     * @param type $arrayEmpresas
     */
    function muestraDatosEmpresaMapa($correo){
        global $esquema;
        global $arrayComunidades;
        $sql = "SELECT * FROM EMPRESA WHERE CORREO='$correo'";
        return '<input type=hidden id="localizacion" value="'.$fila['direccion_empresa'].'"/>'
            . '<table border="1"><tr><td>Correo</td><td><span class="dato">' . $_SESSION['cuenta'] . '</span></td></tr>' .
               '<tr><td>Comunidad Aut&oacute;noma</td><td>'.$arrayComunidades[$fila['nombre_ca']].'</td></tr>'.
               '<tr><td>Nombre</td><td><span class="dato">' . $_SESSION['nombre'] . '</span></td>' .
               '<tr><td>NIF</td><td><span class="dato">' . $fila['nif_empresa'] . '</span></td>' .
               '<tr><td>Web</td><td><span class="dato">' . $fila['web_empresa'] . '</span></td>' .
               '<tr><td>Cuenta Bancaria</td><td><span class="dato">' . $fila['cuenta_bancaria'] . '</span></td>' .
               '<tr><td>Tel&eacute;fono</td><td><span class="dato">' . $fila['telefono_empresa'] . '</span></td>' .
               '<tr><td>Email para Clientes</td><td><span class="dato">' . $fila['email_empresa'] . '</span></td>' .
               '<tr><td>Direcci&oacute;n</td><td><span class="dato">' . $fila['direccion_empresa'] . '</span></td>' . 
               '<tr><td><div id="map-canvas"></div></td></tr></table>';
}
?>