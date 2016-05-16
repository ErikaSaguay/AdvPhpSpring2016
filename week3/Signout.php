<?php     
         session_start();
         session_destroy();
         include './autoload.php' ;
           
         $util = new Util();
         $util->redirect('Login.php');
?>
