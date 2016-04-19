<!DOCTYPE HTML>
<html>
    <head>
        <title></title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>
    <body>
        <?php
        include './autoload.php';
        
        if(isset($_POST['submit'])){
            $email=$pass="";
            $dsn = 'mysql:host=localhost;dbname=phpadvclassspring2016';
            $user='advphp';
            $pass='php';
            try{
                $conn=new PDO($dsn,$user,$pass); // creating new php data object
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } 
            catch (PDOException $e){
                $error_message = $e->getMessage();//we use the rocket because it will be wrong to use a do
                echo $error_message;
                exit ();
                
            }
            $created=date("Y-m-d H:i:s");
            if(empty($_POST["email"])){
                $emailErr="Email is required";
            }
            if(empty($_POST["password"])){
                $passErr="Please enter password";
            }
            else {
                $emailtest=$_POST["email"];
                if ( !preg_match($emailregex, $emailtest) ) {
                $emailRegexErr = 'email is invalid';    
                }else {
                  
                $email = $_POST["email"]; 
                $passqord = $_POST["password"]; 
                $sql="SELECT * FROM users WHERE email='".$email."'";
                $result=  mysql_query($sql);
                $query_data=  mysql_fetch_row($result);
                if($query_data[0]> 0){
                    echo"already exists";
                }else{
                    $sql2 = "INSERT INTO users(email,password,created)VALUES ('$email','$pass','$created')";// use exec() because no results are returned
                    $conn->exec($sql2);
                    echo"You have signed in";
                }

                } 
            }

        }
        
        ?>
        <h3>Sign Up</h3>
        <form actio="#" method="post">
            <p>Email:</p>
            <input type="text" name="email"><br>
            <p>Password:</p>
            <input type="password" name="password"><br><br>
            <input type="submit" name="submit" value="signup" >
        </form>
        <p><?php echo $emailErr; ?></p>
        <p><?php echo $passErr; ?></p>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </body>
    
    
</html>
