<?php 
header("Access-Control-Allow-Origin:*");//跨網域，需要這段才不會被攔截
header("Content-Type:application/json;charset=utf-8");
ob_start();//output buffer start
session_start();

// echo 1;


if( isset($_SESSION["employee_id"])==true){
	$result = ["employee_psw"=>$_SESSION["employee_psw"], "employee_id"=>$_SESSION["employee_id"],"employee_auth"=>$_SESSION["employee_auth"]];
	echo json_encode($result);
}else{ //尚未登入
	echo "{}";
}

?>