<?php 
setcookie("user", "", time() - 3600);
?>

<?php
header('location:trangchu.php');
?>