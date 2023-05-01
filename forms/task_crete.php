<?php 
session_start();
require_once 'conect.php';

if($_POST['type_task'] === '1'){ //Необходимая помощь 
    
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $time_length = $_POST['time_length'];
    $clothes = $_POST['clothes'];
    $amout_people = $_POST['amout_people'];
    $description = $_POST['description'];
    $type_task = $_POST['type_task'];
    $admin = $_SESSION['user']['id']; 

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

    $path = 'assets/img/task' . time() . $_FILES['avatar']['name'];
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
        $response = [
            "status" => false,
            "type" => 2,
            "message" => "Ошибка при загрузке фотографии!",
        ];
        echo json_encode($response);
        die();
    }
    
    mysqli_query($mysql,"INSERT INTO `need_tasks` (`id_task`, `id_type`, `id_admin`, `name`, `date`, `time`, `time_length`,`clothes`, `people_amout`, `people_feedback`, `description`, `photo`) VALUES (NULL, '$type_task', '$admin', '$name', '$date', '$time', '$time_length', '$clothes', '$amout_people', '0', '$description', '$path')");
    
    $mysql->close();
    
    $response = [
        "status" => true,
        "message" => "Задание успешно создано!"
    ];
    echo json_encode($response);
}

if($_POST['type_task'] === '2'){//Материальная помощь 
    $name_mtrl = $_POST['name_mtrl'];
    $date_start_mtrl = $_POST['date_start_mtrl'];
    $date_end_mtrl = $_POST['date_end_mtrl'];
    $telephone_mtrl = $_POST['telephone_mtrl'];
    $card_mtrl = $_POST['card_mtrl'];
    $summ_den_mtrl = $_POST['summ_den_mtrl'];
    $description_mtrl = $_POST['description_mtrl'];
    $type_task = $_POST['type_task'];
    $admin = $_SESSION['user']['id'];

    $error_fields = [];

    if($name_mtrl === ''){
        $error_fields[]='name_mtrl';
    }
    
    if($date_start_mtrl === ''){
        $error_fields[]='date_start_mtrl';
    }
    
    if($date_end_mtrl === ''){
        $error_fields[]='date_end_mtrl';
    }

    if($telephone_mtrl === ''){
        $error_fields[]='telephone_mtrl';
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

    $path = 'assets/img/task' . time() . $_FILES['avatar2']['name'];
    if (!move_uploaded_file($_FILES['avatar2']['tmp_name'], '../' . $path)) {
        $response = [
            "status" => false,
            "type" => 2,
            "message" => "Ошибка при загрузке фотографии",
        ];
        echo json_encode($response);
        die();
    }
    
    mysqli_query($mysql,"INSERT INTO `material_task` (`id_task`, `id_type`, `id_admin`, `name`, `date_start`, `date_end`, `telephone`, `card_bank`, `summ_deneg`, `description`, `photo`) VALUES (NULL, '$type_task', '$admin', '$name_mtrl', '$date_start_mtrl', '$date_end_mtrl', '$telephone_mtrl', '$card_mtrl', '$summ_den_mtrl', '$description_mtrl', '$path')");
    
    $mysql->close();
    $response = [
        "status" => true,
        "message" => "Успешно создали задачу"
    ];
    echo json_encode($response);
}

if($_POST['type_task'] === '3'){ //Особые поручения 
    $name_special = $_POST['name_special'];
    $date_special = $_POST['date_special'];
    $time_special = $_POST['time_special'];
    $time_length = $_POST['time_length'];
    $clothes_special = $_POST['clothes_special'];
    $amout_people_special = $_POST['amout_people_special'];
    $description_special = $_POST['description_special'];
    $type_task = $_POST['type_task'];
    $admin = $_SESSION['user']['id'];

    

    $error_fields = [];

    // echo $type_task;
    if($name_special === ''){
        $error_fields[]='name_special';
    }
    
    if($date_special === ''){
        $error_fields[]='date_special';
    }
    
    if($time_special === ''){
        $error_fields[]='time_special';
    }

    if($time_special === ''){
        $error_fields[]='time_length_special';
    }

    if($clothes_special === 'Выбрать...'){
        $error_fields[]='clothes_special';
    }
    
    if($amout_people_special === ''){
        $error_fields[]='amout_people_special';
    }
    
    if($description_special === ''){
        $error_fields[]='description_special';
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

    $path = 'assets/img/task' . time() . $_FILES['avatar3']['name'];
    if (!move_uploaded_file($_FILES['avatar3']['tmp_name'], '../' . $path)) {
        $response = [
            "status" => false,
            "type" => 2,
            "message" => "Ошибка при загрузке фотографии"
        ];
        echo json_encode($response);
        die();
    }
    
    mysqli_query($mysql,"INSERT INTO `special_tasks` (`id_task`, `id_type`, `name`, `id_admin`, `date`, `time`, `time_length`, `clothes`, `people_amout`, `people_feedback`, `description`, `photo`) VALUES (NULL, '$type_task ', '$name_special', '$admin', '$date_special', '$time_special', '$time_length', '$clothes_special', '$amout_people_special', '0', '$description_special', '$path')");
    
    $mysql->close();
    
    $response = [
        "status" => true,
        "message" => "Успешно создали задачу"
    ];
    echo json_encode($response);
}



?>