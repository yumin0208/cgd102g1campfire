<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-Type:application/json;charset=utf-8");
    try{
      require_once("./connect_cgd102g1.php");
        $findMemSql = "update member
                       set  mem_name=:mem_name,mem_nick_name=:mem_nick_name,mem_email=:mem_email,mem_phone=:mem_phone,mem_city=:mem_city,mem_addr=:mem_addr,mem_pic=:mem_pic
                       where mem_id=:mem_id";
        $updateMem = $pdo -> prepare($findMemSql);
        $updateMem->bindValue(":mem_id",$_POST["mem_id"]);
        $updateMem->bindValue(":mem_name",$_POST["name"]);
        $updateMem->bindValue(":mem_nick_name",$_POST["mem_nick_name"]);
        $updateMem->bindValue(":mem_email",$_POST["email"]);
        $updateMem->bindValue(":mem_phone",$_POST["mem_phone"]);
        $updateMem->bindValue(":mem_city",$_POST["mem_city"]);
        $updateMem->bindValue(":mem_addr",$_POST["mem_addr"]);
        $updateMem->bindValue(":mem_pic",$_POST["mem_pic"]);
        $updateMem->execute();
      }catch(PDOException $e){
        echo $e->getMessage();
      }
?>