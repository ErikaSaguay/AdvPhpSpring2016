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
            else if(empty($pass)){
                $error['pass'] = "Please enter password";
            }
            else {
                if ( !$validator->isEmailValid($values['email']) ) {
                    $error['emailRegex'] = 'email is invalid';    
                }else {
                    $add->unique($values);
                if($add == false){
                    $error['exists'] = "already exists";
                }else{
                    $add->create($values, $hash ,$created);
                    $message['success'] = "Successfully added";

                }

                } 
            }

        }
        
        ?>
        <h3>Sign Up</h3>
        <form action="#" method="post">
            <?php if( isset($error['pass']) ): ?>
            <span><?php echo $error['pass']; ?></span>
            <?php endif; ?>
            <?php if( isset($error['email']) ): ?>
            <span><?php echo $error['email']; ?></span>
            <?php endif; ?>
            <?php if( isset($error['emailRegex']) ): ?>
            <span><?php echo $error['emailRegex']; ?></span>
            <?php endif; ?>
            <?php if( isset($error['exists']) ): ?>
            <span><?php echo $error['exists']; ?></span> 
            <?php endif; ?>
            <?php if( isset($message['success']) ): ?>
            <span><?php echo $message['success']; ?></span>
            <?php endif; ?>
            <?php echo'<a href="http://localhost/AdvPhpSpring2016/week3/Login.php">Login</a>'; ?>
            <p>Email:</p>
            <input type="text" name="email"><br>
            <p>Password:</p>
            <input type="password" name="password"><br><br>
            
            <input type="submit" name="submit" value="signup" >
        </form>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </body>
    
    
</html>
