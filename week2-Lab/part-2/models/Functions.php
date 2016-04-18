<?php

class Functions extends DB implements IFunctions{
    // what de the phone crud need to do  can also extend 
    // then you implement the functions 
    // function creat  read  and so on with the values that it take or doesnt take 
    function __construct() {
        
        $this->setDns('mysql:host=localhost;port=3306;dbname=PHPAdvClassSpring2016');
        $this->setPassword('');
        $this->setUser('root');
        
    }
    
    function getUsers() {
        $db = $this->getDb();
        $statement = $db->prepare("SELECT * FROM address");

        $results = array();
        if ($statement->execute() && $statement->rowCount() > 0) {
           $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $results;
    }
    
    public function addPerson($values){
        $db = $this->getDb();
        $statement = $db->prepare("INSERT INTO address SET fullname = :fullname, email = :email, addressline1 = :address, city = :city, state = :state, zip = :zip, birthday = :dob");
        $binds = array(
            ":fullname" => $values['fullname'],
            ":email" => $values['email'],
            ":address" => $values['address'],
            ":city" => $values['city'],
            ":state" => $values['state'],
            ":zip" => $values['zip'],
            ":dob" => $values['dob']
        
        );
        if ($statetment->execute($binds) && $statement->rowCount() > 0) {
            return true;
        }

        return false;

    }

    

}