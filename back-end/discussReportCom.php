<?php
    header("Access-Control-Allow-Origin:*");//跨網域，需要這段才不會被攔截
    header("Content-Type:application/x-www-form-urlencoded");

    function reportDiscuss($comment_no, $memNo, $report_content)
    {

        try{
        require_once("./connect_cgd102g1.php");

        $sql="INSERT INTO report(comment_no,
                                mem_no,
                                report_content,
                                report_time,
                                report_result)
                VALUES('{$comment_no}','{$memNo}','{$report_content}',now(),0)";
        $pdo->exec($sql);
        }	
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    reportDiscuss(
        $_REQUEST['comment_no'],$_REQUEST['memNo'],$_REQUEST['report_content']
    )
?>