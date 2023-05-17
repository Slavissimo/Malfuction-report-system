<?php
    if(isset($_SESSION['messageSuccess'])) :
?>

<div class="alert alert-success fade show m-5" role="alert">
     <?=  $_SESSION['messageSuccess']; ?>
</div>  

<?php
    unset($_SESSION['messageSuccess']);
    endif;
?>