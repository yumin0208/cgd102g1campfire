<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-Type:application/json;charset=utf-8");
    
    function updateActivity($activity_no,$activity_name,$activity_subtitle,$activity_synopsis,$activity_info,$activity_price,$activity_suitable_guest,$activity_note){
    try{
      require_once("./connect_cgd102g1.php");
           $activity_no=$_REQUEST['activity_no'];

            $sql="UPDATE activity
                  SET activity_name='{$activity_name}', activity_subtitle='{$activity_subtitle}', activity_synopsis ='{$activity_synopsis}',activity_info='{$activity_info}',activity_price='{$activity_price}',activity_suitable_guest='{$activity_suitable_guest}',
                  activity_note='{$activity_note}'
                  WHERE activity_no='{$activity_no}'";

            $pdo->exec($sql);

            $sql2="select * from activity where activity_no=:activity_no ";
            $activity = $pdo->prepare( $sql2 ); //先編譯好
            $activity->bindValue(":activity_no", $_REQUEST['activity_no']); //代入資料
            $activity->execute();//執行之

            $activityRow = $activity->fetch(PDO::FETCH_ASSOC);
            
            //更新成功,將登入者的資料寫入session
            $_SESSION["activity_no"]=$activityRow["activity_no"];
            $_SESSION["activity_name"]=$activityRow["activity_name"];
            $_SESSION["activity_subtitle"]=$activityRow["activity_subtitle"];
            $_SESSION["activity_synopsis"]=$activityRow["activity_synopsis"];
            $_SESSION["activity_info"]=$activityRow["activity_info"];
            $_SESSION["activity_price"]=$activityRow["activity_price"];
            $_SESSION["activity_suitable_guest"]=$activityRow["activity_suitable_guest"];
            $_SESSION["activity_note"]=$activityRow["activity_note"];
            //送出更新後的資料
            $result = ["activity_name"=>$_SESSION["activity_name"],
                        "activity_subtitle"=>$_SESSION["activity_subtitle"],
                        "activity_synopsis"=>$_SESSION["activity_synopsis"],
                        "activity_info"=>$_SESSION["activity_info"],
                        "activity_price"=>$_SESSION["activity_price"],
                        "activity_suitable_guest"=>$_SESSION["activity_suitable_guest"],
                        "activity_note"=>$_SESSION["activity_note"],
                      ];
           
            echo json_encode($result);


     }catch(PDOException $e){
         echo $e->getMessage();
       }
    }
    updateActivity($_REQUEST['activity_no'],$_REQUEST['activity_name'],$_REQUEST['activity_subtitle'],$_REQUEST['activity_synopsis'],$_REQUEST['activity_info'],$_REQUEST['activity_price'],$_REQUEST['activity_suitable_guest'],$_REQUEST['activity_note'])
?>