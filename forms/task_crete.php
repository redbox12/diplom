<?php 
session_start();
require_once 'conect.php';

if($_POST['type_task'] === '1'){ //Необходимая помощь 
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $clothes = $_POST['clothes'];
    $amout_people = $_POST['amout_people'];
    $description = $_POST['description'];
    $type_task = $_POST['type_task'];
    $admin = $_SESSION['user']['admin'];

    $error_fields = [];

    if($name === ''){
        $error_fields[]='name';
    }
    
    if($date === ''){
        $error_fields[]='date';
    }
    
    if($time === ''){
        $error_fields[]='time';
    }

    if($clothes === ''){
        $error_fields[]='clothes';
    }
    
    if($amout_people === ''){
        $error_fields[]='amout_people';
    }
    
    if($description === ''){
        $error_fields[]='description';
    }
    
    
    if(!empty($error_fields)){
        $response =[
            "status" => false,
            "type" => 1, //тип ошибки
            "message"=> "Проверте правильность полей",
            "fields" => $error_fields
            
        ];
        
        echo json_encode($response);
        die();
    }

    mysqli_query($mysql,"INSERT INTO `task_all` (`id_task`, `id_type`, `id_admin`) VALUES (NULL, '$type_task', '$admin')");

    mysqli_query($mysql,"INSERT INTO `need_tasks` (`id_task`, `id_type`, `name`, `date`, `time`, `clothes`, `people_amout`, `description`, `photo`) VALUES (NULL, '$type_task', '$name', '$date', '$time', '$clothes', '$amout_people', '$description', '1')");
    
    $response = [
        "status" => true,
        "message" => "Успешно создали задачу"
    ];
    echo json_encode($response);
}

if($_POST['type_task'] === '2'){ //Материальная помощь 

}

if($_POST['type_task'] === '3'){ //Особые поручения 

}



?>