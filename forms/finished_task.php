<?php 
session_start();
require_once 'conect.php';

$id_task = $_POST['id_task'];
$type_task  = $_POST['type_task'];

//Работы 
if($type_task == 1){
    
    $check_task = mysqli_query($mysql, "SELECT * FROM `players` WHERE `id_task`='$id_task' AND `id_type`='$type_task'");
        if (mysqli_num_rows($check_task) > 0) {
            while($row = $check_task->fetch_assoc()){
                
                $id_human = $row['id_human'];
                mysqli_query($mysql, "UPDATE `personal_date` SET `limite_task` = `limite_task`+1 WHERE `id` = '$id_human'");
              
            }
        }

    mysqli_query($mysql, "DELETE FROM players WHERE `players`.`id_task` = '$id_task'  AND `id_type`='$type_task'");  
    mysqli_query($mysql, "DELETE FROM need_tasks WHERE `need_tasks`.`id_task` = '$id_task'");
    $response=[
        "status" => true,
        "message" => "Задание завершено"
    ];
    echo json_encode($response);
    die();
}

//Сбор средств
if($type_task == 2){
    mysqli_query($mysql, "DELETE FROM material_task WHERE `material_task`.`id_task` = '$id_task'");
    $response=[
        "status" => true,
        "message" => "Задание завершено"
    ];
    echo json_encode($response);
    die();
}

//Особые поручения
if($type_task == 3){
    $check_task = mysqli_query($mysql, "SELECT * FROM `players` WHERE `id_task`='$id_task' AND `id_type`='$type_task'");
    if (mysqli_num_rows($check_task) > 0) {
        while($row = $check_task->fetch_assoc()){
            
            $id_human = $row['id_human'];
            mysqli_query($mysql, "UPDATE `personal_date` SET `limite_task` = `limite_task`+1 WHERE `id` = '$id_human'");
          
        }
    }
    mysqli_query($mysql, "DELETE FROM players WHERE `players`.`id_task` = '$id_task'  AND `id_type`='$type_task'");  
    mysqli_query($mysql, "DELETE FROM special_tasks WHERE `special_tasks`.`id_task` = '$id_task'");

$response=[
    "status" => true,
    "message" => "Задание завершено"
];
echo json_encode($response);
die();
}

else{
    $responnse=[
        "status" => false,
        "message" => 'Ошибка, попробуйте обновить страницу'
        
    ];
    echo json_encode($response);
    die();
    
}






?>