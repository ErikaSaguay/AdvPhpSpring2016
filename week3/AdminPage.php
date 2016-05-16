<!DOCTYPE HTML>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head> 
    <body>
        <?php
        include './autoload.php' ;
        include './userTemp/AccessRestriction.php';
         

         if($_SESSION['userid'] != NULL){
             
            $email = $_SESSION['email'];
            
            $util = new Util();
            echo'welcome :'. $email.'<br>';
            echo'<a href="Signout.php">Signout</a>';
         }
        
       
         ?>
    </body>
</html>