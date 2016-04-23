<!DOCTYPE HTML>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head> 
    <body>
        <?php     
         session_start();
         $email=$_SESSION['email']; 
         include './autoload.php' ; 
         $util = new Util();
         echo'welcome :'. $email.'<br>';
         echo'<a href="http://localhost/AdvPhpSpring2016/week3/Signout.php">Signout</a>';
         ?>
    </body>
</html>