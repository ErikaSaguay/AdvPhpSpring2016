<?php

session_start();

 if( !isset($_SESSION['userid']) ){
  $util = new Util();  
    $util->redirect('Home.php');
    die('Access Restricted');       
}

           
   
 ?>