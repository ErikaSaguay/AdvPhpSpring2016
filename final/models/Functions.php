<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Functions
 *
 * @author ErikaC
 */
class Functions extends DBase implements IFunctions1 {
    //put your code here
    function __construct() {
        // construct builds the information
        $this->setDns('mysql:host=localhost;port=3306;dbname=PHPAdvClassSpring2016');
        $this->setPassword('');
        $this->setUser('root');
        
    }
    function create($values, $hash , $created){
        $db = $this->getDb();
        $statement = $db->prepare("INSERT INTO users SET email = :email, password = :password, created = :created");
        $binds = array(
            ":email" => $values['email'],
            ":password" => $hash,
            ":created" => $created

        );
        if ($statement->execute($binds) && $statement->rowCount() > 0) {
            return true;
        }

        return false;
    }
   
    function check($email, $pass){
        
        $db = $this->getDb();
        // password hash
        $query = $db->prepare("SELECT user_id , password FROM users WHERE email = :email ");
        $binds = array(
            ":email" => $email   
        );

        if($query->execute($binds) && $query->rowCount() > 0 ){
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $users = $user['password'];
            
            return password_verify($pass, $users );
            
        }
        return false; 
    }
    function unique($values){
        $db = $this->getDb();
        $statement = $db->prepare("SELECT * FROM users WHERE email = :email ");
        $binds = array(
            ":email" => $values['email']
        );
        if($statement->execute($binds) && $statement->rowCount() > 0 ){
            return true;
        }
        return false;    
        
    }
    function get_user_id($values){
        
        $db = $this->getDb();
        // password hash
        $statement = $db->prepare("SELECT user_id , password FROM users WHERE email = :email ");
        $binds = array(
            ":email" => $values['email']  
        );

        if($statement->execute($binds) && $statement->rowCount() > 0 ){
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            $userid = $user['user_id'];
            return $userid;
            
        }
        return false; 
    }
    function get_user_info($id) {
        $db = $this->getDb();
        
        $statement =$db->prepare("SELECT * FROM photos WHERE user_id = :user_id");
        
        $results = array();
        $binds = array (
            ":user_id" => $id
        );
        if($statement->execute($binds)&& $statement->rowCount() > 0)
        {
            return $results = $statement->fetch(PDO::FETCH_ASSOC);;
        }
        return false;
    }
    function load_main_info(){
        $db = $this->getDb();
        
        $statement =$db->prepare("SELECT * FROM photos ");
        
        $results = array();

        if($statement->execute()&& $statement->rowCount() > 0)
        {
            return $results = $statement->fetch(PDO::FETCH_ASSOC);;
        }
        return false;
    }


    
}
