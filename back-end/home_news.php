<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = "select * from news order by news_no desc limit 3";

    $news = $pdo->query($sql);

    $newses = $news->fetchAll();
    

?>

<?php

    $newsList = [];

    foreach($newses as $i => $content){
        $newsList[]=$content;
    }
    echo json_encode($newsList);

?>