<?php 
session_start();
require_once 'conect.php';

$full_name = $_POST['full_name'];
$telephone= str_replace([' ', '(', ')', '-'], '', $_POST['telephone']); //удаляю тире, пробелы
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

$error_fields = [];

$check_tel = mysqli_query($mysql, "SELECT * FROM `personal_date` WHERE `telephone`='$telephone'");

if (mysqli_num_rows($check_tel) > 0) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Такой аккаунт уже существует",
        "fields" => ['telephone']
    ];

    echo json_encode($response);
    die();
}



if($telephone === ''){
    $error_fields[]='telephone';
}

if($password === ''){
    $error_fields[]='password';
}

if($full_name === ''){
    $error_fields[]='full_name';
}

if($password_confirm === ''){
    $error_fields[]='password_confirm';
}


if(!empty($error_fields)){
    $response =[
        "status" => false,
        "type" => 2, //тип ошибки
        "message"=> "Проверте правильность полей",
        "fields" => $error_fields
        
    ];
    
    echo json_encode($response);
    die();
}

if($password === $password_confirm){
        
    $password= md5($password);
    mysqli_query($mysql, "INSERT INTO `personal_date` (`id`, `name`, `telephone`, `password`, `admin`, `normal`, `super_normal`, `limite_task`) VALUES (NULL, '$full_name', '$telephone', '$password', '0', '1', '0', '2')"); 
    $mysql->close();
    
    $response =[
        "status" => true,
        "message"=> "Вы зарегистрированы"
        
    ];
    
    echo json_encode($response);
} else{   
    // $_SESSION['message'] = 'Пароли не совпадают'; 
    // header('Location: ../pages-register.php' );
    $response = [
        "status" => false,
        "message" => 'Пароли не совпадают'
    ];
    echo json_encode($response);

}
?>