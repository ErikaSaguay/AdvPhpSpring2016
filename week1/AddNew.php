<!DOCTYPE HTML>
<html>
    <head>
        <title>Assignment1Add</title>
        <style>
            #myform{background-color:rgb(176,224,230);}
            .textboxes{position: relative; left:45%;}
            p{position:relative; left:45%;}
            .error{position:relative; left:45%;}
            #link{position:relative; left:45%;}
            #button{position:relative; left:45%;}
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>
    <body>
        <?php
        //regex
        $zipregex = "/^[0-9]{5}([- ]?[0-9]{4})?$/";
        //clear information
        $fullname = $email = $address = $city = $state = $zip = $dob = $comment = $fullnameErr = $emailErr = $addressErr = $cityErr = $stateErr = $zipErr = $dobErr = $emailRegexErr = $zipRegexErr = $emailtest = $ziptest = $fullnametest = $citytest = "";

$error=[];


            $fullname =  filter_input(INPUT_POST, 'fullname');
            $email =  filter_input(INPUT_POST, 'email');
            $address =  filter_input(INPUT_POST, 'address');
            $city =  filter_input(INPUT_POST, 'city');
            $state =  filter_input(INPUT_POST, 'state');
            $zip =  filter_input(INPUT_POST, 'zip');
            $dob =  filter_input(INPUT_POST, 'dob');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //name
            if (empty($fullname)) {
                $error['fullname'] = "Name is required";
            } 
            //email
            if ( filter_var($email, FILTER_VALIDATE_EMAIL) === false ){
                $error['email']  = "Email is required";
            } 
            
            //address
            if (empty($address)) {
 
                $error['address'] = "Address is required";
            }
            //city
            if (empty($city)) {
                $error['city'] = "City is required";
            } 
            //state
            if ($state=='Choose One') {
                $error['state'] = "State required";
            } 
            //zip
            if (empty($zip)) {
                $zipErr = "Zipcode Required";
            } 
            //dob
            if (empty($dob)) {
                $dobErr = "Date of birth required";
            }
            
            if(count($error)==0){
               addperson($fullname, $email, $address, $city, $state, $zip, $dob);   
                 
            }
            
        
        }

        ?>
        <?php

        function addperson($fullname, $email, $address, $city, $state, $zip, $dob) {

            $dsn = 'mysql:host=localhost;dbname=phpadvclassspring2016';
            $user = 'root';
            $pass = '';

            try {
                $conn = new PDO($dsn, $user, $pass); // creating new php data object
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO address(fullname,email,addressline1,city,state,zip,birthday)
         VALUES ('$fullname', '$email', '$address','$city','$state','$zip','$dob')"; // use exec() because no results are returned
                $conn->exec($sql);
                echo "New record created successfully";
            } catch (PDOException $e) {
                $error_message = $e->getMessage(); //we use the rocket because it will be wrong to use a dot
                echo $error_message;
                exit(); //stop processing if you can't retrive info
            }
        }
        
       $us_state_abbrevs_names = array(
        'CO'=>'Choose One',
	'AL'=>'ALABAMA',
	'AK'=>'ALASKA',
	'AS'=>'AMERICAN SAMOA',
	'AZ'=>'ARIZONA',
	'AR'=>'ARKANSAS',
	'CA'=>'CALIFORNIA',
	'CO'=>'COLORADO',
	'CT'=>'CONNECTICUT',
	'DE'=>'DELAWARE',
	'DC'=>'DISTRICT OF COLUMBIA',
	'FM'=>'FEDERATED STATES OF MICRONESIA',
	'FL'=>'FLORIDA',
	'GA'=>'GEORGIA',
	'GU'=>'GUAM GU',
	'HI'=>'HAWAII',
	'ID'=>'IDAHO',
	'IL'=>'ILLINOIS',
	'IN'=>'INDIANA',
	'IA'=>'IOWA',
	'KS'=>'KANSAS',
	'KY'=>'KENTUCKY',
	'LA'=>'LOUISIANA',
	'ME'=>'MAINE',
	'MH'=>'MARSHALL ISLANDS',
	'MD'=>'MARYLAND',
	'MA'=>'MASSACHUSETTS',
	'MI'=>'MICHIGAN',
	'MN'=>'MINNESOTA',
	'MS'=>'MISSISSIPPI',
	'MO'=>'MISSOURI',
	'MT'=>'MONTANA',
	'NE'=>'NEBRASKA',
	'NV'=>'NEVADA',
	'NH'=>'NEW HAMPSHIRE',
	'NJ'=>'NEW JERSEY',
	'NM'=>'NEW MEXICO',
	'NY'=>'NEW YORK',
	'NC'=>'NORTH CAROLINA',
	'ND'=>'NORTH DAKOTA',
	'MP'=>'NORTHERN MARIANA ISLANDS',
	'OH'=>'OHIO',
	'OK'=>'OKLAHOMA',
	'OR'=>'OREGON',
	'PW'=>'PALAU',
	'PA'=>'PENNSYLVANIA',
	'PR'=>'PUERTO RICO',
	'RI'=>'RHODE ISLAND',
	'SC'=>'SOUTH CAROLINA',
	'SD'=>'SOUTH DAKOTA',
	'TN'=>'TENNESSEE',
	'TX'=>'TEXAS',
	'UT'=>'UTAH',
	'VT'=>'VERMONT',
	'VI'=>'VIRGIN ISLANDS',
	'VA'=>'VIRGINIA',
	'WA'=>'WASHINGTON',
	'WV'=>'WEST VIRGINIA',
	'WI'=>'WISCONSIN',
	'WY'=>'WYOMING',
	'AE'=>'ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST',
	'AA'=>'ARMED FORCES AMERICA (EXCEPT CANADA)',
	'AP'=>'ARMED FORCES PACIFIC'
);
        ?>


        <a id="link" href="http://localhost/AdvPhpSpring2016/week1/Index.php">Return</a>
        <p><span class="error">* required field.</span></p>
        <form id="myform" action="#" method="post">
            <p>Full Name</p>
            <input class="textboxes" name="fullname" type="text" value="<?php echo $fullname; ?>">
            <?php if( isset($error['fullname']) ): ?>
                <span class="error">* <?php echo $error['fullname']; ?></span>
            <?php endif; ?>
            <p>Email</p>
            <input class="textboxes" name="email" type="text" value="<?php echo $email; ?>">
             <?php if( isset($error['email']) ): ?>
                <span class="error">* <?php echo $error['email']; ?></span>
            <?php endif; ?>
            <p>Address</p>
            <input class="textboxes" name="address" type="text" value="<?php echo $address; ?>" >
            <?php if( isset($error['address']) ): ?>
            <span class="error">* <?php echo $error['address']; ?></span>
            <?php endif;?>
            <p>City</p>
            <input class="textboxes" name="city" type="text" value="<?php echo $city; ?>" >
            <?php if( isset($error['city']) ): ?>
            <span class="error">* <?php echo $error['city']; ?></span>
            <?php endif; ?>
            <p>State</p>
            <select class="textboxes" name="state" >
               <?php foreach ($us_state_abbrevs_names as $key => $value): ?>
                <option 
                    value="<?php echo $key; ?>"
                    <?php if( $key == $state ): ?>
                        selected="selected" 
                    <?php endif; ?>
                    ><?php echo $value; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="error">* <?php echo $stateErr; ?></span>	
            <p>Zip</p>
            <input class="textboxes" name="zip" type="text" value="<?php echo $zip; ?>">
            <span class="error">* <?php echo $zipErr; ?></span>
            <span class="error">* <?php echo $zipRegexErr; ?></span>
            <p>BirthDay</p>
            <input class="textboxes" name="dob" type="date" value="<?php echo $dob; ?>">
            <span class="error">* <?php echo $dobErr; ?></span>
            <br><br>
            <input id="button"  type="submit" name='submit' value="submit" >
            </script>
        </form>

    </body>
</html>