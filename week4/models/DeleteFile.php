<?php

$file = $_GET['id'];

if(!empty($file)){
    Remove($file);
}
function Remove($path){
    unlink($path);
    echo"file was deleted";
    
}


?>
<!Doctype html>
<html>
    <head>
        <title></title> 
        
    </head>
    <body>
        <a href="DirectoryInterator.php">Return</a>  
    </body>
</html>