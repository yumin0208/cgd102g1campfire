<?php
    header("Access-Control-Allow-Origin:*");//跨網域，需要這段才不會被攔截
    // header("Content-Type:application/x-www-form-urlencoded");
        function addEmployee($employee_id,$employee_psw,$employee_name,$employee_auth,$employee_sex,$employee_email,$employee_phone){
            try{
            require_once("./connect_cgd102g1.php");
            $sql="INSERT INTO employee(employee_id,employee_psw,employee_name,employee_auth,employee_sex,employee_email,employee_phone,employee_status)
                  VALUES('{$employee_id}','{$employee_psw}','{$employee_name}','{$employee_auth}','{$employee_sex}','{$employee_email}','{$employee_phone}',1)";
            $pdo->exec($sql);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        addEmployee(
            $_POST['employee_id'],$_POST['employee_psw'],$_POST['employee_name'],$_POST['employee_auth'],$_POST['employee_sex'],$_POST['employee_email'],$_POST['employee_phone']
            )
      
?>