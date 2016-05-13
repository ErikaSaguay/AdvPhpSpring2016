<?php

include_once './bootstrap.php';

/*
 * The Rest server is sort of like the page is hosting the API
 * When a user calls the page (By url(HTTP), CURL, JavaScript etc.), the server(this Page) will handle the request.
 */
$restServer = new RestServer();

try {
    
    $restServer->setStatus(200);
    
    $resource = $restServer->getResource();
    $verb = $restServer->getVerb();
    $id = $restServer->getId();
    $serverData = $restServer->getServerData();

    if ( 'corps' === $resource ) {
        
        $resourceData = new CorpResource();
        
        if ( 'GET' === $verb ) {
            
            if ( NULL === $id ) {
                
                $restServer->setData($resourceData->getAll());                           
                
            } else {
                
                $restServer->setData($resourceData->get($id));
                
            }            
            
        }
                
        if ( 'POST' === $verb ) {
            

            if ($resourceData->post($serverData)) {
                $restServer->setMessage('Address Added');
                $restServer->setStatus(201);
            } else {
                throw new Exception('Address could not be added');
            }
        
        }
        
        
        if ( 'PUT' === $verb ) {
            
            if ( NULL === $id ) {
                throw new InvalidArgumentException('Address ID ' . $id . ' was not found');
            }else{
                if($resourceData->update($id, $serverData)){
                   $restServer->setMessage("Updated");
                   $restServer->setStatus(201);
                    
                }else {
                throw new Exception('Unable to update');
                }
              
            }
            
        }
        if ( 'DELETE' === $verb ) {
            
            if ( NULL === $id ) {
                throw new InvalidArgumentException('Address ID ' . $id . ' was not found//DELETE');
            }else{
                if($resourceData->delete($id)){
                    $restServer->setMessage("Deleted");
                    $restServer->setStatus(201);
                }
                else {
                throw new Exception('Unable to Delete');
                }
            }
            
        }

            
        
        
    } else {
        throw new InvalidArgumentException($resource . ' Resource Not Found');
        
    }
   
    
    /* 400 exeception means user sent something wrong */
} catch (InvalidArgumentException $e) {
    $restServer->setStatus(400);
    $restServer->setErrors($e->getMessage());
    /* 500 exeception means something is wrong in the program */
} catch (Exception $ex) {    
    $restServer->setStatus(500);
    $restServer->setErrors($ex->getMessage());   
}


echo $restServer->getReponse();
die();