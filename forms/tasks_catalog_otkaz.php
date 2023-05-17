<?php 
    session_start();
    require_once 'conect.php';

    $id_task = $_POST['id_task'];
    $type_task = $_POST['type_task'];
    $id_human = $_POST['id_human'];

    //Необходимые задания
    if($type_task == 1){
        //-1 исполнителя 
        mysqli_query($mysql, "UPDATE `need_tasks` SET `people_feedback` = `people_feedback`-1 WHERE `need_tasks`.`id_task` = '$id_task'");
        mysqli_query($mysql, "DELETE FROM players WHERE `players`.`id_task` = '$id_task' AND `players`.`id_human`= '$id_human' AND `players`.`id_type`= '$type_task' ");
        mysqli_query($mysql, "UPDATE `personal_date` SET `limite_task` = `limite_task`+1 WHERE `personal_date`.`id` = '$id_human'");

        $response = [
            "status" => true,
            "message"=> "Отказ принят 😞"
        ];

        echo json_encode($response);
            die();
    }
    
    //Особые поручения
    if($type_task == 3){
        //-1 исполнителя 
        mysqli_query($mysql, "UPDATE `special_tasks` SET `people_feedback` = `people_feedback`-1 WHERE `special_tasks`.`id_task` = '$id_task'");

        mysqli_query($mysql, "DELETE FROM players WHERE `players`.`id_task` = '$id_task' AND `players`.`id_human`= '$id_human' AND `players`.`id_type`= '$type_task' ");

        mysqli_query($mysql, "UPDATE `personal_date` SET `limite_task` = `limite_task`+1 WHERE `personal_date`.`id` = '$id_human'");

        $response = [
            "status" => true,
            "message"=> "Отказ принят 😞"
        ];	

        echo json_encode($response);
            die();

        

        
    }
    
    
?>