<?php
    header("Access-Control-Allow-Origin:*");//跨網域，需要這段才不會被攔截
    // header("Content-Type:application/x-www-form-urlencoded");
    //$content = trim(file_get_contents("php://input"));
    //$data = json_decode($content);


        function createMember($mem_id,$mem_psw,$mem_name,$mem_nick_name,$mem_email,$mem_city,$mem_addr,$mem_phone){
            try{
            require_once("./connect_cgd102g1.php");

            $findExistSql = "SELECT * 
            FROM member 
            WHERE mem_id=:mem_id";
            $existAccount = $pdo -> prepare($findExistSql);
            $existAccount->bindValue(":mem_id",$_POST["mem_id"]);
            $existAccount->execute();

            if( $existAccount->rowCount() == 0 ){

            $sql="INSERT INTO member(mem_id,mem_psw,mem_name,mem_nick_name,mem_email,mem_city,mem_addr,mem_phone,mem_pic,mem_status,register_date)
                  VALUES('{$mem_id}','{$mem_psw}','{$mem_name}','{$mem_nick_name}','{$mem_email}','{$mem_city}','{$mem_addr}','{$mem_phone}',1,1,now())";
            $pdo->exec($sql);

            // //write into session
            // $_SESSION["mem_no"]=$mem_no;
            // $_SESSION["mem_id"]=$mem_id;
            // $_SESSION["mem_name"]=$mem_name;
            // $_SESSION["mem_nick_name"]=$mem_nick_name;
            // $_SESSION["mem_city"]=$mem_city;
            // $_SESSION["mem_addr"]=$mem_addr;
            // $_SESSION["mem_phone"]=$mem_phone;
            // //pack data
            // $result = ["mem_no"=>$_SESSION["mem_no"],
            //            "mem_id"=>$_SESSION["mem_id"],
            //            "mem_name"=>$_SESSION["mem_name"],
            //            "mem_email"=>$_SESSION["mem_email"],
            //            "mem_nick_name"=>$_SESSION["mem_nick_name"],
            //            "mem_city"=>$_SESSION["mem_city"],
            //            "mem_addr"=>$_SESSION["mem_addr"],
            //            "mem_phone"=>$_SESSION["mem_phone"]];
            // echo json_encode($result);
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
        createMember(
            $_POST['mem_id'],$_POST['mem_psw'],$_POST['mem_name'],$_POST['mem_nick_name'],$_POST['mem_email'],$_POST['mem_city'],$_POST['mem_addr'],$_POST['mem_phone']
            )
      
?>