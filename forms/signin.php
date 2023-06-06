<?php 
session_start();
require_once 'conect.php';

$telephone= str_replace([' ', '(', ')', '-'], '', $_POST['telephone']);
$password = $_POST['password'];

$error_fields = [];

if($telephone === ''){
    $error_fields[]='telephone';
}

if($password === ''){
    $error_fields[]='password';
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
$password = md5($password);

//проверка на заблокированного пользоватяля 
$check_user_ban = mysqli_query($mysql, "SELECT * FROM `personal_date` WHERE `telephone`='$telephone' AND `password`='$password' AND `limite_task`='-1'");
if(mysqli_num_rows($check_user_ban)>0){
    $response = [
        "status" => false,
        "message" => '🔴 Вы заблокированы из-за подозрительного поведения',
    ];
    echo json_encode($response);
    die();
}

$check_user = mysqli_query($mysql, "SELECT * FROM `personal_date` WHERE `telephone`='$telephone' AND `password`='$password'");



 if(mysqli_num_rows($check_user)>0){

    $user = mysqli_fetch_assoc($check_user);
    
    $_SESSION['user'] = [
        "id" => $user['id'],
        "name" => $user['name'],
        "telephone" => $user['telephone'],
        "admin" => $user['admin'],
        "normal" => $user['normal'],
        "super_normal" => $user['super_normal'],
        "limite_task" => $user['limite_task']
    ];
        $mysql->close();
        //header('Location: ../users-profile.php');
        $response = [
            "status" => true
        ];
        echo json_encode($response);
    
 } else{
    // $_SESSION['message'] = 'Нет такого пользователя'; 
    // header('Location: ../pages-login.php' );
    $response = [
        "status" => false,
        "message" => 'Неверный телефон или пароль',
    ];
    echo json_encode($response);
 }



?>