<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    // $discuss_no = $_REQUEST['discuss_no'];
    
    $sql1 = "select orders_no order_no, mem_id, mem_name, tent_no, tent_style_no, payment_methods, payment_status, orders_total order_total, date_format(checkin_date, '%Y-%m-%d') checkin_date, date_format(checkout_date, '%Y-%m-%d') checkout_date
    from orders join member on orders.mem_no = member.mem_no;";

    $discuss = $pdo->query($sql1);
    $discusses = $discuss->fetchAll(PDO::FETCH_ASSOC);
?>

<?php

    $data = [];

    foreach($discusses as $i => $content){
        $data[]=$content;
    }

    echo json_encode($data);

?>