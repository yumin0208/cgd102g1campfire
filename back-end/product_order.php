<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    function bookingOrders($mem_no, $mem_city, $mem_addr, $order_payment)
    {
        try{
        require_once("./connect_cgd102g1.php");

        $sql = "insert into product_order(mem_no, product_order_status, product_order_time, product_order_pickup_place, product_order_total)
        values
        ($mem_no, 1, now(), concat('$mem_city','$mem_addr'), $order_payment);";

        $pdo->query($sql);
        
        echo $pdo->lastInsertId();
        }	
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    bookingOrders($_REQUEST['mem_no'], $_REQUEST['mem_city'], $_REQUEST['mem_addr'], $_REQUEST['order_payment']);
?>