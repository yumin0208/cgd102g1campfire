<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = 
            "select employee_no, employee_id, employee_psw, employee_name, employee_auth, employee_sex, employee_email, employee_phone, employee_status
            
            from employee";

    $emp = $pdo->query($sql);

    $emps = $emp->fetchAll();

    
?>

<?php

    $mep_data = [];

    foreach($emps as $i => $content){
        $emp_data[]=$content;
    }
    echo json_encode($emp_data);


?>