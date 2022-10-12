<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    // 欄位名稱

    // 接收到的條件資料
    $whichTentType = $_REQUEST['whichTentType'];
    $howManyPeopleGet = $_REQUEST['howManyPeopleGet'];
    $areaNoGet = $_REQUEST['areaNoGet'];
    $whatMonth = $_REQUEST['whatMonth'];

    // $discuss_no = $_REQUEST['discuss_no'];
    
    $sql1 = "select 
                date_format(o.checkin_date, '%Y-%m-%d') checkIn,
                date_format(o.checkout_date, '%Y-%m-%d') checkOut
            from orders o join tent_style t on o.tent_style_no = t.tent_style_no
            where 
            date_format(o.checkin_date, '%Y-%m') = $whatMonth
            and   t.tent_style_type = $whichTentType
            and   t.area_no = $areaNoGet 
            and   t.tent_style_people = $howManyPeopleGet;";

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