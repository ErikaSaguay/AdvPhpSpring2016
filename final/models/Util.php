<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Util
 *
 * @author ErikaC
 */
class Util {
    //put your code here
    public function isPostRequest() {
       return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
   }
   
    public function redirect($page, array $params = array()) {
        header('Location: ' . $this->createLink($page, $params));
        die();
    }
    
    public function createLink($page, array $params = array()) {        
        return $page . '?' .http_build_query($params);
    }
    
}
