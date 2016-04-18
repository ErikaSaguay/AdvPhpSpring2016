<!DOCTYPE html>
<html>
    <head>
        <title>Assignment1</title>
        <style>
         table {
            border-collapse: collapse;
            width: 100%;
         }

         th, td {
            text-align: left;
            padding: 8px;
         }

        tr:nth-child(even){background-color: #f2f2f2}   
            
        </style>
    </head>
    <body>
     <body>
         <a href="http://localhost/AdvPhpSpring2016/week1/AddNew.php">Add New User</a>
         <h1>Results</h1>
             
    <?php
    require_once './autoload.php';
            $db = new Functions();
            $users=$db->getUsers(); 
    ?>
    <?php if ( count($users) > 0 ) : ?>
          <table>
          <tr><th>Name</th><th>Email</th><th>Address</th><th>City</th><th>State</th><th>Zip</th><th>DOB</th></tr>
    <?php foreach( $users as $user => $info ) : ?>
            <tr>
            <td> <?php echo $info['fullname']; ?> </td>
            <td> <?php echo $info['email']; ?> </td>
            <td> <?php echo $info['addressline1']; ?> </td>
            <td> <?php echo $info['city']; ?> </td>
            <td> <?php echo $info['state']; ?> </td>
            <td> <?php echo $info['zip']; ?> </td>
            <td> <?php echo $info['birthday']; ?> </td>;
            </tr>;
    <?php endforeach; ?>
          </table>
    <?php endif; ?>
        
    </body>
    
</html>