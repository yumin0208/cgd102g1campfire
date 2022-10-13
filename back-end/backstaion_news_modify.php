<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");
    try{
        require_once("./connect_cgd102g1.php");

        $sql = "select news_content,news_title,news_status,news_post_time
        from news 
        where news_no=:news_no";

        $news = $pdo->prepare($sql);
        //將資料代入參數中(未知數中);
        $news->bindValue(":news_no",$_REQUEST['news_no']);//使用pdostatement物件的bindValue()方法
        $news->execute();
        
        $newsdata=$news->fetch(PDO::FETCH_ASSOC);

        echo json_encode($newsdata); 
    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>

