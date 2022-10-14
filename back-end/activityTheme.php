<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = "select * from area";

    $area = $pdo->query($sql);
    $areas = $area->fetchAll(PDO::FETCH_ASSOC);
    

?>

<?php

    $areaData = [];
    foreach($areas as $i => $content){
        $areaData[]=$content;
    }

    echo json_encode($areaData);

?>