<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
    </head>
    <body>
        <?php

        try {

            if (!isset($_FILES['file']['error']) || is_array($_FILES['file']['error'])) {
                throw new RuntimeException('Invalid parameters.');
            }

            switch ($_FILES['file']['error']) {
                case UPLOAD_ERR_OK:// no errors
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.'); 
            }

            if ($_FILES['file']['size'] > 300000000) { 
                throw new RuntimeException('Exceeded filesize limit.');
            }

            $name = $_FILES["file"]["name"]; //gets the name 
            $ext = strtolower(end((explode(".", $name)))); // converts to lowercase only variables

            if (preg_match("/^(jpeg|jpg|png|gif|txt|docx|html|xlsx|pdf)$/", $ext) == false) {
                throw new RuntimeException('Invalid file format.');
            }

            $salt = uniqid(mt_rand(), true); // checks that uploded files are different 
            
            $fileName = 'img_' . sha1($salt . sha1_file($_FILES['file']['tmp_name']));// add sub key intro key and sha1 version of the temp name goes to a safe space sha1_file give a new name
            
            $location = sprintf('./uploads/%s.%s', $fileName, $ext); // sprint f creates a flie name with th e file name and extension

            if (!is_dir('./uploads')) {
                mkdir('./uploads');
            }

            if (!move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

            echo 'File was uploaded';
        } catch (RuntimeException $e) {

            echo $e->getMessage();
        }
        ?>
    </body>
</html>