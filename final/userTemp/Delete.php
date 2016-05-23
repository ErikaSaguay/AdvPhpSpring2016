<?php

function Delete($filename,$userid){

    $photo = new Photo();
    if($photo->delete($filename, $userid)== true){
        echo "<p>"+ "Deleted"+ "</p>";
    }
}

