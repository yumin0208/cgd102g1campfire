<?php
    header("Access-Control-Allow-Origin:*");//跨網域，需要這段才不會被攔截
    // header("Content-Type:application/x-www-form-urlencoded");
        function addNews($news_title,$news_content,$news_status){
            try{
            require_once("./connect_cgd102g1.php");
            $sql="INSERT INTO news(news_title,news_content,news_pic,news_post_time,news_status)
                  VALUES('{$news_title}','{$news_content}','news_1.jpg',now(),'{$news_status}')";
            $pdo->exec($sql);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        addNews(
            $_POST['news_title'],$_POST['news_content'],$_POST['news_status']
            )
      
?>