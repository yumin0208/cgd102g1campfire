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

            // $discusses->bindValue(":discuss_no", $_REQUEST['discuss_no']); //代入資料
            // $discusses->execute();//執行之

            // $discussesRow = $discusses->fetch(PDO::FETCH_ASSOC);
            // //送出更新後的資料
            // $result = ["mem_email"=>$_SESSION["mem_email"],
            //             "mem_no"=>$_SESSION["mem_no"],
            //             "mem_id"=>$_SESSION["mem_id"],
            //             "mem_name"=>$_SESSION["mem_name"],
            //             "mem_nick_name"=>$_SESSION["mem_nick_name"],
            //             "mem_email"=>$_SESSION["mem_email"],
            //             "mem_city"=>$_SESSION["mem_city"],
            //             "mem_addr"=>$_SESSION["mem_addr"],
            //             "mem_phone"=>$_SESSION["mem_phone"],
            //             "mem_status"=>$_SESSION["mem_status"]
            //         ];
        
            // echo json_encode($result);

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    upDateDiscuss($_REQUEST['discuss_no'], $_REQUEST['discuss_status'])
?>