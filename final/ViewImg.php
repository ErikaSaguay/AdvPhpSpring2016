<!DOCTYPE HTML>
<html>
    <head>
        <title>Meme Generator</title>
        <link rel="stylesheet" href="css/home.css">
    </head>
    <body>     
        <nav>
            <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="Signup.php">Sign up</a></li>
            <li><a href="Login.php">Login</a></li>
            </ul>
        </nav>
        <section>
        <?php 
        include './autoload.php';
        include './userTemp/increment.php';
        $folder = './uploads';// check folder if nor directory kill the page  better want to do is to create and move on
        $photo = new Photo();
        
        $name = $_GET['id'];

        
        if ( !is_dir($folder) ) {
            die('Folder <strong>' . $folder . '</strong> does not exist' );
        }
        
        $directory = new DirectoryIterator($folder); // pass the folder 
         
        ?>
                             
        <?php foreach ($directory as $fileInfo) : ?>  
        
          
              <?php if ( $fileInfo->isFile() ) : ?> 
                     
                   <?php if($fileInfo->getFilename() == $name): ?>   
                   <?php increment($name);  ?>
                   <?php $row1 = $photo->show_pic_info($name); ?>

                    <?php foreach ($row1 as $row): ?>
                                 
                    <h1><?php echo $row['title']; ?> </h1>
                    
                   <img src="<?php echo $fileInfo->getFileInfo(); ?>" />
   
                        <h2 id="$_SESSION['views']">Views: <?php echo $row['views']; ?></h2>
                        <h2><?php echo $row['created']; ?></h2>                 

                    
                    <?php endforeach; ?>

                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
        
        </section>
           
            <footer><p>&copy; Erika Guaman Saguay Copyright 2016 </p></footer>
        
    </body>
</html>


