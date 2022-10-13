<?php

    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    $sql = 
        "select * 

        from equip";

    $equip = $pdo->query($sql);

    $equips = $equip->fetchAll(PDO::FETCH_ASSOC);//php data object 獲取關聯
    
?>

<?php

    $equip_data = [];

    foreach($equips as $i => $content){
        $equip_data[]=$content;
    }
    echo json_encode($equip_data);

?>