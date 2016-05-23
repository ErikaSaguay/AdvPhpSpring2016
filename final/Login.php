<!DOCTYPE HTML>
<html>
    <head>
        <title></title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
          <link rel="stylesheet" href="css/home.css">
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
                        
                        $util->redirect('./Main.php');
                      }

                    }  
                    else {
                        $error['invalid'] = "Incorrect email or password";
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
        <h3>Login</h3>
            <?php include './userTemp/errors.php';  ?>
            <?php if( isset($message['success']) ): ?>
            <span><?php echo $message['success']; ?></span>
            <?php endif; ?>
            <div class='content'>
        <form action="#" method="post">
            <p>Email:</p>
            <input type="text" name="email"><br>
            <p>Password:</p>
            <input type="password" name="password"><br><br>
            <input type="submit" name="submit" value="Login" >
            
        </form> 
        </div>


    </body>
    
    
</html>