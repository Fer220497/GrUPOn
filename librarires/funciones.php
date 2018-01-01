<?php
        /**
         * Función que genera un HTML con un array de errores 
         * (el array de errores debe contener unicamente strings)
         * @param string $error
         * @return string
         */
        function muestraErrores($error){
            $bloqueHTML = '<div class="error"><h1>Se han producido los siguientes errores:</h1><ul>';
            foreach($error as $err){
                $bloqueHTML .= "<li>$err</li>";
            }
            $bloqueHTML .= '</ul></div>';
            return $bloqueHTML;          
        }
        
        /**
         * Función que realiza una query sobre una base de datos y retorna el resultado.
         * @param string $dir
         * @param string $usr
         * @param string $pass
         * @param string $esquema
         * @param string $query
         * @return result
         */
        function realizarQuery($dir, $usr, $pass, $esquema, $query){
            $con = mysqli_connect($dir,$usr,$pass);
            if(!$con){
                die('No se puede conectar con la DB' . mysqli_error($con));
            }
            $db = mysqli_select_db($con, $esquema);
            if(!$db){
                mysqli_close($con);
                die('No se puede conectar con el esquema' . mysqli_error($con));
            }
            $result = mysqli_query($con, $query);
            mysqli_close($con);
            if(!$result){
                echo $query;
                //NO SE HA PODIDO EJECUTAR LA CONSULTA
                die('No se puedo obtener resultado' . mysqli_error($con)); 
            }
            return $result;
        }
        
        /**
         * Función que sanea un string para escapar caracteres peligrosos.
         * @param string $dir
         * @param string $usr
         * @param string $pass
         * @param string $string
         * @return string
         */
        function sanitarString($dir, $usr, $pass, $string){
            $con = mysqli_connect($dir, $usr, $pass);
            $string = mysqli_escape_string($con, $string);
            return $string;
        }

        /**
         * Esta funcion genera un login en forma de string
         * @return string
         */
        function formularioLogin() {
            $form = ' <form action="" method="post">' .
                    ' Correo: <input type="text" name="correo" >' .
                    ' Contraseña: <input type="password" name="contraseña" >' .
                    ' <input type="submit" name="login" value="Enviar">' .
                    ' </form>' ;
            return $form;
        }
    ?>