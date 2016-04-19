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
        
        $this->setDns('mysql:host=localhost;port=3306;dbname=PHPAdvClassSpring2016');
        $this->setPassword('');
        $this->setUser('root');
        
    }
    function create($values){
        $db = $this->getDb();
        $statement = $db->prepare("INSERT INTO users SET email = :email, password = :password, created = :created");
        $binds = array(
            ":email" => $values['email'],
            ":password" => $values['password'],
            ":created" => $values['created']

        );
        if ($statetment->execute($binds) && $statement->rowCount() > 0) {
            return true;
        }

        return false;
    }
    function check($values){
        
        $db = $this->getDb();
        // password hash
        $query = $db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $binds = array(
            ":email" => $values['email'],
            ":password"=> $values['password']
                
        );
        if($query->execute($binds) && $query->rowCount() > 0 ){
            return true;
        }
        return false; 
    }
    function unique($values){
        $db = $this->getDb();
        $query = $DB->prepare("SELECT * FROM users WHERE email = :email ");
        $binds = array(
            ":email" => $values['email']
        );
        if($query->execute($binds) && $query->rowCount() > 0 ){
            return false;
        }
        return true;    
        
    }
}
