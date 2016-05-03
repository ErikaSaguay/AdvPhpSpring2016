<?php


session_start();

 if( !isset($_SESSION['userid']) ){
    $util = new Util();
    $util->redirect("Login.php");
    die('Access Restricted');       
}

           
   
 ?>