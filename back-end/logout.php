<?php 
header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
session_start();
// session_destroy();
session_unset(); //資料清空, 但檔案還在
?>