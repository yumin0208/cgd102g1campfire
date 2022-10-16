<?php
session_start();
header("Access-Control-Allow-Origin:*");//跨網域，需要這段才不會被攔截
header("Content-Type:application/json;charset=utf-8");
ob_start();//output buffer start


    try {
        require_once("./connect_cgd102g1.php");
        
        $sql = "select * from employee where employee_id=:employee_id and employee_psw=:employee_psw"; //''

        $employee = $pdo->prepare( $sql ); //先編譯好
        $employee->bindValue(":employee_id", $_POST["employee_id"]); //代入資料
        $employee->bindValue(":employee_psw", $_POST["employee_psw"]);
        $employee->execute();//執行之

        if( $employee->rowCount() == 0 ){//找不到
            echo "0";
        }
        else{
            $memRow = $employee->fetch(PDO::FETCH_ASSOC);
            if($memRow["employee_status"] == 0){
                echo "2" ;
            }else{
                //登入成功,將登入者的資料寫入session
                $_SESSION["employee_auth"]=$memRow["employee_auth"];
                $_SESSION["employee_id"]=$memRow["employee_id"];
                $_SESSION["employee_name"]=$memRow["employee_name"];
                
                $result = ["employee_auth"=>$_SESSION["employee_auth"],
                            "employee_id"=>$_SESSION["employee_id"],
                            "employee_name"=>$_SESSION["employee_name"]];
                // echo 1;
                echo json_encode($result);
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>  