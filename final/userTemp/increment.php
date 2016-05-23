<?php
function increment($filename){
 
    try{
       //$thisfile= "img_7a31c2496cb7291e98e8b29b6868678e4fce3f1f";
    if (isset($filename)){
    $addPhoto = new Photo();
    if ($addPhoto->add_views($filename)== true){

          return true;
    }
    
    else{
        throw new RuntimeException('Failed to add to database.');
    } 
        
      
       
        
    }
    
    } catch (RuntimeException $e) {
     $message = $e->getMessage();
    die();

    }
}
   



