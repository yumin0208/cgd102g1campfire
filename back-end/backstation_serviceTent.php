<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = 
        "select * 

        from tent_style";

    $tent = $pdo->query($sql);

    $tents = $tent->fetchAll(PDO::FETCH_ASSOC);//php data object 獲取關聯
    
?>

<?php

    $tent_data = [];

    foreach($tents as $i => $content){
        $tent_data[]=$content;
    }
    echo json_encode($tent_data);


?>