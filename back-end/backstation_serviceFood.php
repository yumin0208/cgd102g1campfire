<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = 
        "select * 

        from food";

    $food = $pdo->query($sql);

    $foods = $food->fetchAll(PDO::FETCH_ASSOC);//php data object 獲取關聯
    
?>

<?php

    $food_data = [];

    foreach($foods as $i => $content){
        $food_data[]=$content;
    }
    echo json_encode($food_data);


?>