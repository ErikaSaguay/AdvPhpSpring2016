<!DOCTYPE HTML>
<html>
    <head>
        <title></title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>
    <body>
        <?php
        include './autoload.php';
         $util = new Util();
         $log = new Functions();
         $validator = new Validator();
         $add = new Functions();
         $values = filter_input_array(INPUT_POST);
         $email = $values['email'];
         $pass = $values['password'];
        $created=date("Y-m-d H:i:s");
         $error = [];
        if( $util->isPostRequest() ){

            
            if(empty($email){
                $error['email'] = "Email is required";
            }
            if(empty($_POST["password"])){
                $error['pass'] = "Please enter password";
            }
            else {
                if ( !$validator->isEmailValid($values['email']) ) {
                    $error['emailRegex'] = 'email is invalid';    
                }else {
                    $add->unique($values);

                if($add == true){
                    $error['exists'] = "already exists";
                }else{
                    $add->create($values);
                    $message['success'] = "Successfully added";

                }

                } 
            }

        }
        
        ?>
        <h3>Sign Up</h3>
        <form actio="#" method="post">
            <span><?php echo $error['pass']; ?></span>
            <span><?php echo $error['email']; ?></span>
            <span><?php echo $error['emailRegex']; ?></span>
            <span><?php echo $message['success']; ?></span>
            <p>Email:</p>
            <input type="text" name="email"><br>
            <p>Password:</p>
            <input type="password" name="password"><br><br>
            <input type="submit" name="submit" value="signup" >
        </form>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </body>
    
    
</html>
