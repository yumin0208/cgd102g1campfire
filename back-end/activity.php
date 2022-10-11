<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    // $sql = "select a.area_name, ac.activity_name, ac.activity_subtitle,ac.activity_info,ac.activity_pic,ac.activity_price,ac.activity_suitable_guest,ac.activity_note
    // from area a join activity ac on a.area_no =ac.area_no";

    $sql1="select activity_name, activity_subtitle, activity_info, activity_pic,activity_price, activity_suitable_guest, activity_note
    from activity
    where area_no=1";
    $sql2="select activity_name, activity_subtitle, activity_info, activity_pic,activity_price, activity_suitable_guest, activity_note
    from activity
    where area_no=2";
    $sql3="select activity_name, activity_subtitle, activity_info, activity_pic,activity_price, activity_suitable_guest, activity_note
    from activity
    where area_no=3";

    $activity = $pdo->query($sql1);
    $activitydata = $activity->fetchAll(PDO::FETCH_ASSOC);

    $activity2 = $pdo->query($sql2);
    $activitydata2 = $activity2->fetchAll(PDO::FETCH_ASSOC);

    $activity3 = $pdo->query($sql3);
    $activitydata3 = $activity3->fetchAll(PDO::FETCH_ASSOC);
    

?>

<?php

    $data = [];

    $data1=[];

    foreach($activitydata as $i => $content){
        $data1[]=$content;
    }

    $data2=[];

    foreach($activitydata2 as $i => $content){
        $data2[]=$content;
    }
    $data3=[];

    foreach($activitydata3 as $i => $content){
        $data3[]=$content;
    }
    
    $data = array();
    array_push($data, $data1,$data2,$data3); 
    echo json_encode($data);

?>