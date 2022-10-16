<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-Type:application/json;charset=utf-8");
    
    function updateemployee($employee_no,$employee_id,$employee_name,$employee_auth,$employee_sex,$employee_email,$employee_phone,$employee_status){
    try{
      require_once("./connect_cgd102g1.php");
           $employee_no=$_REQUEST['employee_no'];

            $sql="UPDATE employee
                  SET employee_id='{$employee_id}', employee_name='{$employee_name}' , employee_auth ='{$employee_auth}' ,
                  employee_sex='{$employee_sex}' , employee_email='{$employee_email}' , employee_phone='{$employee_phone}' , employee_status='{$employee_status}'
                  WHERE employee_no='{$employee_no}'";

            $pdo->exec($sql);

            $sql2="select * from employee where employee_no=:employee_no ";
            $employee = $pdo->prepare( $sql2 ); //先編譯好
            $employee->bindValue(":employee_no", $_REQUEST['employee_no']); //代入資料
            $employee->execute();//執行之

            $employeeRow = $employee->fetch(PDO::FETCH_ASSOC);
            
            //更新成功,將登入者的資料寫入session
            $_SESSION["employee_no"]=$employeeRow["employee_no"];
            $_SESSION["employee_id"]=$employeeRow["employee_id"];
            $_SESSION["employee_name"]=$employeeRow["employee_name"];
            $_SESSION["employee_auth"]=$employeeRow["employee_auth"];
            $_SESSION["employee_sex"]=$employeeRow["employee_sex"];
            $_SESSION["employee_email"]=$employeeRow["employee_email"];
            $_SESSION["employee_phone"]=$employeeRow["employee_phone"];
            $_SESSION["employee_status"]=$employeeRow["employee_status"];
            //送出更新後的資料
            $result = ["employee_sex"=>$_SESSION["employee_sex"],
                        "employee_no"=>$_SESSION["employee_no"],
                        "employee_id"=>$_SESSION["employee_id"],
                        "employee_name"=>$_SESSION["employee_name"],
                        "employee_auth"=>$_SESSION["employee_auth"],
                        "employee_sex"=>$_SESSION["employee_sex"],
                        "employee_email"=>$_SESSION["employee_email"],
                        "employee_phone"=>$_SESSION["employee_phone"],
                        "employee_status"=>$_SESSION["employee_status"]
                      ];
           
            echo json_encode($result);


     }catch(PDOException $e){
         echo $e->getMessage();
       }
    }
    updateemployee($_REQUEST['employee_no'],$_REQUEST['employee_id'],$_REQUEST['employee_name'],$_REQUEST['employee_auth'],$_REQUEST['employee_sex'],$_REQUEST['employee_email'],$_REQUEST['employee_phone'],$_REQUEST['employee_status'])
?>