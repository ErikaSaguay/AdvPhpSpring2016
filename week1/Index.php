<!DOCTYPE html>
<html>
    <head>
        <title>Assignment1</title>
    </head>
    <body>
     <body>
         <a href="http://localhost/AdvPhpSpring2016/week1/Assignment1/AddNew.php">Add New User</a>
         <h1>Results</h1>
             
    <?php
        $dsn = 'mysql:host=localhost;dbname=phpadvclassspring2016';
        $user='advphp';
        $pass='php';
     
       try{
           $db=new PDO($dsn,$user,$pass); // creating new php data object

       } catch (PDOException $e) {
           $error_message = $e->getMessage();//we use the rocket because it will be wrong to use a dot
           echo $error_message;
           exit (); //stop processing if you can't retrive info
       } // whatever expetion we throw it will get so far it does nothing
        $db;
        $sql = "SELECT * FROM address";
        $results =$db->query($sql);
        foreach($results as $result){
            echo"<table>";
            echo"<tr><th>Name</th><th>Email</th><th>Address</th><th>City</th><th>State</th><th>Zip</th><th>DOB</th></tr>";
            echo "<tr>";
            echo "<td>" . $result['fullname'] . "</td>";
            echo "<td>" . $result['email'] . "</td>";
            echo "<td>" . $result['addressline1'] . "</td>";
            echo "<td>" . $result['city'] . "</td>";
            echo "<td>" . $result['state'] . "</td>";
            echo "<td>" . $result['zip'] . "</td>";
            echo "<td>" . $result['birthday'] . "</td>";
            echo "</tr>";
            echo"</table>";
        }
    ?>
        
    </body>
    
</html>