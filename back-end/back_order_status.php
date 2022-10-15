<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-Type:application/json;charset=utf-8");
    
    function updateNews($order_no, $payment_status){
    try{
      require_once("./connect_cgd102g1.php");

            $sql="UPDATE orders
                  SET payment_status= $payment_status
                  WHERE orders_no=$order_no;";

            $pdo->exec($sql);

            $newsRow = $news->fetch(PDO::FETCH_ASSOC);
         


     }catch(PDOException $e){
         echo $e->getMessage();
       }
    }
    updateNews($_REQUEST['order_no'], $_REQUEST['payment_status'])
?>