<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Validator{    
    public function isEmailValid($email) {
        return ( is_string($email) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false );
    }    
    public function isZipValid($zip) {
        return ( preg_match("/^[0-9]{5}([- ]?[0-9]{4})?$/", $zip) );
    }
   
    
}