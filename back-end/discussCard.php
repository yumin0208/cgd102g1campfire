<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = "select m.mem_no, m.mem_nick_name, m.mem_pic, 
            d.discuss_no, d.discuss_title, d.discuss_content, d.discuss_post_time, discuss_post_time, d.discuss_status, d.background_type, count(c.discuss_no)comment_count
            from member m join discuss d on m.mem_no = d.mem_no
                    left join comment c on d.discuss_no = c.discuss_no
            group by d.discuss_no";

    $discuss = $pdo->query($sql);

    $cards = $discuss->fetchAll(PDO::FETCH_ASSOC);
    

?>

<?php

    $data = [];

    foreach($cards as $i => $content){
        $data[]=$content;
    }
    echo json_encode($data);

?>