<?php 

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('bambang', '', time() - 3600 );
setcookie('bambing', '', time() - 3600);

header("Location: login.php");
exit();
 ?>