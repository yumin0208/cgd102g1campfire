<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    function bookingOrders($memNo, $whatArea, $howManyPeopleGet, $whichTentType, $activityNo, $foodNo, $equipNo, $orderTotal, $checkIn, $checkOut)
    {
        try{
        require_once("./connect_cgd102g1.php");

        $sql = "select tent_style_no from tent_style 
        where area_no = $whatArea
        and tent_style_people = $howManyPeopleGet
        and tent_style_type = $whichTentType;";

        $getTentStyle = $pdo->query($sql);
        $getTentStyle = $getTentStyle->fetchObject();
        $getTentStyle =  $getTentStyle->tent_style_no;

        $sqlOrder = "INSERT INTO orders(
            mem_no, tent_style_no, activity_no, food_no,
            equip_no, area_no, payment_methods, payment_status,
            orders_total, orders_time, checkin_date, checkout_date
            ) VALUES (
                $memNo, $getTentStyle, $activityNo, $foodNo, $equipNo, 
                $whatArea, 1, 1, $orderTotal, now(), $checkIn, $checkOut
            );";
         $pdo->exec($sqlOrder);
        
        echo "1";
        }	
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    bookingOrders($_REQUEST['memNo'], $_REQUEST['whatArea'], $_REQUEST['howManyPeopleGet'], $_REQUEST['whichTentType'], $_REQUEST['activityNo'], $_REQUEST['foodNo'], $_REQUEST['equipNo'], $_REQUEST['orderTotal'], $_REQUEST['checkIn'], $_REQUEST['checkOut']);
?>

