<?php

class Photo extends DBase{

    function __construct() {
        $this->setDns('mysql:host=localhost;port=3306;dbname=PHPAdvClassSpring2016');
        $this->setPassword('');
        $this->setUser('root');     
    }
    public function add($userID, $filename,$title) {
        $db = $this->getDb();
        $stmt = $db->prepare("INSERT INTO photos set user_id = :user_id, filename = :filename, created = now(),title =:title");
        $binds = array(
            ":user_id" => $userID,
            ":filename" => $filename,
            ":title" => $title
        );
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
           return true;
        }
        return false;
        
    }    
    public function show_pic_info($filename){
        $file = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename); 
        $db = $this->getDb();
        
        $statement =$db->prepare("SELECT * FROM photos WHERE filename = :filename ");
        $binds= array(
            ":filename" => $file
        );
        $results = array();
        if($statement->execute($binds)&& $statement->rowCount() > 0)
        {
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $results; 
    } 

    public function user_info($userid){
        $db = $this->getDb();
        
        $statement =$db->prepare("SELECT * FROM photos WHERE user_id = :userid ");
        $binds = array(
            ":userid" => $userid
        );
        $results = array();
        if($statement->execute($binds)&& $statement->rowCount() > 0)
        {
             return $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return false; 
    }    
    public function fileInfo($filename){
        $db = $this->getDb();
        
        $statement =$db->prepare("SELECT * FROM photos WHERE filename = :filename ");
        $binds = array(
            ":filename" => $filename
        );
        $results = array();
        if($statement->execute($binds)&& $statement->rowCount() > 0)
        {
             $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $results; 
    }
    public function add_views($filename){
        $file = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        $db = $this->getDb();
        $statement =$db->prepare("UPDATE photos SET views = views + 1 WHERE filename = :filename");
        $binds = array(
            ':filename' => $file,
             
        );
        //$results = array();

        if($statement->execute($binds)&& $statement->rowCount() > 0)
        {
            return true;
        }
        return false;  
    }

    public function delete($filename, $user_id) {
        $file = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        $fileEXP = explode('.', $filename);
        $file = $fileEXP[0];
        $fileDir = '.' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename;
        
                $db = $this->getDb();
                $del = $db->prepare("DELETE FROM photos WHERE filename = :filename AND user_id = :userid");
                $delBinds = array(
                    ":filename" => $file,
                    ":userid" => $user_id
                );
                
                if ($del->execute($delBinds) && $del->rowCount() === 1){
                    if(unlink($fileDir)){
                        return true; 
                    }
              
                }
                else {
                    return false;
                }
    }

}

