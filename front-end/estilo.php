<?php
header("Content-type: text/css");
session_start();
?>
*{
box-sizing: border-box;
font-family: 'Slabo 27px', sans-serif;
margin: 0;
}

.error{
width:100%;
overflow:hidden;
margin:1%;
border: 1px;
padding: 10px;
border-style: dashed;
border-color: red;
color: red;
}

header{
background-image: url('../img/banner.jpg');
height: 100px;
width: 100%;
}

nav{
background-color:#FDA231;
border-bottom-style: solid;
border-bottom-width: thin;
overflow: hidden;
height:70px;
width:100%;
}

nav ul{
text-align: center;
}
nav ul li{
display: inline;
height: 100%;
}

nav ul li a{
/*padding: 0.2em 1em;*/
padding:1%;
}

<?php
if (!isset($_SESSION['cuenta']) || $_SESSION["tipo"] != "cliente") {
    ?>
    #busqueda{
    margin-top:20px;
    margin-left:auto;
    float: left;
    margin-left: 33%;
    width: 33%;
    }

    #cuadro_busqueda{
    width:78%;
    margin-left:10%;
    margin-top:auto;
    margin-bottom:auto;
    }

    #boton_busqueda{
    width:12%;
    margin:auto;
    }
    <?php
} else {
    ?>
    #busqueda{
    margin-top: 20px;
    float: left;
    margin-left: 33%;
    width: 33%;
    }

    #cuadro_busqueda{
    width: 68%;
    margin-top: auto;
    margin-bottom: auto;
    }

    #boton_busqueda{
    min-width: 12%;
    }
    
    #checknacional{
    float: right;
    min-width: 20%;
    }
    <?php
}
?>

#icon_tray{
margin-top:20px;
float: left;
width: 33%;
}

main{
overflow: hidden;
float: left;
width: 100%;
}

aside{
overflow: hidden;
background-color: #FDA231;
border-bottom-style: solid;
border-bottom-width: thin;
border-right-style: solid;
border-right-width: thin;
border-color: black;
color: white;
float: left;
padding-bottom: 2%;
padding-left: 2%;
padding-top: 2%;
width: 20%;
}

article{
float: left;
margin-left: 2%;
margin-top: 2%;
overflow: auto;
width: 66%;
}

footer{
background-color: #FDA231;
bottom: 0;
clear: both;
font-size: 20px;
font-weight: bold;
left: 0;
right: 0;
text-shadow: 1px 1px white;
width: 100%;
}

#map-canvas{
height: 500px;
width: 500px;
}

header #logo{
float: left;
width: auto;
margin-left: auto;
margin-right: auto;
}
/*No mover de abajo del todo, por alguna razón
si lo mueves arriba NO funciona*/
@media screen and (max-width:800px) {
aside, article, #busqueda, #icon_tray{
margin: auto;
width:100%;
text-align: center;
}
}
