<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");
    try{
        require_once("./connect_cgd102g1.php");

        $sql = "select employee_no,employee_id,employee_name,employee_auth,employee_sex,employee_email,employee_phone,employee_status
        from employee 
        where employee_no=:employee_no";

        $employee = $pdo->prepare($sql);
        //將資料代入參數中(未知數中);
        $employee->bindValue(":employee_no",$_REQUEST['employee_no']);//使用pdostatement物件的bindValue()方法
        $employee->execute();
        
        $employeedata=$employee->fetch(PDO::FETCH_ASSOC);

        echo json_encode($employeedata); 
    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>

