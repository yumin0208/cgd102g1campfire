<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    function bookingOrders($product_order_no, $product_no, $product_order_list_qty, $product_order_list_price)
    {
        try{
        require_once("./connect_cgd102g1.php");

        $sql = "insert into product_order_list(product_order_no, product_no, product_order_list_qty, product_order_list_price)
        values
        ($product_order_no,  $product_no, $product_order_list_qty, $product_order_list_price);";

        $pdo->query($sql);
        }	
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    bookingOrders($_REQUEST['product_order_no'], $_REQUEST['product_no'], $_REQUEST['product_order_list_qty'], $_REQUEST['product_order_list_price']);
?>