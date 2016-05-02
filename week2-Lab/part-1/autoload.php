<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function load_lib($class) {
    var_dump($class);
    include './models/'.$class . '.php';
};
spl_autoload_register('load_lib');