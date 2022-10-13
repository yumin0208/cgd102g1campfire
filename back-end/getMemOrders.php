<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    //給變數 會員編號
    $mem_no = $_REQUEST['mem_no'];

    //訂單編號、入住日期、退房日期、下定日期、總金額、付款狀態、個別營帳編號、地區名稱....
    $sql = "SELECT o.orders_no, o.checkin_date, o.checkout_date, o.orders_time,o.payment_status
             ,o.orders_total,o.tent_no ,a.area_name, e.equip_name,e.equip_price,f.food_name,f.food_price,t.tent_style_name,t.tent_style_price,ac.activity_name,ac.activity_price
            FROM orders o JOIN area a ON o.area_no =a.area_no
                          JOIN equip e ON o.equip_no =e.equip_no
                          JOIN food f ON o.food_no =f.food_no
                          JOIN activity ac ON o.activity_no =ac.activity_no
                          JOIN tent_style t ON o.tent_style_no =t.tent_style_no
            WHERE mem_no=$mem_no;";

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