<?php

/**
 *
 * @author GFORTI
 */
interface IRestModel {
    //put your code here
    function getAll();
    function get($id); 
    function post($serverData);
    function update($id,$serverData);
    function delete($id);
}
