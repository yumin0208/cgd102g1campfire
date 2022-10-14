<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = "select * from member";

    $member = $pdo->query($sql);

    $members = $member->fetchAll();
    

?>

<?php

    $member_data = [];

    foreach($members as $i => $content){
        $member_data[]=$content;
    }
    echo json_encode($member_data);

?>