<?php
    if(isset($_SESSION['messageDanger'])) :
?>

<div class="alert alert-danger fade show m-5" role="alert">
     <?=  $_SESSION['messageDanger']; ?>
</div>  

<?php
    unset($_SESSION['messageDanger']);
    endif;
?>