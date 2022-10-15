<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");
    try{
        require_once("./connect_cgd102g1.php");

        $sql = "select area_name,area_subtitle,area_info
        from area
        where area_no=:area_no";

        $area = $pdo->prepare($sql);
        //將資料代入參數中(未知數中);
        $area->bindValue(":area_no",$_REQUEST['area_no']);//使用pdostatement物件的bindValue()方法
        $area->execute();
        
        $areadata=$area->fetch(PDO::FETCH_ASSOC);

        echo json_encode($areadata); 
    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>

