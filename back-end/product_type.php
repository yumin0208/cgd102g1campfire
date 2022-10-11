<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = "select * from `product_type`";

    $product = $pdo->query($sql);

    $products = $product->fetchAll();
    

?>

<?php

    $product_data = [];

    foreach($products as $i => $content){
        $product_data[]=$content;
    }
    echo json_encode($product_data);

?>