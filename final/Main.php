<!DOCTYPE HTML>
<html>
    <head>
        <title>Meme Generator</title>
        <link rel="stylesheet" href="css/home.css">
    </head>
    <body> 
        <script type="text/javascript">
                
        </script>
        <nav>
            <ul>
            <li><a href="Main.php">Profile</a></li>
            <li><a href="AddMeme.php">Add</a></li>
            <li><a href="Signout.php">Logout</a></li>
            </ul>
        </nav>
        <section>
        <?php include './autoload.php'; ?>
        <?php include './userTemp/AccessRestriction.php'; ?>
        <?php include './userTemp/checkFile.php'; ?>
       
            
             
         <?php 
        $folder = './uploads';// check folder if nor directory kill the page  better want to do is to create and move on
        $photo = new Photo();

        $userid = $_SESSION['userid'];
        
        if ( !is_dir($folder) ) {
            die('Folder <strong>' . $folder . '</strong> does not exist' );
        }
        
        $directory = new DirectoryIterator($folder); // pass the folder 
         
        ?>
                            
        <?php foreach ($directory as $fileInfo) : ?>  
        
         
              <?php if ( $fileInfo->isFile() ) : ?> 
           
                   

                     <?php if($photo->user_info($userid)==false):?>
                        <h1><?php echo " Sorry no photos"; ?></h1>
                     <?php endif; ?>   
                    
                     <?php if($photo->user_info($userid) != false):?> 
                           <?php CheckFile($fileInfo->getFilename(),$userid) ?>
                        <?php endif; ?>
                     

                    <?php endif; ?>
        <?php endforeach; ?> 
      
        </section>
           
            <footer><p>&copy; Erika Guaman Saguay Copyright 2016 </p></footer>
        
    </body>
</html>
