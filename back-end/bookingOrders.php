<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    // 欄位名稱
    
    $sql1 = "select tent_style_no from tent_style 
                    where 
                        area_no = 1
                    and tent_style_people = 2
                    and tent_style_type = 2;";

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