<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = "select * from report";

    $report = $pdo->query($sql);
    $reports = $report->fetchAll(PDO::FETCH_ASSOC);
    

?>

<?php

    $reportData = [];
    foreach($reports as $i => $content){
        $reportData[]=$content;
    }

    echo json_encode($reportData);

?>