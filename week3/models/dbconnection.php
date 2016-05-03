<?php
        $dsn = 'mysql:host=localhost;dbname=phpadvclassspring2016';
        $user='advphp';
        $pass='php';
     
       try{
        $conn=new PDO($dsn,$user,$pass); // creating new php data object
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch (PDOException $e) {
           $error_message = $e->getMessage();//we use the rocket because it will be wrong to use a dot
           echo $error_message;
           exit (); //stop processing if you can't retrive info
       }
         
       
?>