<?php 
header("Access-Control-Allow-Origin:*");//跨網域，需要這段才不會被攔截
header("Content-Type:application/json;charset=utf-8");
ob_start();//output buffer start
session_start();

// echo 1;


if( isset($_SESSION["mem_id"])==true){
	$result = ["mem_no"=>$_SESSION["mem_no"], "mem_id"=>$_SESSION["mem_id"],"mem_name"=>$_SESSION["mem_name"],"mem_email"=>$_SESSION["mem_email"]];
	echo json_encode($result);
}else{ //尚未登入
	echo "{}";
}

?>