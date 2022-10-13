<?php
    header("Access-Control-Allow-Origin:*");//跨網域，需要這段才不會被攔截
    header("Content-Type:application/x-www-form-urlencoded");

    function createComment($discuss_no, $comment_content, $memNo)
    {

        try{
        require_once("./connect_cgd102g1.php");

        $sql="INSERT INTO comment(discuss_no, 
                                    comment_content, 
                                    mem_no, 
                                    comment_date, 
                                    comment_status)
                VALUES('{$discuss_no}','{$comment_content}','{$memNo}',now(),'1')";
        $pdo->exec($sql);

        }	
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    createComment(
        $_REQUEST['discuss_no'],$_REQUEST['comment_content'],$_REQUEST['memNo']
    )
?>