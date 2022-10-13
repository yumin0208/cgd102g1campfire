<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = " SELECT * FROM comment";

    $comment = $pdo->query($sql2);
    $comments = $comment->fetchAll(PDO::FETCH_ASSOC);
    

?>

<?php

    $commentData = [];
    foreach($comments as $i => $content){
        $commentData[]=$content;
    }

    echo json_encode($data);

?>