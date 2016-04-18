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
        include './autoload.php';
        $util = new Util();
        $add = new Functions();
        $validator = new Validator();
        $values =  filter_input_array(INPUT_POST);// this gets the values
        
        // getting values
        $fullname = $values['fullname'];
        $email = $values['email'];
        $address = $values['address'];
        $city = $values['city'];
        $state = $values['state'];
        $zip = $values['zip'];
        $dob = $values['dob'];
        
        // creating arrays for error and messages
        $error = [];
        $message = [];
        
        
        if ( $util->isPostRequest() ) {
           if(empty($fullname)){
               $error['fullname'] = "Name is required";
           }else if ( empty($email) ){
               $error['email']  = "Email is required";
           }else if ( empty($address) ){
               $error['address'] = "Address is required";
           }else if ( empty($city) ){
               $error['city'] = "City is required";
           }else if( empty($state) ){
               $error['state'] = "State required";
           }else if(empty($zip)){
               $error['zip']= "Zipcode Required";
           }else if( empty($dob)){
               $error['dob'] = "Date of birth required";
           } else if ( !$validator->isEmailValid($values['email']) ) {
                $error['emailregex'] = 'Email is InValid';
            // validate email
           }else if( !$validator->isZipValid($values['zip'])){
               $error['zipregex'] = 'Zip is Invalid';
           }
           if(count($error)==0){
              $add->addPerson($values); 
              if($add.equals(false)){
                  $message['added']='was added';
              }
           }
        
        }

        ?>
        <?php
        
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
        <?php  echo $message['success']; ?>
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
            <span class="error">* <?php echo $error['state']; ?></span>	
            <p>Zip</p>
            <input class="textboxes" name="zip" type="text" value="<?php echo $zip; ?>">
            <span class="error">* <?php echo $error['zip']; ?></span>
            <span class="error">* <?php echo $error['zipRegex']; ?></span>
            <p>BirthDay</p>
            <input class="textboxes" name="dob" type="date" value="<?php echo $dob; ?>">
            <span class="error">* <?php echo $error[dob]; ?></span>
            <br><br>
            <input id="button"  type="submit" name='submit' value="submit" >
            </script>
        </form>

    </body>
</html>