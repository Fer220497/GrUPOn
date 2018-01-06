<?php
    session_start();
    unset($_SESSION['cuenta']);
    unset($_SESSION['nombre']);
    unset($_SESSION['tipo']);
    //unset($_SESSION['categoria']);
    
    session_destroy();
  
    header('Location: ../front-end/index.php');  //Devuelve a la página anterior.
     
?>
