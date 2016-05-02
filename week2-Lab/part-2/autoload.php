<?php


    
function load_lib($class) {
    include 'models/'.$class . '.php';
};
spl_autoload_register('load_lib');

