<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author ErikaC
 */
interface IFunctions1 {
    //put your code here
    public function create( $values, $hash, $created );
    public function check( $values, $pass);
    public function unique( $values );
    public function get_user_id($values);
    public function get_user_info($id);//getting photos for the user
    public function load_main_info();// getting photos for the main page
}
