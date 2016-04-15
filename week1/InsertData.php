       <?php
       
       function addperson($fullname,$email,$address,$city,$state,$zip,$dob){

        $dsn = 'mysql:host=localhost;dbname=phpadvclassspring2016';
        $user='root';
        $pass='';
     
       try{
        $conn=new PDO($dsn,$user,$pass); // creating new php data object
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO address(fullname,email,addressline1,city,state,zip,birthday)
         VALUES ('$fullname', '$email', '$address','$city','$state','$zip','$dob')";// use exec() because no results are returned
        $conn->exec($sql);
        echo "New record created successfully";  
       } catch (PDOException $e) {
           $error_message = $e->getMessage();//we use the rocket because it will be wrong to use a dot
           echo $error_message;
           exit (); //stop processing if you can't retrive info
       }
         
       }
       ?>

        <?php
         $fullname1 =$_POST["fullname"];
         $email1 = $_POST["email"];
         $address1 = $_POST["address"];
         $city1 = $_POST["city"];
         $state1 = $_POST["state"];
         $zip1 = $_POST["zip"];
         $dob1 = $_POST["dob"];
        if(!empty($fullname1)){$fullname=$_POST["fullname"];}
        else{$fullname="Name is missing";}
        if(!empty($email1)){$email= $_POST["email"];}
        else{$email="Email is missing";}
        if($address1 !=null){$address= $_POST["address"];}
        else{$address="Address is missing";}
        if($city1 !=null){$city= $_POST["city"];}
        else{$city="City is Missing";}
        if($state1 !="Choose One"){$state= $_POST["state"];}
        else{$state="State is missing";}
        if($zip1 !=null){$zip= $_POST["zip"];}
        else{$zip="Zipcode is missing";}
        if($dob1 !=null){$dob= $_POST["dob"];}
        else{$dob="Date of birth is missing";}
        
      

         ?>
        <?php 

        echo "<h2>Your Information:</h2>";
        echo $fullname;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $address;
        echo "<br>";
        echo $city;
        echo "<br>";
        echo $state;
        echo "<br>";
        echo $zip;
        echo "<br>";
        echo $dob;
        echo "<br>";
        if($fullname !="Name is missing"){$valid="send";}
        else{$valid="notvalid";}
        if($email !="Email is missing"){$valid="send";}
        else{$valid="notvalid";}
        if($address !="Address is missing"){$valid="send";}
        else{$valid="notvalid";}
        if($city !="City is Missing"){$valid="send";}
        else{$valid="notvalid";}
        if($state !="State is missing"){$valid="send";}
        else{$valid="notvalid";}
        if($zip !="Zipcode is missing"){$valid="send";}
        else{$valid="notvalid";}
        if($dob !="Date of birth is missing"){$valid="send";}
        else{$valid="notvalid";}
        if($valid=="send"){
        //echo'<input type="button" name="submit" value="submit" onclick="addperson()">';    
        addperson($fullname,$email,$address,$city,$state,$zip,$dob);  
        }
        else{
          echo'<a href="http://localhost/AdvPhpSpring2016/week1/AddNew.php">Return</a>'; 
        }
        
        ?>
        