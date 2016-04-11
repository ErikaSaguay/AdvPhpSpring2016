<?php
interface IMessage
{
public function addMessage($key, $msg);

public function removeMessage($key);

public function getAllMessages();
}
class Message {
    
    
}
class ErrorMessage extends Message{
    
    
}
class SuccessMessage extends Message{
    
    
}
?>
