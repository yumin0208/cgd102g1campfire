<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-Type:application/json;charset=utf-8");
    
    function upDateDiscuss($discuss_no, $discuss_status){
        try{
            require_once("./connect_cgd102g1.php");
            
            $discuss_no=$_REQUEST['discuss_no'];

            $sql="update discuss
                    set discuss_status='{$discuss_status}'
                    where discuss_no='{$discuss_no}'";

            $pdo->exec($sql);

            $sql2="select * 
                    from discuss 
                    where discuss_no=:discuss_no ";
            $discuss = $pdo->prepare( $sql2 ); //先編譯好
            $discuss->bindValue(":discuss_no", $_REQUEST['discuss_no']); //代入資料
            $discuss->execute();//執行之

            $discussRow = $discuss->fetch(PDO::FETCH_ASSOC);

            //更新成功,將登入者的資料寫入session
            $_SESSION["discuss_no"] = $discussRow["discuss_no"];
            $_SESSION["discuss_status"] = $discussRow["discuss_status"];
            //送出更新後的資料
            $result = [
                "discuss_no"=>$_SESSION["discuss_no"],
                "discuss_status"=>$_SESSION["discuss_status"],
            ];

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    upDateDiscuss($_REQUEST['discuss_no'], $_REQUEST['discuss_status'])
?>