<?php 
function CheckFile($filename,$userid){

  $file = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
  
  $photo = new Photo();        
  $folder = './uploads';// check folder if nor directory kill the page  better want to do is to create and move on
        
        if ( !is_dir($folder) ) {
            die('Folder <strong>' . $folder . '</strong> does not exist' );
        }
        
        $directory = new DirectoryIterator($folder); // pass the folder 
         
 ?>
            

            <?php $row1 = $photo->user_info($userid); ?>
              
                <?php foreach ($row1 as $row): ?>
                    
                <?php if ( $file == $row['filename']): ?> 
                <h1><?php echo $row['title']; ?> </h1>
                <img src="./uploads/<?php echo $filename; ?>" >
                <h2>Views: <?php echo $row['views']; ?></h2>
                <h2><?php echo $row['created']; ?></h2>
                <input type="submit" name="Delete"value='Delete'onclick="" >
           `    <?php endif; ?>
           
                <?php endforeach; ?>

        
<?php   } ?>