<?php if( isset($error) && is_array($error) && count($error)> 0 ) : ?>
<ul>
<?php foreach( $error as $msg ) : ?>
    <li class="bg-danger" ><?php echo $msg; ?> </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>

    

