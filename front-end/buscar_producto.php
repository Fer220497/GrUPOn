
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"/>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="../back-end/funciones.js"></script>
    </head>
    <body>
        <script>
            $("#cookie").append(document.createTextNode(getCookie("categoria")));
        </script>    
        
        <?php require_once '../back-end/formulario_busqueda_producto.php'; echo menuCategorias();?>

    </body>
</html>
