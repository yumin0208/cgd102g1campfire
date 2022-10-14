<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");
    try{
        require_once("./connect_cgd102g1.php");

        $sql = "select mem_no,mem_id,mem_name,mem_nick_name,mem_email,mem_city,mem_addr,mem_phone,mem_status
        from member 
        where mem_no=:mem_no";

        $member = $pdo->prepare($sql);
        //將資料代入參數中(未知數中);
        $member->bindValue(":mem_no",$_REQUEST['mem_no']);//使用pdostatement物件的bindValue()方法
        $member->execute();
        
        $memberdata=$member->fetch(PDO::FETCH_ASSOC);

        echo json_encode($memberdata); 
    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>

