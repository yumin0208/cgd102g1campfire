<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");
    try{
        require_once("./connect_cgd102g1.php");

        $sql = "SELECT activity_name,activity_subtitle,activity_synopsis,activity_info,activity_price,
                activity_suitable_guest,activity_note
                FROM activity
                WHERE activity_no=:activity_no";

        $activity = $pdo->prepare($sql);
        //將資料代入參數中(未知數中);
        $activity->bindValue(":activity_no",$_REQUEST['activity_no']);//使用pdostatement物件的bindValue()方法
        $activity->execute();
        
        $activitydata=$activity->fetch(PDO::FETCH_ASSOC);

        echo json_encode($activitydata); 
    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>

