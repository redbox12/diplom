<?php 
session_start();
require_once 'conect.php';

$id_task = $_POST['id_task'];
$type_task = $_POST['id_type'];


$get_need_task = $_POST['get_need_task'];
// $get_mtrl_task = $_POST['get_mtrl_task'];
// $get_special_task = $_POST['get_special_task'];

$need_edit_task = $_POST['need_edit_task'];  //переменная для изменения данных

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
        "message" => "Задание успешно создано!"
    ];
    echo json_encode($response);

}

if($get_mtrl_task) { //отдаю значения "Сбор средств"
    
   
    
}

if($get_special_task) { //отдаю значения "Особые поручения"
    
   
    
}



if($edit_task) { //если true значит запрос на изменение задачи
    
    if($type_task == 1){
    
    }
    
    if($type_task == 2){
        
    }
    
    if($type_task == 3){
        
    }
    
} 

//удаление задания
else {

    
} 






?>