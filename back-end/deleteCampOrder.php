<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-Type:application/json;charset=utf-8");
    
    function deleteCampOrder($orders_no){
    try{
      require_once("./connect_cgd102g1.php");
           $orders_no=$_REQUEST['orders_no'];

            $sql="DELETE FROM orders
                  WHERE orders_no='{$orders_no}';";

            $pdo->exec($sql);


     }catch(PDOException $e){
         echo $e->getMessage();
       }
    }
    deleteCampOrder($_REQUEST['orders_no'])
?>