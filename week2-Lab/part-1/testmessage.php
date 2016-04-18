<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
       
        include './autoload.php';
        $messages=new Message();
        $messages->addMessage("email", "erika@gmail.com");
        $messages->addMessage("phone", "123456789");
        
        var_dump($messages->getAllMessages());
        $messages->removeMessage("email");
        var_dump($messages->getAllMessages());
        
        ?>
    </body>
</html>
