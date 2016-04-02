   <!DOCTYPE HTML>
    <html>
    <head>
    <title>Assignment1Add</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>
    <body><?php 
    //regex
    $emailregex = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
     $zipregex="/^[0-9]{5}([- ]?[0-9]{4})?$/";
     //clear information
    $fullname=$email=$address=$city=$state=$zip=$dob=$comment=$fullnameErr=$emailErr=$addressErr=$cityErr=$stateErr=
    $zipErr=$dobErr=$emailRegexErr=$zipRegexErr=$emailtest=$ziptest=$fullnametest=$citytest="";       
     
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       //name
       if (empty($_POST["fullname"])) {
         $fullnameErr = "Name is required";
       } else {
         $fullnametest = test_input($_POST["fullname"]);
         $fullname=preg_replace('/[0-9]+/', '', $fullnametest);
       }
       //email
       if (empty($_POST["email"])) {
         $emailErr = "Email is required";
       } else {
           $emailtest=$_POST["email"];
           if ( !preg_match($emailregex, $emailtest) ) {
                $emailRegexErr = 'email is invalid';    
           }else {
               $email = test_input($_POST["email"]); 
           } 
       }
       //address
       if (empty($_POST["address"])) {
         $addressErr= "Address is required";
       } else {
         $address = test_input($_POST["address"]); 
       }
       //city
       if (empty($_POST["city"])) {
         $cityErr = "City is required";
       } else {
         $citytest = test_input($_POST["city"]);
         $city=preg_replace('/[0-9]+/', '', $citytest);
       }
       //state
       if ($_POST["state"]=="Choose One") {
         $stateErr = "State required";
       } else {
         $state = test_input($_POST["state"]);
       }
       //zip
        if (empty($_POST["zip"])) {
         $zipErr = "Zipcode Required";
        } else {
            $ziptest=$_POST["zip"];
            if ( !preg_match($zipregex, $ziptest) ) {
               $zipRegexErr = 'zip is invalid';    
            }else { 
               $zip = test_input($_POST["zip"]); 
            }
        }
       //dob
        if (empty($_POST["dob"])) {
         $dobErr = "Date of birth required";
       } else {
         $dob = test_input($_POST["dob"]);
       }
    }
    
    function test_input($data) {
        $data = trim($data);//trims data from any whitespace 
        $data = stripslashes($data);//strips slashes
        $data = htmlspecialchars($data);//strips special characters
        return $data;
        
    }
  

    ?>

     <?php
     //connecting to the database and seding the information
       function addperson($fullname,$email,$address,$city,$state,$zip,$dob){ 
        $dsn = 'mysql:host=localhost;dbname=phpadvclassspring2016';
        $user='advphp';
        $pass='php';
     
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
        <a href="http://localhost/AdvPhpSpring2016/week1/Assignment1/Index.php">Return</a>
        <p><span class="error">* required field.</span></p>
        <form id="myform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <p>Full Name</p>
        <input id="fullname" name="fullname" type="text">
        <span class="error">* <?php echo $fullnameErr;?></span>
        <p>Email</p>
        <input name="email" type="text" >
        <span class="error">* <?php echo $emailErr;?></span>
        <span class="error">* <?php echo $emailRegexErr;?></span>
        <p>Address</p>
        <input name="address" type="text" >
        <span class="error">* <?php echo $addressErr;?></span>
        <p>City</p>
        <input name="city" type="text" >
        <span class="error">* <?php echo $cityErr;?></span>
        <p>State</p>
        <select id="state" name="state">
        <option  value="Choose One">Choose One</option>
	<option  value="AL">Alabama</option>
	<option  value="AK">Alaska</option>
	<option  value="AZ">Arizona</option>
	<option  value="AR">Arkansas</option>
	<option  value="CA">California</option>
	<option  value="CO">Colorado</option>
	<option  value="CT">Connecticut</option>
	<option  value="DE">Delaware</option>
	<option  value="DC">District Of Columbia</option>
	<option  value="FL">Florida</option>
	<option  value="GA">Georgia</option>
	<option  value="HI">Hawaii</option>
	<option  value="ID">Idaho</option>
	<option  value="IL">Illinois</option>
	<option  value="IN">Indiana</option>
	<option  value="IA">Iowa</option>
	<option  value="KS">Kansas</option>
	<option  value="KY">Kentucky</option>
	<option  value="LA">Louisiana</option>
	<option  value="ME">Maine</option>
	<option  value="MD">Maryland</option>
	<option  value="MA">Massachusetts</option>
	<option  value="MI">Michigan</option>
	<option  value="MN">Minnesota</option>
	<option  value="MS">Mississippi</option>
	<option  value="MO">Missouri</option>
	<option  value="MT">Montana</option>
	<option  value="NE">Nebraska</option>
	<option  value="NV">Nevada</option>
	<option  value="NH">New Hampshire</option>
	<option  value="NJ">New Jersey</option>
	<option  value="NM">New Mexico</option>
	<option  value="NY">New York</option>
	<option  value="NC">North Carolina</option>
	<option  value="ND">North Dakota</option>
	<option  value="OH">Ohio</option>
	<option  value="OK">Oklahoma</option>
	<option  value="OR">Oregon</option>
	<option  value="PA">Pennsylvania</option>
	<option  value="RI">Rhode Island</option>
	<option  value="SC">South Carolina</option>
	<option  value="SD">South Dakota</option>
	<option  value="TN">Tennessee</option>
	<option  value="TX">Texas</option>
	<option  value="UT">Utah</option>
	<option  value="VT">Vermont</option>
	<option  value="VA">Virginia</option>
	<option  value="WA">Washington</option>
	<option  value="WV">West Virginia</option>
	<option  value="WI">Wisconsin</option>
	<option  value="WY">Wyoming</option>
        </select>
        <span class="error">* <?php echo $stateErr;?></span>	
        <p>Zip</p>
        <input name="zip" type="text" >
        <span class="error">* <?php echo $zipErr;?></span>
        <span class="error">* <?php echo $zipRegexErr;?></span>
        <p>BirthDay</p>
        <input name="dob" type="date" >
        <span class="error">* <?php echo $dobErr;?></span>
        <br><br>
        <input type="submit" name='submit' value="submit" onclick="<?php addperson($fullname, $email, $address, $city, $state, $zip, $dob) ?>"  >
        
       
        </form>
        <?php 

        echo "<h2>Your Information:</h2>";
        echo $fullname;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $city;
        echo "<br>";
        echo $state;
        echo "<br>";
        echo $zip;
        echo "<br>";
        echo $dob;
        echo "<br>";



        //addperson($fullname, $email, $address, $city, $state, $zip, $dob);
        ?>
    </body>
    </html>