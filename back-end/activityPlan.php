<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = "select * from activity";

    $plan = $pdo->query($sql);
    $plans = $plan->fetchAll(PDO::FETCH_ASSOC);
    

?>

<?php

    $planData = [];
    foreach($plans as $i => $content){
        $planData[]=$content;
    }

    echo json_encode($planData);

?>