<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-Type:application/json;charset=utf-8");
    
    function updateNews($mem_no,$mem_id,$mem_name,$mem_nick_name,$mem_email,$mem_city,$mem_addr,$mem_phone,$mem_status){
    try{
      require_once("./connect_cgd102g1.php");
           $mem_no=$_REQUEST['mem_no'];

            $sql="UPDATE member
                  SET mem_id='{$mem_id}', mem_name='{$mem_name}' , mem_nick_name ='{$mem_nick_name}' ,
                  mem_email='{$mem_email}' , mem_city='{$mem_city}' , mem_addr='{$mem_addr}' , mem_phone='{$mem_phone}', mem_status='{$mem_status}'
                  WHERE mem_no='{$mem_no}'";

            $pdo->exec($sql);

            $sql2="select * from member where mem_no=:mem_no ";
            $news = $pdo->prepare( $sql2 ); //先編譯好
            $news->bindValue(":mem_no", $_REQUEST['mem_no']); //代入資料
            $news->execute();//執行之

            $newsRow = $news->fetch(PDO::FETCH_ASSOC);
            
            //更新成功,將登入者的資料寫入session
            $_SESSION["mem_no"]=$newsRow["mem_no"];
            $_SESSION["mem_id"]=$newsRow["mem_id"];
            $_SESSION["mem_name"]=$newsRow["mem_name"];
            $_SESSION["mem_nick_name"]=$newsRow["mem_nick_name"];
            $_SESSION["mem_email"]=$newsRow["mem_email"];
            $_SESSION["mem_city"]=$newsRow["mem_city"];
            $_SESSION["mem_addr"]=$newsRow["mem_addr"];
            $_SESSION["mem_phone"]=$newsRow["mem_phone"];
            $_SESSION["mem_status"]=$newsRow["mem_status"];
            //送出更新後的資料
            $result = ["mem_email"=>$_SESSION["mem_email"],
                        "mem_no"=>$_SESSION["mem_no"],
                        "mem_id"=>$_SESSION["mem_id"],
                        "mem_name"=>$_SESSION["mem_name"],
                        "mem_nick_name"=>$_SESSION["mem_nick_name"],
                        "mem_email"=>$_SESSION["mem_email"],
                        "mem_city"=>$_SESSION["mem_city"],
                        "mem_addr"=>$_SESSION["mem_addr"],
                        "mem_phone"=>$_SESSION["mem_phone"],
                        "mem_status"=>$_SESSION["mem_status"]
                      ];
           
            echo json_encode($result);


     }catch(PDOException $e){
         echo $e->getMessage();
       }
    }
    updateNews($_REQUEST['mem_no'],$_REQUEST['mem_id'],$_REQUEST['mem_name'],$_REQUEST['mem_nick_name'],$_REQUEST['mem_email'],$_REQUEST['mem_city'],$_REQUEST['mem_addr'],$_REQUEST['mem_phone'],$_REQUEST['mem_status'])
?>