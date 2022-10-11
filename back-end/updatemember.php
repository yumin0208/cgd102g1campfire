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

     }catch(PDOException $e){
         echo $e->getMessage();
       }
    }
    updateMember($_REQUEST['mem_id'],$_REQUEST['mem_name'],$_REQUEST['mem_nick_name'],$_REQUEST['mem_email'],$_REQUEST['mem_city'],$_REQUEST['mem_addr'],$_REQUEST['mem_phone'],$_REQUEST['mem_pic'])
?>