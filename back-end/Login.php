<?php
session_start();
header("Access-Control-Allow-Origin:*");//跨網域，需要這段才不會被攔截
header("Content-Type:application/json;charset=utf-8");
ob_start();//output buffer start
try {
    require_once("./connect_cgd102g1.php");
        
    $sql = "select * from member where mem_id=:mem_id and mem_psw=:mem_psw"; //mem_id是欄位名稱，:mem_id是值

    $member = $pdo->prepare( $sql ); //先編譯好
    $member->bindValue(":mem_id", $_POST["account"]); //代入資料
    $member->bindValue(":mem_psw", $_POST["password"]);
    $member->execute();//執行之

        if( $member->rowCount() == 0 ){//找不到
            echo "0";
        }else{
            $memRow = $member->fetch(PDO::FETCH_ASSOC);
            
            //登入成功,將登入者的資料寫入session
            $_SESSION["mem_no"]=$memRow["mem_no"];
            $_SESSION["mem_id"]=$memRow["mem_id"];
            $_SESSION["mem_name"]=$memRow["mem_name"];
            $_SESSION["mem_nick_name"]=$memRow["mem_nick_name"];
            $_SESSION["mem_city"]=$memRow["mem_city"];
            $_SESSION["mem_addr"]=$memRow["mem_addr"];
            $_SESSION["mem_phone"]=$memRow["mem_phone"];
            $_SESSION["mem_pic"]=$memRow["mem_pic"];
            $_SESSION["mem_status"]=$memRow["mem_status"];
            $_SESSION["mem_email"]=$memRow["mem_email"];
            $_SESSION["register_date"]=$memRow["register_date"];
            //送出登入者的資料
            $result = ["mem_no"=>$_SESSION["mem_no"],
                        "mem_id"=>$_SESSION["mem_id"],
                        "mem_name"=>$_SESSION["mem_name"],
                        "mem_email"=>$_SESSION["mem_email"],
                        "mem_nick_name"=>$_SESSION["mem_nick_name"],
                        "mem_city"=>$_SESSION["mem_city"],
                        "mem_addr"=>$_SESSION["mem_addr"],
                        "mem_phone"=>$_SESSION["mem_phone"],
                        "register_date"=>$_SESSION["register_date"],
                        "mem_status"=>$_SESSION["mem_status"],
                        "mem_pic"=>$_SESSION["mem_pic"]];
            // echo 1;
            echo json_encode($result);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>  