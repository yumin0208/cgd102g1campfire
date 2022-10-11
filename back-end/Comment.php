<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    //給變數 搜索特定報告ID
    $discuss_no = $_REQUEST['discuss_no'];
    // echo $discuss_no;

    $sql1 = "select m.mem_no, m.mem_name, m.mem_pic, 
                d.discuss_no, d.discuss_title, d.discuss_content, date_format(d.discuss_post_time, '%Y-%m-%d') discuss_post_time, d.discuss_status, d.background_type, count(c.discuss_no) comment_count
            from member m join discuss d on m.mem_no = d.mem_no
                left join comment c on d.discuss_no = c.discuss_no
            where d.discuss_no=$discuss_no              
            group by c.discuss_no";

    $discuss = $pdo->query($sql1);
    $discusses = $discuss->fetchAll(PDO::FETCH_ASSOC);


    $sql2 = " select c.discuss_no, c.comment_no, c.comment_content, 
                    date_format(c.comment_date, '%Y-%m-%d') comment_date,
                    m.mem_no, m.mem_name, m.mem_pic
            from comment c join member m on c.mem_no = m.mem_no
            where discuss_no=$discuss_no";

    $comment = $pdo->query($sql2);
    $comments = $comment->fetchAll(PDO::FETCH_ASSOC);
    

?>

<?php

    $data = [];
    foreach($discusses as $i => $content){
        $data[]=$content;
    }

    $commentData = [];
    foreach($comments as $i => $content){
        $commentData[]=$content;
    }

    array_push($data,$commentData);
    echo json_encode($data);

?>