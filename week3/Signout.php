<?php     
         session_start();
         session_destroy();
         include './autoload.php' ;
           
         $util = new Util();
         $util->redirect('http://localhost/AdvPhpSpring2016/week3/Login.php');
?>
