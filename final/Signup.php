<!DOCTYPE HTML>
<html>
    <head>
        <title>Meme Generator</title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
         <link rel="stylesheet" href="css/home.css">
    </head>
    
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
        <body>
        <nav>
           <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="Signup.php">Sign up</a></li>
            <li><a href="Login.php">Login</a></li>
           </ul>
        </nav>
        <h3>Sign Up</h3>
        
        <div class='content'>
        <form action="#" method="post">
            <?php include './userTemp/errors.php';  ?>
            <?php if( isset($message['success']) ): ?>
            <span><?php echo $message['success']; ?></span>
            <?php endif; ?>
            
            <p>Email:</p>
            <input type="text" name="email"><br>
            <p>Password:</p>
            <input type="password" name="password"><br><br>
            
            <input type="submit" name="submit" value="signup" >
        </form>
        </div>

        
    </body>
    
    
</html>
