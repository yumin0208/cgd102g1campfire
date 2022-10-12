<?php
    header("Access-Control-Allow-Origin:*");//跨網域，需要這段才不會被攔截
    // header("Content-Type:application/x-www-form-urlencoded");

    function createDiscuss($mem_no, $discuss_title, $discuss_content, $background_type)
    {

        try{
        require_once("./connect_cgd102g1.php");

        $sql="INSERT INTO discuss(mem_no, discuss_title, discuss_content, 
                            discuss_post_time, discuss_status,comment_count,background_type)
                VALUES('{$mem_no}','{$discuss_title}','{$discuss_content}', 
                        now(), 1, null,'{$background_type}')";
        $pdo->exec($sql);
        
        echo "1";
        }	
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    createDiscuss(
        $_REQUEST['mem_no'],$_REQUEST['discuss_title'],$_REQUEST['discuss_content'],$_REQUEST['background_type']
    )
?>