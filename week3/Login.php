<!DOCTYPE HTML>
<html>
    <head>
        <title></title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>
            <?php
            include './autoload.php' ;
            
            $util = new Util();
            
            $log = new Functions();
            
            $values = filter_input_array(INPUT_POST);

            $email = $values['email'];
            $pwd = $values['password'];

            
            $error = [];
            $message = [];
            
            if($util->isPostRequest())
            {
                if(empty($email)){
                    $error['email'] = "Email is required";
                }
                else if(empty($pwd)){
                    $error['pass'] = "Please enter password";
                }
                else{
                    
                    if(($log->check($email, $pwd))=== true){
                      // send to admin page using util
                        session_start();
                        $_SESSION['email']=$email;
                        $page='http://localhost/AdvPhpSpring2016/week3/AdminPage.php';
                        $util->redirect($page);
                    }  
                    else {
                        $error['invalid'] = "Incorrect email or password";
                    }

                }

                    
            }
            ?>
    <body>
        <h3>Login</h3>
            <?php if( isset($error['pass']) ): ?>
            <span><?php echo $error['pass']; ?></span>
            <?php endif; ?>
            <?php if( isset($error['email']) ): ?>
            <span><?php echo $error['email']; ?></span>
            <?php endif; ?>
            <?php if( isset($error['invalid']) ): ?>
            <span><?php echo $error['invalid']; ?></span> 
            <?php endif; ?>
            <?php if( isset($message['success']) ): ?>
            <span><?php echo $message['success']; ?></span>
            <?php endif; ?>
        <form action="#" method="post">
            <p>Email:</p>
            <input type="text" name="email"><br>
            <p>Password:</p>
            <input type="password" name="password"><br><br>
            <input type="submit" name="submit" value="Login" >
        </form> 


    </body>
    
    
</html>