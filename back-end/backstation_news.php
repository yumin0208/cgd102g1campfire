<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = "select * from news";

    $news = $pdo->query($sql);

    $newses = $news->fetchAll();
    

?>

<?php

    $news_data = [];

    foreach($newses as $i => $content){
        $news_data[]=$content;
    }
    echo json_encode($news_data);

?>