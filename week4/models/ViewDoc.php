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
 
        $name = $_GET['id'];
        try{
        if(empty($name)){
            throw new RuntimeException('File was not selected please CLICK Return.');
 
        }
        
        $match = [];
        
        ?>
        <a href="DirectoryInterator.php">Return </a>
        <?php foreach ($directory as $fileInfo) : ?>        
        
            <?php if($fileInfo->getFilename() == $name): ?>
        
                <p><?php echo $fileInfo->getPathname(); //file name ?></p>
                
                <p>uploaded on <?php echo date("l F j, Y, g:i a", $fileInfo->getMTime()); // time ?></p>
                
                <p>This file is <?php echo $fileInfo->getSize(); // size?> byte's</p>
                
                <p>The file type is <?php echo $fileInfo->getExtension(); // type ?> byte's</p>
                
                
                
                <a href="<?php echo $fileInfo->getPathname();  ?>" download><?php echo $fileInfo->getFilename();//download?></a> <br>
                
                <?php if($fileInfo->getExtension() == "jpg" ): ?>
                    <img src="<?php echo $fileInfo->getPathname();  ?>" />
                    <?php $match["img"]="img"; ?>
                <?php endif;?>
                    
                
                <?php if($fileInfo->getExtension() == "txt" ): ?>                 
                    <textarea ows="4" cols="50"><?php echo file_get_contents($fileInfo->getPathname() );?></textarea>
                    <?php $match["txt"]="txt"; ?>
                 <?php endif;?>
                    
                
                <?php if( $fileInfo->getExtension() == "pdf" ): ?>
                  <iframe width='1000' height='800' src='<?php echo $fileInfo->getPathname();  ?>' frameborder='0' allowfullscreen></iframe>
                  <?php $match["pdf"]="pdf"; ?>
                <?php endif; ?><br>

                <?php $fileName = $fileInfo->getFilename(); ?>
                
                <?php $info = $fileInfo->getPathname(); ?>
                
                <a id="<?php echo $fileName; ?>" href="DeleteFile.php?id=<?php echo $info; ?>">delete</a>
 
                <?php if(!count($match) == 0):?>
                <p><?php echo "sucess";?></p>
                <?php endif;?>
                <?php endif;?>

        <?php endforeach; ?>
       <?php  
        }
       catch (RuntimeException $e) {
        echo '<a href="DirectoryInterator.php">Return</a><br>';
                echo $message = $e->getMessage();
                 
                 
        }?>

         
                

    </body>
</html>
