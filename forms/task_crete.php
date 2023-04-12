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
            "message" => "Ошибка при загрузке аватарки",
        ];
        echo json_encode($response);
    }
    
    mysqli_query($mysql,"INSERT INTO `need_tasks` (`id_task`, `id_type`, `name`, `date`, `time`, `clothes`, `people_amout`, `description`, `photo`) VALUES (NULL, '$type_task', '$name', '$date', '$time', '$clothes', '$amout_people', '$description', '$path')");
    
    $mysql->close();
    
    $response = [
        "status" => true,
        "message" => "Успешно создали задачу"
    ];
    echo json_encode($response);
}

// if($_POST['type_task'] === '2'){//Материальная помощь 
//     $name_mtrl = $_POST['name_mtrl'];
//     $date_start_mtrl = $_POST['date_start_mtrl'];
//     $date_end_mtrl = $_POST['date_end_mtrl'];
//     $telephone_mtrl = $_POST['telephone_mtrl'];
//     $card_mtrl = $_POST['card_mtrl'];
//     $summ_den_mtrl = $_POST['summ_den_mtrl'];
//     $description_mtrl = $_POST['description_mtrl'];
//     $type_task = $_POST['type_task'];
//     $admin = $_SESSION['user']['admin'];

//     $error_fields = [];

//     if($name_mtrl === ''){
//         $error_fields[]='name_mtrl';
//     }
    
//     if($date_start_mtrl === ''){
//         $error_fields[]='date_start_mtrl';
//     }
    
//     if($date_end_mtrl === ''){
//         $error_fields[]='date_end_mtrl';
//     }

//     if($telephone_mtrl === ''){
//         $telephone_mtrl[]='telephone_mtrl';
//     }
    
//     if($card_mtrl === ''){
//         $error_fields[]='card_mtrl';
//     }
    
//     if($summ_den_mtrl === ''){
//         $error_fields[]='summ_den_mtrl';
//     }
    
//     if($description_mtrl === ''){
//         $error_fields[]='description_mtrl';
//     }
    
    
//     if(!empty($error_fields)){
//         $response =[
//             "status" => false,
//             "type" => 1, //тип ошибки
//             "message"=> "Проверте правильность полей",
//             "fields" => $error_fields
            
//         ];
        
//         echo json_encode($response);
//         die();
//     }

//     $path = 'assets/img/task' . time() . $_FILES['avatar']['name'];
//     if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
//         $response = [
//             "status" => false,
//             "type" => 2,
//             "message" => "Ошибка при загрузке аватарки",
//         ];
//         echo json_encode($response);
//     }
    
//     mysqli_query($mysql,"INSERT INTO `material_task` (`id_task`, `id_type`, `admin`, `name`, `date_start`, `date_end`, `telephone`, `card_bank`, `summ_deneg`, `description`, `photo`) VALUES (NULL, '$type_task', '$admin', '$name_mtrl', '$date_start_mtrl', '$date_end_mtrl', '$telephone_mtrl', '$card_mtrl', '$summ_den_mtrl', '$description_mtrl', '$path')");
    
//     $mysql->close();
//     $response = [
//         "status" => true,
//         "message" => "Успешно создали задачу"
//     ];
//     echo json_encode($response);
// }

if($_POST['type_task'] === '3'){ //Особые поручения 

}



?>