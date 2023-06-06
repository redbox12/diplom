<?php 
session_start();
require_once 'conect.php';

$id_task = $_POST['id_task'];
$type_task = $_POST['id_type'];


$get_need_task = $_POST['get_need_task'];
$get_mtrl_task = $_POST['get_mtrl_task'];
$get_special_task = $_POST['get_special_task'];

$need_edit_task = $_POST['need_edit_task'];  //переменная для изменения данных
$mtrl_edit_task = $_POST['mtrl_edit_task']; 
$special_edit_task = $_POST['special_edit_task'];

if($get_need_task) { //отдаю значения "Работ"
    
    $result = mysqli_query($mysql, "SELECT * FROM `need_tasks` WHERE `id_task`='$id_task'");
    $row = $result->fetch_assoc();
    
    $response = [
        "status" => true,
        "name" => $row['name'], 
        "date" =>  $row['date'],
        "time" => $row['time'],
        "time_length" => $row['time_length'],
        "clothes" => $row['clothes'],
        "people_amout" => $row['people_amout'],
        "people_feedback" => $row['people_feedback'],
        "description" => $row['description'],
        "photo" => $row['photo'],
        "name_admin" => $row_admin['name'],
        "telephone_admin" => $row_admin['telephone']
    ];
    $result -> free();
    echo json_encode($response);
    die();
      
}

if($need_edit_task) { //отдаю значения "Работ" 

    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $time_length = $_POST['time_length'];
    $clothes = $_POST['clothes'];
    $amout_people = $_POST['amout_people'];
    $description = $_POST['description'];
    //$admin = $_SESSION['user']['admin']; 
    $edit = 1;

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

    if($time_length === ''){
        $error_fields[]='time_length';
    }

    if($clothes === 'Выбрать...'){
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

    

    mysqli_query($mysql, "UPDATE `need_tasks` SET `name` = '$name', `date` = '$date', `time` = '$time',`time_length` = '$time_length', `clothes` = '$clothes', `people_amout` = '$amout_people', `description` = '$description', `edit` = '$edit' WHERE `need_tasks`.`id_task` = '$id_task'");
    
    
    //$mysql->close();
    
    $response = [
        "status" => true,
        "message" => "Задание успешно изменено!"
    ];
    echo json_encode($response);

}

if($get_mtrl_task) { //отдаю значения "Сбор средств"
    
    $result = mysqli_query($mysql, "SELECT * FROM `material_task` WHERE `id_task`='$id_task'");
    $row = $result->fetch_assoc();
    
    $response = [
        "status" => true,
        "name_mtrl" => $row['name'], 
        "date_start" =>  $row['date_start'],
        "date_end" => $row['date_end'],
        "card_bank" => $row['card_bank'],
        "summ_deneg" => $row['summ_deneg'],
        "description_mtrl" => $row['description']
    ];
    $result -> free();
    echo json_encode($response);
    die();
   
    
}

if($mtrl_edit_task) { //отдаю значения "Работ" 

    $name_mtrl = $_POST['name_mtrl'];
    $date_start= $_POST['date_start'];
    $date_end = $_POST['date_end'];
    $card_mtrl = $_POST['card_mtrl'];
    $summ_den_mtrl = $_POST['summ_den_mtrl'];
    $description_mtrl = $_POST['description_mtrl'];
    $admin = $_SESSION['user']['id'];
    
    
    $edit = 1;

    $error_fields = [];

    if($name_mtrl === ''){
        $error_fields[]='name_mtrl';
    }
    
    if($date_start === ''){
        $error_fields[]='date_start';
    }
    
    if($date_end === ''){
        $error_fields[]='date_end';
    }

    
    if($card_mtrl === ''){
        $error_fields[]='card_mtrl';
    }
    
    if($summ_den_mtrl === ''){
        $error_fields[]='summ_den_mtrl';
    }
    
    if($description_mtrl === ''){
        $error_fields[]='description_mtrl';
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
    

    mysqli_query($mysql, "UPDATE `material_task` SET `name` = '$name_mtrl', `date_start` = '$date_start', `date_end` = '$date_end', `card_bank` = '$card_mtrl', `summ_deneg` = '$summ_den_mtrl', `description` = '$description_mtrl' WHERE `material_task`.`id_task` = '$id_task'");
    
    
    //$mysql->close();
    
    $response = [
        "status" => true,
        "message" => "Задание успешно изменено!"
    ];
    echo json_encode($response);
    die();

}

if($get_special_task) { //отдаю значения "Работ"
    
    $result = mysqli_query($mysql, "SELECT * FROM `special_tasks` WHERE `id_task`='$id_task'");
    $row = $result->fetch_assoc();
    
    $response = [
        "status" => true,
        "name" => $row['name'], 
        "date" =>  $row['date'],
        "time" => $row['time'],
        "time_length" => $row['time_length'],
        "clothes" => $row['clothes'],
        "people_amout" => $row['people_amout'],
        "people_feedback" => $row['people_feedback'],
        "description" => $row['description'],
    ];
    $result -> free();
    echo json_encode($response);
    die();
      
}

if($special_edit_task) { //отдаю значения "Работ" 

    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $time_length = $_POST['time_length'];
    $clothes = $_POST['clothes'];
    $amout_people = $_POST['amout_people'];
    $description = $_POST['description'];
    //$admin = $_SESSION['user']['admin']; 
    $edit = 1;

    $error_fields = [];

    if($name === ''){
        $error_fields[]='name_s';
    }
    
    if($date === ''){
        $error_fields[]='date_s';
    }
    
    if($time === ''){
        $error_fields[]='time_s';
    }

    if($time_length === ''){
        $error_fields[]='time_length_s';
    }

    if($clothes === 'Выбрать...'){
        $error_fields[]='clothes_s';
    }
    
    if($amout_people === ''){
        $error_fields[]='amout_people_s';
    }
    
    if($description === ''){
        $error_fields[]='description_s';
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

    

    mysqli_query($mysql, "UPDATE `special_tasks` SET `name` = '$name', `date` = '$date', `time` = '$time',`time_length` = '$time_length', `clothes` = '$clothes', `people_amout` = '$amout_people', `description` = '$description', `edit` = '$edit' WHERE `special_tasks`.`id_task` = '$id_task'");
    
    
    //$mysql->close();
    
    $response = [
        "status" => true,
        "message" => "Задание успешно изменено!"
    ];
    echo json_encode($response);

}







?>