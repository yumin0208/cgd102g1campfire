<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");
    try{
        require_once("./connect_cgd102g1.php");

        $sql = "SELECT product_no,product_type_no,product_name,product_price, product_pic, product_status, product_update, product_qty
        from product 
        where product_no=:product_no";

        $product = $pdo->prepare($sql);
        //將資料代入參數中(未知數中);
        $product->bindValue(":product_no",$_REQUEST['product_no']);//使用pdostatement物件的bindValue()方法
        $product->execute();
        
        $productdata=$product->fetch(PDO::FETCH_ASSOC);

        echo json_encode($productdata); 
    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>

