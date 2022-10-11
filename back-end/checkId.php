<?php
    header("Access-Control-Allow-Origin:*");//跨網域，需要這段才不會被攔截
        function checkId($mem_id){
            try{
            require_once("./connect_cgd102g1.php");

            $findExistSql = "SELECT * 
            FROM member 
            WHERE mem_id=:mem_id";
            $existAccount = $pdo -> prepare($findExistSql);
            $existAccount->bindValue(":mem_id",$_POST["mem_id"]);
            $existAccount->execute();

            if( $existAccount->rowCount() == 0 ){
            echo "1";
            }
            else{ //找得到
            //傳回此帳號已存在
              echo "0";
            }}	
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        checkId($_POST['mem_id'])
      
?>