<?php
include './config.php';
unset($_SESSION['isLoggedIn']);
unset($_SESSION['user']);
unset($_SESSION['isAdmin']);
$_SESSION['msg']="logout successfully" ;
header('location:'.SITE_WS_PATH.'/login.php');
exit;
?>