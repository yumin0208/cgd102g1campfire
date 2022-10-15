<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-Type:application/json;charset=utf-8");
    
    function updateNews($order_no, $tent_no){
    try{
      require_once("./connect_cgd102g1.php");

            $sql="UPDATE orders
                  SET tent_no= $tent_no
                  WHERE orders_no=$order_no;";

            $pdo->exec($sql);

            $newsRow = $news->fetch(PDO::FETCH_ASSOC);
         


     }catch(PDOException $e){
         echo $e->getMessage();
       }
    }
    updateNews($_REQUEST['order_no'], $_REQUEST['tent_no'])
?>