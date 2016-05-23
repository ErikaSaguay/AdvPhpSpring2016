<!DOCTYPE HTML>
<html>
    <head>
        <title>Meme Generator</title>
        <link rel="stylesheet" href="css/home.css">
    </head>
    <body>    
        <?php 
        include './autoload.php';
        include './userTemp/selectAll.php';
        
        ?>  
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Signup.php">Sign up</a></li>
                <li><a href="Login.php">Login</a></li>
            </ul>
        </nav>
        
        <?php 

        $folder = './uploads';// check folder if nor directory kill the page  better want to do is to create and move on
        
        
      
        
        if ( !is_dir($folder) ) {
            die('Folder <strong>' . $folder . '</strong> does not exist' );
        }
        
        $directory = new DirectoryIterator($folder); // pass the folder 
         
        ?>
        <div id='mostviewed'>
            <h1>Photo of the moment</h1>
            <?php 
                  
                $files = glob('uploads' . '/*.*');
                $file = array_rand($files);?>
            <img src ='<?php echo $files[$file]; ?> ' >
    
        </div> 
         <section>           
        <?php foreach ($directory as $fileInfo) : ?>  
            <?php if ( $fileInfo->isFile() ) : ?>  
                <?php if($fileInfo->getExtension() == "jpg" ): ?>     
                 <?php selectAll($fileInfo->getFilename()); ?>
                <?php endif;?>
            <?php endif;?>
 
        <?php endforeach; ?>

        </section>

            <footer><p>&copy; Erika Guaman Saguay Copyright 2016 </p></footer>
        
    </body>
</html>

