<?php function selectAll($filename){
    
    $photo = new Photo();
    
      $folder = './uploads';// check folder if nor directory kill the page  better want to do is to create and move on
        
        if ( !is_dir($folder) ) {
            die('Folder <strong>' . $folder . '</strong> does not exist' );
        }
        
        $directory = new DirectoryIterator($folder); 
    
?> 

<?php    foreach ($directory as $fileInfo):?>

            <?php if ( $fileInfo->getFilename()== $filename): ?> 

<?php $row1 = $photo->show_pic_info($filename); ?>

                    <?php foreach ($row1 as $row): ?>
                                 
                    <h1><?php echo $row['title']; ?> </h1>
                    
                    <a id="<?php echo $fileInfo->getFilename();?>" href="ViewImg.php?id=<?php echo $fileInfo->getFilename();?>"><img src="<?php echo $fileInfo->getFileInfo(); ?>" /></a>
   
                        <h2>Views: <?php echo $row['views']; ?></h2>
                        <h2><?php echo $row['created']; ?></h2>                 

                    
                    <?php endforeach; ?>
                                   <?php endif; ?>
           <?php endforeach; ?>
<?php }?>