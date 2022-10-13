<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-Type:application/json;charset=utf-8");
    
    function updateMember($mem_id,$mem_name,$mem_nick_name,$mem_email,$mem_city,$mem_addr,$mem_phone,$mem_pic){
    try{
      require_once("./connect_cgd102g1.php");
           $mem_id=$_REQUEST['mem_id'];

            $sql="UPDATE member
                  SET mem_name='{$mem_name}',mem_nick_name='{$mem_nick_name}',mem_email='{$mem_email}',mem_city='{$mem_city}',mem_addr='{$mem_addr}',mem_phone='{$mem_phone}',mem_pic='{$mem_pic}'
                  WHERE mem_id='{$mem_id}'";
            // $sql="UPDATE member
            //       SET mem_name='蔡哈囉',mem_nick_name='菜菜',mem_email='add@gmail.com',mem_city='台南市',mem_addr='更新地址',mem_phone='0922222123',mem_pic=4
            //       WHERE mem_id='tktk'";

            $pdo->exec($sql);

            $sql2="select * from member where mem_id=:mem_id ";
            $member = $pdo->prepare( $sql2 ); //先編譯好
            $member->bindValue(":mem_id", $_REQUEST['mem_id']); //代入資料
            $member->execute();//執行之

            $memRow = $member->fetch(PDO::FETCH_ASSOC);
            
            //更新成功,將登入者的資料寫入session
            $_SESSION["mem_no"]=$memRow["mem_no"];
            $_SESSION["mem_id"]=$memRow["mem_id"];
            $_SESSION["mem_name"]=$memRow["mem_name"];
            $_SESSION["mem_nick_name"]=$memRow["mem_nick_name"];
            $_SESSION["mem_city"]=$memRow["mem_city"];
            $_SESSION["mem_addr"]=$memRow["mem_addr"];
            $_SESSION["mem_phone"]=$memRow["mem_phone"];
            $_SESSION["mem_pic"]=$memRow["mem_pic"];
            $_SESSION["mem_status"]=$memRow["mem_status"];
            $_SESSION["mem_email"]=$memRow["mem_email"];
            $_SESSION["register_date"]=$memRow["register_date"];
            //送出更新後的資料
            $result = ["mem_no"=>$_SESSION["mem_no"],
                        "mem_id"=>$_SESSION["mem_id"],
                        "mem_name"=>$_SESSION["mem_name"],
                        "mem_email"=>$_SESSION["mem_email"],
                        "mem_nick_name"=>$_SESSION["mem_nick_name"],
                        "mem_city"=>$_SESSION["mem_city"],
                        "mem_addr"=>$_SESSION["mem_addr"],
                        "mem_phone"=>$_SESSION["mem_phone"],
                        "register_date"=>$_SESSION["register_date"],
                        "mem_status"=>$_SESSION["mem_status"],
                        "mem_pic"=>$_SESSION["mem_pic"]];
           
            echo json_encode($result);


     }catch(PDOException $e){
         echo $e->getMessage();
       }
    }
    updateMember($_REQUEST['mem_id'],$_REQUEST['mem_name'],$_REQUEST['mem_nick_name'],$_REQUEST['mem_email'],$_REQUEST['mem_city'],$_REQUEST['mem_addr'],$_REQUEST['mem_phone'],$_REQUEST['mem_pic'])
?>