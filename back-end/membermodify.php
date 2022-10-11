<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = "select mem_name, mem_nick_name, mem_email, mem_city, mem_addr, mem_phone
    from member";

    $mem = $pdo->query($sql);

    $memdata = $mem->fetchAll(PDO::FETCH_ASSOC);
    

?>

<?php

    $data = [];

    foreach($memdata as $i => $content){
        $data[]=$content;
    }
    echo json_encode($data);

?>