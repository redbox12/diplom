<?php 
session_start();
require_once 'conect.php';


 $check_admin = mysqli_query($mysql, "SELECT COUNT(*) FROM `personal_date` WHERE `admin`= '1' ");
 $num_people_admin = mysqli_fetch_array( $check_admin )[0];

 $check_special= mysqli_query($mysql, "SELECT COUNT(*) FROM `personal_date` WHERE `super_normal`= '1'");
 $num_people_super_normal = mysqli_fetch_array( $check_special )[0];

 $check_normal = mysqli_query($mysql, "SELECT COUNT(*) FROM `personal_date` WHERE `normal`= '1'");
 $num_people_normal = mysqli_fetch_array( $check_normal)[0];

 $check_ban = mysqli_query($mysql, "SELECT COUNT(*) FROM `personal_date` WHERE `limite_task`= '-1'");
 $num_people_ban = mysqli_fetch_array( $check_ban)[0];

$all_people = $_POST['all_people'];

if(isset($all_people)){
    $result = mysqli_query($mysql, "SELECT * FROM `personal_date`");
    $all_people_list = array(); //массив в котором лежат все задания
    $j = 0;
    while ($row = $result->fetch_assoc()) // получаем все строки в цикле по одной
    {
        if($row['admin'] == 1 and $row['id'] != $_SESSION['user']['id']){
            $all_people_list[] = '<tr class="text-lg-start text-center">
            <td>'.$row['name'].'</td>
            <td>'.$row['telephone'].'</td>
            <td>
            Организатор
            </td>
            <td>
            '.$row['limite_task'].'
            </td>
            <td>
            <input type="hidden" id="id_human'.$j.'" name="id_human" value="'.$row['id'].'">
            <input type="hidden" id="name'.$j.'" name="name" value="'.$row['name'].'">
            <input type="hidden" id="limite_task'.$j.'" name="limite_task" value="'.$row['limite_task'].'">
            <input type="hidden" id="level_access'.$j.'" name="level_access" value="3">
            <button class="btn btn-sm p-0 edit_task text-start"><i class="bx bx-edit mt-1 p-0"
                        style="font-size: 30px;"></i></button>
            </td>

        </tr>';
        $j++;
        }

        if($row['normal'] == 1){
            $all_people_list[] = '<tr class="text-lg-start text-center">
            <td>'.$row['name'].'</td>
            <td>'.$row['telephone'].'</td>
            <td>
            Стандартный
            </td>
            <td>
            '.$row['limite_task'].'
            </td>
            <td>
            <input type="hidden" id="id_human'.$j.'" name="id_human" value="'.$row['id'].'">
            <input type="hidden" id="name'.$j.'" name="name" value="'.$row['name'].'">
            <input type="hidden" id="limite_task'.$j.'" name="limite_task" value="'.$row['limite_task'].'">
            <input type="hidden" id="level_access'.$j.'" name="level_access" value="1">
            <button class="btn btn-sm p-0 edit_task"><i class="bx bx-edit mt-1"
                        style="font-size: 30px;"></i></button>
            </td>

        </tr>';
        $j++;
            
        }

        if($row['super_normal'] == 1){
           $all_people_list[] = '<tr class="text-lg-start text-center">
            <td>'.$row['name'].'</td>
            <td>'.$row['telephone'].'</td>
            <td>
            Особый
            </td>
            <td>
            '.$row['limite_task'].'
            </td>
            <td>
            <input type="hidden" id="id_human'.$j.'" name="id_human" value="'.$row['id'].'">
            <input type="hidden" id="name'.$j.'" name="name" value="'.$row['name'].'">
            <input type="hidden" id="limite_task'.$j.'" name="limite_task" value="'.$row['limite_task'].'">
            <input type="hidden" id="level_access'.$j.'" name="level_access" value="2">
            <button class="btn btn-sm p-0 edit_task"><i class="bx bx-edit mt-1"
                        style="font-size: 30px;"></i></button>
            </td> </tr>';
            $j++;
        }

        if($row['limite_task'] == -1){
            $all_people_list[] = '<tr class="text-lg-start text-center">
             <td>'.$row['name'].'</td>
             <td>'.$row['telephone'].'</td>
             <td class="text-danger">
             Заблокированный
             </td>
             <td>
             0
             </td>
             <td>
             <input type="hidden" id="id_human'.$j.'" name="id_human" value="'.$row['id'].'">
             <input type="hidden" id="name'.$j.'" name="name" value="'.$row['name'].'">
             <input type="hidden" id="limite_task'.$j.'" name="limite_task" value="0">
             <input type="hidden" id="level_access'.$j.'" name="level_access" value="4">
             <button class="btn btn-sm p-0 edit_task"><i class="bx bx-edit mt-1"
                         style="font-size: 30px;"></i></button>
             </td> </tr>';
             $j++;
         }
       
    }

    $response=[
        "status" => true,
        "people" => $all_people_list,
        "people_num_admin" => $num_people_admin,
        "people_num_super_normal" => $num_people_super_normal,
        "people_num_normal" => $num_people_normal,
        "num_people_ban" => $num_people_ban,
        "message" => "Вывод людей"
    ];
    echo json_encode($response);
    die();
}

$setting_people = $_POST['setting_people'];

if(isset($setting_people)){ //изменение данных
     
   
        $id_human = $_POST['id_human'];
        $limite_task = $_POST['limite_task'];
        $level_access = $_POST['level_access'];


    if($level_access == 1){ // Изменение на стандартного пользователя
        mysqli_query($mysql, "UPDATE `personal_date` SET `normal` = '1', `super_normal` = '0', `admin` = '0', `limite_task` = '$limite_task' WHERE `id` = '$id_human'");
    }
    if($level_access == 2){ // Изменение на стандартного пользователя
        mysqli_query($mysql, "UPDATE `personal_date` SET `normal` = '0', `super_normal` = '1', `admin` = '0', `limite_task` = '$limite_task' WHERE `id` = '$id_human'");
    }

    if($level_access == 3){ // Изменение на стандартного пользователя
        mysqli_query($mysql, "UPDATE `personal_date` SET `normal` = '0', `super_normal` = '0', `admin` = '1', `limite_task` = '$limite_task' WHERE `id` = '$id_human'");
    }

    if($level_access == 4){ // Изменение на заблокированного пользователя
        
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

        
    }

    $response=[
        "status" => true,
        "message" => "Все хорошо"
    ];
    echo json_encode($response);
    die();
    
}



?>