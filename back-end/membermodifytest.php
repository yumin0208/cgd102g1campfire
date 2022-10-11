<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");
    try{
        require_once("./connect_cgd102g1.php");

        $sql = "select mem_id, mem_name, mem_nick_name, mem_email, mem_city, mem_addr, mem_phone
        from `member` 
        where mem_id=:mem_id";

        $mem = $pdo->prepare($sql);
        //將資料代入參數中(未知數中);
        $mem->bindValue(":mem_id",$_REQUEST['memId']);//使用pdostatement物件的bindValue()方法
        $mem->execute();
        
        $memdata=$mem->fetch(PDO::FETCH_ASSOC);

        echo json_encode($memdata); 
    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>

