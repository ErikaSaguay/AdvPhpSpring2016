<!DOCTYPE HTML>
<html>
    <head>
        <title></title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>

    <body>
        <h3>Login</h3>
        <form action="#" method="post">
            <p>Email:</p>
            <input type="text" name="email"><br>
            <p>Password:</p>
            <input type="password" name="password"><br><br>
            <input type="submit" name="submit" value="Login" >
        </form> 
            <?php
            include './autoload.php' ;
            $util = new Util();
            $log = new Functions();
            $values = filter_input_array(INPUT_POST);

            $email = $values['email'];
            $pwd = $values['password'];
            
            $message = [];
            
            if($util->isPostRequest())
            {
                if(empty($email) && empty($pass)){
                    $message['empty'] = "Enter both username and password";   
                }
                else{
                    $log->check($values);
                    if($log == true){
                      // send to admin page using util
                        session_start();
                        $_SESSION['email']=$email;
                        $page='http://localhost/AdvPhpSpring2016/week3/AdminPage.php';
                        $util->redirect($page);
                    }  
                    else {
                        $message['incorrect'] = "Incorrect email or password";
                    }
                    if(count($message) > 0){
                        
                        echo $message;
                    }
                }

                    
            }
            ?>

    </body>
    
    
</html>