<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-Type:application/json;charset=utf-8");
    
    function updateNews($news_no,$news_title,$news_content,$news_status,$news_post_time){
    try{
      require_once("./connect_cgd102g1.php");
           $news_no=$_REQUEST['news_no'];

            $sql="UPDATE news
                  SET news_title='{$news_title}', news_content='{$news_content}' , news_status ='{$news_status}' ,
                  news_post_time='{$news_post_time}'
                  WHERE news_no='{$news_no}'";

            $pdo->exec($sql);

            $sql2="select * from news where news_no=:news_no ";
            $news = $pdo->prepare( $sql2 ); //先編譯好
            $news->bindValue(":news_no", $_REQUEST['news_no']); //代入資料
            $news->execute();//執行之

            $newsRow = $news->fetch(PDO::FETCH_ASSOC);
            
            //更新成功,將登入者的資料寫入session
            $_SESSION["news_no"]=$newsRow["news_no"];
            $_SESSION["news_title"]=$newsRow["news_title"];
            $_SESSION["news_content"]=$newsRow["news_content"];
            $_SESSION["news_status"]=$newsRow["news_status"];
            $_SESSION["news_post_time"]=$newsRow["news_post_time"];
            //送出更新後的資料
            $result = ["news_post_time"=>$_SESSION["news_post_time"],
                        "news_no"=>$_SESSION["news_no"],
                        "news_title"=>$_SESSION["news_title"],
                        "news_content"=>$_SESSION["news_content"],
                        "news_status"=>$_SESSION["news_status"]];
           
            echo json_encode($result);


     }catch(PDOException $e){
         echo $e->getMessage();
       }
    }
    updateNews($_REQUEST['news_no'],$_REQUEST['news_title'],$_REQUEST['news_content'],$_REQUEST['news_status'],$_REQUEST['news_post_time'])
?>