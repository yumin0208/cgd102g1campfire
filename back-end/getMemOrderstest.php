<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    //給變數 會員編號
    $product_order_no = $_REQUEST['product_order_no'];

    //訂單編號、入住日期、退房日期、下定日期、總金額、付款狀態、個別營帳編號、地區名稱....
    $sql = "SELECT *
            FROM product_order_list l join product p on l.product_no = p.product_no 
            WHERE l.product_order_no = $product_order_no;";

    $camporder = $pdo->query($sql);
    $camporders = $camporder->fetchAll(PDO::FETCH_ASSOC);
?>

<?php

    $data = [];
    foreach($camporders as $i => $content){
        $data[]=$content;
    }

    echo json_encode($data);

?>