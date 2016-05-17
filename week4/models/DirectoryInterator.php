<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // http://php.net/manual/en/class.directoryiterator.php // class 
        //DIRECTORY_SEPARATOR 
        // iterator meant for the class to go in a loop 

        $folder = './uploads';// check folder if nor directory kill the page  better want to do is to create and move on
        
        if ( !is_dir($folder) ) {
            die('Folder <strong>' . $folder . '</strong> does not exist' );
        }
        
        $directory = new DirectoryIterator($folder); // pass the folder 
         
        ?>
        
        <?php foreach ($directory as $fileInfo) : ?>  
        
          <ul> 
              <?php if ( $fileInfo->isFile() ) : ?> 
        <li> 
            <?php echo $fileInfo->getFilename();// name  ?> 
            <?php $fileName = $fileInfo->getFilename(); ?>
            <a id="<?php echo $fileName; ?>" href="ViewDoc.php?id=<?php echo $fileName; ?>" >view</a>
            
           

        </li>
             <?php endif; ?>
          </ul>
        <?php endforeach; ?>
        <a href="uploadForm.php">Upload</a>

    </body>
</html>
