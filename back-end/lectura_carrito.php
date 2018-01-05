<?php

require_once '../back-end/lectura_producto.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */





if(isset($_POST["pagar"])){
    $cookiecarrito=explode(",",$_COOKIE["carrito"]);
    echo "<br/> Vas a comprar:<br/>";
     print_r($cookiecarrito);
     echo "<br/>";
     foreach ($cookiecarrito as $producto){
         $sql="SELECT * FROM PRODUCTO WHERE id_producto='$producto'";
         $result=realizarQuery($esquema, $sql);
         $datos_producto = mysqli_fetch_array($result);
         $cantidad_vendida=$datos_producto["cantidad_vendida"]+1;
         $cantidad_disponible=$datos_producto["cantidad_disponible"]-1;
         $sql="UPDATE PRODUCTO SET cantidad_vendida='$cantidad_vendida', cantidad_disponible='$cantidad_disponible' ";
         realizarQuery($esquema, $sql);
         $sql="SELECT * FROM LANZAMIENTOS WHERE id_producto='$producto'";
         $result=realizarQuery($esquema, $sql);
         $datos_lanzamiento=mysqli_fetch_array($result);
         $num_ventas=$datos_lanzamiento["num_ventas"]+1;
         if($cantidad_disponible==0){
             $sql="UPDATE LANZAMIENTOs SET num_ventas='$num_ventas', fecha_fin=curdate()";
             realizarQuery($esquema, $sql);
         }else{
             $sql="UPDATE LANZAMIENTOS SET num_ventas='$num_ventas'";
             realizarQuery($esquema, $sql);
         }
     }
    
}


function mostrarBotonPagar(){
    $form = '<form action="" method="post" >' .
            '<input type="submit" name="pagar" value="Comprar">';
    return $form;
            
}
function mostrarBotonCompra(){
    echo '<button type="submit" onclick="location.href = \'pantalla_compra.php\'">Comprar</button>';
    
}
//<button type="submit" onclick="location.href = 'creacion_catalogo.php'">Crear Cat&aacute;logo</button> 

function mostrarCarrito() {
    
    global $esquema;
    $productos = explode(",", $_COOKIE["carrito"]);
    $contador=0;
   
    foreach ($productos as $key => $producto) {
        
        echo muestraProducto($producto);
        echo '<button href="mostrar_carrito.php" onclick="removeCarrito(\''.$producto.'\',\''.$contador.'\')">Eliminar del carrito</button>';
        $contador++;
    }
    
        $precio=0;
        $productos = explode(",", $_COOKIE["carrito"]);
        foreach ($productos as $id_producto) {
            $query = "SELECT * FROM PRODUCTO WHERE ID_PRODUCTO='$id_producto'";
            $result = realizarQuery($esquema, $query);
            $fila = mysqli_fetch_array($result);
            $precio += $fila['precio'] - ($fila['precio'] * ($fila['porcentaje_descuento'] / 100));
        }
        echo "<br/>El coste total de la compra es de: $precio &euro;<br/>";
}
