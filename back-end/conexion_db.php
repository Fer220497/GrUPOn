<?php
        /**
         * Función que realiza una query sobre una base de datos y retorna el resultado.
         * @param string $esquema
         * @param string $query
         * @return result
         */
        function realizarQuery($esquema, $query){
            $con = mysqli_connect("localhost", "root", "");
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
                die('No se pudo obtener resultado' . mysqli_error($con)); 
            }
            return $result;
        }
        
        /**
         * Función que sanea un string para escapar caracteres peligrosos.
         * @param string $string
         * @return string
         */
        function sanitarString($string){
            $con = mysqli_connect("localhost", "root", "");
            $string = mysqli_escape_string($con, $string);
            return $string;
        }
?>