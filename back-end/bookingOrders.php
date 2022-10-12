<?php
    header('Access-Control-Allow-Origin:*');//跨網域，需要這段才不會被攔截
    header("Content-Type:application/json;charset=utf-8");

    require_once("./connect_cgd102g1.php");

    // 欄位名稱先取得對應營帳類型編號資料  
    $sql = "select tent_style_no from tent_style 
                    where 
                        area_no = 1
                    and tent_style_people = 2
                    and tent_style_type = 2;";

    $getTentStyle = $pdo->query($sql);
    $getTentStyle = $getTentStyle->fetchObject();
    $getTentStyle =  $getTentStyle->tent_style_no;
    echo $getTentStyle;
    
    // $getTentStyle = $getTentStyle->fetchAll(PDO::FETCH_ASSOC);
?>

<?php

    // $data = [];

    // foreach($getTentStyle as $i => $content){
    //     $data[]=$content;
    // }

    // echo json_encode($data);

?>