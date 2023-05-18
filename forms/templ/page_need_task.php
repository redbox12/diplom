<?php 
 $result = mysqli_query($mysql, "SELECT * FROM `need_tasks` WHERE `id_task`='$id_task'");
 $row = $result->fetch_assoc();
 $id_admin = $row['id_admin'];

 //забираем  данные из БД организатора для вывода инф-ии о нём
 $result_admin = mysqli_query($mysql, "SELECT * FROM `personal_date` WHERE `id`='$id_admin'");
 $row_admin = $result_admin->fetch_assoc();
 
   
 
 $info_task = [
     "name" => $row['name'], 
     "date" =>  date("d.m", strtotime($row['date'])),
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

 //вывод Одежды
 if($info_task['clothes'] == 1){
     $info_task['clothes'] = "Обычная";
 } else {
     $info_task['clothes'] = "Рабочая";
 }

if($_SESSION['user']['admin'] == 1){ //вывод организатора
    $j = 0; //для навешивания события
    echo '
    <div class="row ">
    <h1 class=""> <strong>'.$info_task['name'].' </strong></h1>
</div>

<div class="row mt-3">
    <div class="col-lg-3 col-md-7 col-sm-12">
        <div class="card">
            <div class="card-body">
                <img src="assets/img/task_img.png" class="img-fluid mt-lg-2 p-1 pb-lg-4 p-md-4" alt="...">
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-5 col-sm-12">
        <div class="card response description">
            <div class="card-body  justify-content-center">
                <h4 class=" text-center mt-3"><strong>Описание</strong></h4>
                <div class=" ms-2">
                    <span class="">
                        '.$info_task['description'].'
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-5 col-md-6 col-sm-12">
        <div class="card delete">
            <div class="card-body">
                <h4 class=" text-center mt-3"><strong>Оcобености</strong></h4>
                <table class="table table-borderless table-sm">
                    <tbody>

                        <tr>
                            <th scope="row">Дата:</th>
                            <td>' .$info_task['date'].'</td>


                        </tr>

                        <tr>
                            <th scope="row">Время:</th>
                            <td>'.$info_task['time'].'</td>


                        </tr>

                        <tr>
                            <th scope="row">Люди:</th>
                            <td>'.$info_task['people_feedback'].'/'.$info_task['people_amout'].'</td>

                        <tr>
                            <th scope="row">Одежда:</th>
                            <td>'.$info_task['clothes'].'</td>
                        </tr>

                        </tr>
                        <tr>
                            <th scope="row text-truncate">Продолжительность:</th>
                            <td>' .$info_task['time_length'].' мин</td>


                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-danger  finished-task"> Завершить</button>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card card_page_task">
            <div class="card-body">
                <h4 class=" text-center mt-2"><strong>Организатор</strong></h4>
                <table class="table table-borderless table-sm">
                    <tbody>
                        <tr>
                            <th scope="row">Имя:</th>
                            <td>' .$info_task['name_admin'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Телефон:</th>
                            <td>'.$info_task['telephone_admin'].'</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>';
    
} 


else{ //вывод исполнителя 

    // Проверка на взятие задачи
    $result_button = mysqli_query($mysql, "SELECT * FROM `players` WHERE `id_human`='$id_human' AND `id_task`='$id_task' AND `id_type`='$type_task'");
    $j = 0; //для навешивания события
    if(mysqli_num_rows($result_button)>0){ //если записан на задание
        $button = '
         <div class="otkaz">
            <input type="hidden" name="id_task_m'.$j.'" value="'.$id_task.'">
            <input type="hidden" name="id_type_m'.$j.'" value="'.$type_task.'">
            <input type="hidden" name="id_human_m'.$j.'" value="'.$_SESSION['user']['id'].'">
            <button class="btn btn-danger otkaz-task">Отказаться</button>
         </div>';
         
    } 
    
    else {
        
        $button = '<input type="hidden" id="id_task'.$j.'" name="id_task" value="'.$id_task.'">
        <input type="hidden" id="id_type'.$j.'" name="id_type" value="'.$type_task.'">
        <input type="hidden" id="id_human'.$j.'" name="id_human" value="'.$_SESSION['user']['id'].'">
        <button class="btn btn-success  response-task">Откликнуться</button>';
    }

    
    //вывод задания 
    echo '
    <div class="row ">
    <h1 class=""> <strong>'.$info_task['name'].' </strong></h1>
</div>

<div class="row mt-3">
    <div class="col-lg-3 col-md-7 col-sm-12">
        <div class="card">
            <div class="card-body">
                <img src="assets/img/task_img.png" class="img-fluid mt-lg-2 p-1 pb-lg-4 p-md-4" alt="...">
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-5 col-sm-12">
        <div class="card response description">
            <div class="card-body  justify-content-center">
                <h4 class=" text-center mt-3"><strong>Описание</strong></h4>
                <div class=" ms-2">
                    <span class="">
                        '.$info_task['description'].'
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-5 col-md-6 col-sm-12">
        <div class="card response">
            <div class="card-body">
                <h4 class=" text-center mt-3"><strong>Оcобености</strong></h4>
                <table class="table table-borderless table-sm">
                    <tbody>

                        <tr>
                            <th scope="row">Дата:</th>
                            <td>' .$info_task['date'].'</td>


                        </tr>

                        <tr>
                            <th scope="row">Время:</th>
                            <td>'.$info_task['time'].'</td>


                        </tr>

                        <tr>
                            <th scope="row">Люди:</th>
                            <td>'.$info_task['people_feedback'].'/'.$info_task['people_amout'].'</td>

                        <tr>
                            <th scope="row">Одежда:</th>
                            <td>'.$info_task['clothes'].'</td>
                        </tr>

                        </tr>
                        <tr>
                            <th scope="row text-truncate">Продолжительность:</th>
                            <td>' .$info_task['time_length'].' мин</td>


                        </tr>
                    </tbody>
                </table>
                '.$button.'
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card card_page_task">
            <div class="card-body">
                <h4 class=" text-center mt-2"><strong>Организатор</strong></h4>
                <table class="table table-borderless table-sm">
                    <tbody>
                        <tr>
                            <th scope="row">Имя:</th>
                            <td>' .$info_task['name_admin'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Телефон:</th>
                            <td>'.$info_task['telephone_admin'].'</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>';

    
}
   


?>