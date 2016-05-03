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
         $hash = password_hash($pass, PASSWORD_DEFAULT);
         $created=date("Y-m-d H:i:s");
         
         
        $error = [];
        $message = [];
         
        if( $util->isPostRequest() ){

            
            if(empty($email)){
                $error['email'] = "Email is required";
            }
            if(empty($pass)){
                $error['pass'] = "Please enter password";
            }
            if(count($error) == 0 ) {
                if ( !$validator->isEmailValid($values['email']) ) {
                    $error['emailRegex'] = 'email is invalid';    
                }else {
                    
                if($add->unique($values) === true ){
                    $error['exists'] = "already exists";
                }else{
                    $add->create($values, $hash ,$created);
                    $message['success'] = "Successfully added";

                }

                } 
            }

        }
        
        ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <h3>Sign Up</h3>
        <form action="#" method="post">
            <?php include './userTemp/errors.php';  ?>
            <?php if( isset($message['success']) ): ?>
            <span><?php echo $message['success']; ?></span>
            <?php endif; ?>
            <?php echo'<a href="Login.php">Login</a>'; ?>
            <p>Email:</p>
            <input type="text" name="email"><br>
            <p>Password:</p>
            <input type="password" name="password"><br><br>
            
            <input type="submit" name="submit" value="signup" >
        </form>

        
    </body>
    
    
</html>
