<?php


    
function load_lib($class) {
    include 'http://localhost/AdvPhpSpring2016/week2-Lab/part-2'.$class . '.php';
};
spl_autoload_register('load_lib');

