<?php 
session_start();
require_once 'conect.php';

$id_task = $_POST['id_task'];
$id_type  = $_POST['id_type'];
$exclude_user = $_POST['exclude_user']; 
$id_human = $_POST['id_human'];
$level_access = $_POST['level_access'];//исключить, если 1 - надо исключить, а  2 - заблокировать

if($level_access == 1){ //исключить пользователя
    
    if($id_type == 1){ //-1 откл пользовательей в "Работы"
        mysqli_query($mysql, "UPDATE `need_tasks` SET `people_feedback` = `people_feedback`-1 WHERE `need_tasks`.`id_task` = '$id_task'");
    }

    if($id_type == 3){ //-1 откл пользовательей в "Особые поручения"
        mysqli_query($mysql, "UPDATE `special_tasks` SET `people_feedback` = `people_feedback`-1 WHERE `special_tasks`.`id_task` = '$id_task'");
    }

    mysqli_query($mysql, "DELETE FROM players WHERE `players`.`id_human` = '$id_human' AND `players`.`id_task` = '$id_task'"); //удаляю связь
    mysqli_query($mysql, "UPDATE `personal_date` SET `limite_task` = `limite_task`+1 WHERE `personal_date`.`id` = '$id_human'"); //+1 к лимиту пользователю
    

    $response=[
        "status" => true,
        "message" => "Изменения вступили в силу!"
    ];
    echo json_encode($response);
    die();
} 

if ($level_access == 2){ //удалить пользователя

    // if($id_type == 1){ //-1 откл пользовательей в "Работы"
    //     mysqli_query($mysql, "UPDATE `need_tasks` SET `people_feedback` = `people_feedback`-1 WHERE `need_tasks`.`id_task` = '$id_task'");
    // }

    // if($id_type == 3){ //-1 откл пользовательей в "Особые поручения"
    //     mysqli_query($mysql, "UPDATE `special_tasks` SET `people_feedback` = `people_feedback`-1 WHERE `special_tasks`.`id_task` = '$id_task'");
    // }

    // mysqli_query($mysql, "DELETE FROM players WHERE `players`.`id_human` = '$id_human' AND `players`.`id_task` = '$id_task'"); //удаляю связь
    
    // mysqli_query($mysql, "UPDATE `personal_date` SET `normal` = '0', `super_normal` = '0', `admin` = '0', `limite_task` = '-1' WHERE `id` = '$id_human'");
    
    $check_task = mysqli_query($mysql, "SELECT * FROM `players` WHERE `id_human`='$id_human'");
        if (mysqli_num_rows($check_task) > 0) {
            while($row = $check_task->fetch_assoc()){
                $id_task = $row['id_task'];
                $id_type = $row['id_type'];
                
                if ($row['id_type'] == 1){
                    mysqli_query($mysql, "UPDATE `need_tasks` SET `people_feedback` = `people_feedback`-1 WHERE `id_task` = '$id_task'");
                }
                if ($row['id_type'] == 3){
                    mysqli_query($mysql, "UPDATE `special_tasks` SET `people_feedback` = `people_feedback`-1 WHERE `id_task` = '$id_task'");
                }

                

                mysqli_query($mysql, "DELETE FROM players WHERE `players`.`id_human` = '$id_human' AND `players`.`id_task` = '$id_task'");
            }
        }
        
        mysqli_query($mysql, "UPDATE `personal_date` SET `normal` = '0', `super_normal` = '0', `admin` = '0', `limite_task` = '-1' WHERE `id` = '$id_human'");

        
    
    
    $response=[
        "status" => true,
        "message" => "Пользователь заблокирован!"
    ];
    echo json_encode($response);
    die();
}


?>