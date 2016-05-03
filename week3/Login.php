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
                if(empty($pwd)){
                    $error['pass'] = "Please enter password";
                }
                if(count($error) == 0 ) {
                    
                    if(($log->check($email, $pwd))=== true){
                      // send to admin page using util
                      if($log->get_user_id($values) != false){ //checkin if userid matches email 
                        $userid = $log->get_user_id($values); // setting the useid from the database to the a variable named userid
                        session_start();
                        $_SESSION['userid'] = $userid;// setting user id session
                        $_SESSION['email'] = $email;
                        $page='AdminPage.php';
                        $util->redirect($page);
                      }

                    }  
                    else {
                        $error['invalid'] = "Incorrect email or password";
                    }

                }

                    
            }
            ?>
    <body>
        <h3>Login</h3>
            <?php include './userTemp/errors.php';  ?>
            <?php if( isset($message['success']) ): ?>
            <span><?php echo $message['success']; ?></span>
            <?php endif; ?>
        <form action="#" method="post">
            <p>Email:</p>
            <input type="text" name="email"><br>
            <p>Password:</p>
            <input type="password" name="password"><br><br>
            <input type="submit" name="submit" value="Login" >
            <a href ="Signup.php" >SignUp</a>
        </form> 


    </body>
    
    
</html>