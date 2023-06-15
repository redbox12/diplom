<?php 
    session_start();
    require_once 'conect.php';

    
     /*
    Отображение задание исполнителя
    */

    if(isset($_POST['my_task'])){
        $id_human = $_SESSION['user']['id'];
        $my_task = mysqli_query($mysql, "SELECT * FROM `players` WHERE `id_human`='$id_human' ");
        $all_task = array();
        $j = 0;
    
            while ($row = $my_task->fetch_assoc()) // получаем все строки в цикле по одной
            {
                $id_task =  $row['id_task'];
                $id_type =  $row['id_type'];
               
                $need_task = mysqli_query($mysql, "SELECT * FROM `need_tasks` WHERE `id_task`='$id_task'");
                $row2 = $need_task->fetch_assoc();
    
                if($id_type  == 1){
                    $name = $row2['name'];
                    $date = date("d.m", strtotime($row['date'])); //дата 
                    $time = $row2['time']; //время
                    $time_length = $row2['time_length']; //продолжительность
                    $people_amout = $row2['people_amout']; //кол-во людей
                    $people_feedback = $row2['people_feedback']; //кол-во откликнувших. людей
                    $change_task2 = $row2['edit'];
                    
                    //if($row2['change_task'] == 1){
                        if($change_task2 == 1){ //если произошли изменение в задание
                        $change_task = ' <i  id = "info-change'.$j.'" style="font-size: 25px; color:red;"
                        class="btn-tooltip bi bi-exclamation-circle-fill btn p-0" data-bs-toggle="tooltip"
                        data-bs-placement="top" data-bs-title="Изменена информация по задаче!"></i>';
                    } else{
                        $change_task = '';
                    }
                    
                    $all_task[]= '<div class="card mb-1 my-task-res">
                    <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-2 mt-md-2 mt-sm-3 pe-0">
                           <i class="bx bx-ruler d-flex align-items-center card-icon rounded-circle justify-content-center need"></i>
                        </div>

                        <div class="col-10 ps-0 ps-lg-1 pe-0 mt-lg-1">
                            <h5 class="card-title fw-bold pt-3 m-0 text-sm-center text-md-start  text-truncate" >'.$name.'</h5> 
                        </div>

                    </div>
                        <div class="row">
                            <div class="col-lg-7">
                                <span class="small text-muted ">Дата: '.$date.'</span>
                                <br><span class="text-muted small pt-2">Время: '.$time.'</span>
                                <br><span class="text-muted small pt-2">Продолжительность: 50
                                    мин</span>
                            </div>

                            <div class="col-lg-3 col-md-2 mt-lg-2 ps-lg-0 pe-md-0">
                                <i style="font-size: 32px;" class="bi bi-people-fill"></i>
                                <span style="font-size: 25px;">'.$people_feedback.'/ '.$people_amout.'</span>
                            </div>

                            <div class="col-lg-2 col-md-2 pt-lg-3 pt-md-2 info">
                            '.$change_task .'
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 mt-2 ">
                            <form action="product_page.php" method="POST">
                                <input type="hidden" id="id_task_m'.$j.'" name="id_task" value="'.$id_task.'">
                                <input type="hidden" id="id_type_m'.$j.'" name="id_type" value="'.$id_type.'">
                                <input type="hidden" id="id_human_m'.$j.'" name="id_human" value="'.$_SESSION['user']['id'].'">
                                <button class="btn btn-danger btn-sm otkaz-task">Отказаться</button>
                                <button class="btn btn-primary btn-sm ms-1" type="submit" >Подробнее...</button>
                            </form>   
                            </div>

                        </div>

                    </div>
                </div>';

                $j++;
                }
                
                $special_task = mysqli_query($mysql, "SELECT * FROM `special_tasks` WHERE `id_task`='$id_task'");
                $row3 = $special_task->fetch_assoc();

                if($id_type  == 3){ //выво особый помощи 
                    $name = $row3['name'];
                    $date = date("d.m", strtotime($row3['date'])); //дата 
                    $time = $row3['time']; //время
                    $time_length = $row3['time_length']; //продолжительность
                    $people_amout = $row3['people_amout']; //кол-во людей
                    $people_feedback = $row3['people_feedback']; //кол-во откликнувших. людей
                    $change_task3 = $row3['edit'];;

                    if($change_task3 == 1){ //если произошли изменение в задание
                    //if($change_task2 === 1){ //если произошли изменение в задание
                        $change_task = ' <i id="btn-tooltip" style="font-size: 25px; color:red;"
                        class="bi bi-exclamation-circle-fill btn p-0" data-bs-toggle="tooltip"
                        data-bs-placement="top" data-bs-title="Изменена информация по задаче!"></i>';
                    } else{
                        $change_task = '';
                    }
                    
            
                    $all_task[] =  '<div class= "card mb-1  my-task-res">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-2 mt-md-2 mt-sm-3 pe-0">
                                <i class="bx bx-star d-flex align-items-center card-icon rounded-circle justify-content-center special_icon" ></i>
                                    
                            </div>
            
                            <div class="col-10 ps-0 ps-lg-1 pe-0 mt-lg-2">
                            <h5 class="card-title fw-bold text-sm-center text-md-start  text-truncate" >'.$name.'</h5> 
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-lg-7">
                                <span class="small text-muted ">Дата: '.$date.'</span>
                                <br><span class="text-muted small pt-2">Время: '.$time.'</span>
                                <br><span class="text-muted small pt-2">Продолжительность:  '.$time_length.' мин</span>
                            </div>

                            <div class="col-lg-3 col-md-2 mt-lg-2 ps-lg-0 pe-md-0">
                                <i style="font-size: 32px;" class="bi bi-people-fill"></i>
                                <span style="font-size: 25px;"> '.$people_feedback.'/ '.$people_amout.' </span>
                            </div>

                            <div class="col-lg-2 col-md-2 pt-lg-3 pt-md-2 ">
                            '.$change_task .'
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 mt-2">
                            <form action="product_page.php" method="POST">
                                <input  type="hidden" id="id_task_m'.$j.'" name="id_task" value="'.$id_task.'">
                                <input  type="hidden" id="id_type_m'.$j.'" name="id_type" value="'.$id_type.'">
                                <input type="hidden" id="id_human_m'.$j.'" name="id_human" value="'.$_SESSION['user']['id'].'">
                                <button class="btn btn-danger btn-sm otkaz-task" >Отказаться</button>
                                <button class="btn btn-primary btn-sm ms-1" type="submit" >Подробнее...</button>
                                </form> 
                            </div>
                    
                        </div>

                    </div>
                </div>';

                $j++;
                }

            }
            
            $db_human = mysqli_query($mysql, "SELECT * FROM `personal_date` WHERE `id`='$id_human'");
            $row_hum = $db_human->fetch_assoc();
            $limite_human_task = $row_hum['limite_task'];
            
            
            $response = [
                "status" => true,
                "message" => "Вывод всех заданий",
                "task" => $all_task,
                "limite_task" =>  $limite_human_task
            ];
            echo json_encode($response);
            die();
           
        
    }

   
    $id_task = $_POST['id_task'];
    $type_task = $_POST['type_task'];
    $id_human = $_POST['id_human'];
   
    $db_human = mysqli_query($mysql, "SELECT * FROM `personal_date` WHERE `id`='$id_human'");
    $row_hum = $db_human->fetch_assoc();
    $limite_human_task = $row_hum['limite_task'];

    if($limite_human_task == -1){//если заблокированный пользователь
        $response = [
            "status" => false,
            "type" => 1,
            "message" => "Вы заблокированы, из-за подазрительного поведения! 😤"
        ];
        echo json_encode($response);
        die();
    }

    if($limite_human_task == 0){ //если кончился лимит заданий 
        $response = [
            "status" => false,
            "type" => 2,
            "message" => "Вы исчерпали лимит по взятию задач, подождите, когда организатор завершит задание или сделает вам лимит больше двух задач"
        ];
        echo json_encode($response);
        die();
    }
    
    if($type_task == 1 and $limite_human_task > 0){
        mysqli_query($mysql, "INSERT INTO `players` (`id_human`, `id_task`, `id_type`) VALUES ('$id_human', '$id_task', '$type_task')");
        mysqli_query($mysql, "UPDATE `need_tasks` SET `people_feedback` = `people_feedback`+ 1 WHERE `need_tasks`.`id_task` = '$id_task'");
        mysqli_query($mysql, "UPDATE `personal_date` SET `limite_task` = `limite_task`- 1 WHERE `personal_date`.`id` = '$id_human'");
        $mysql -> close();
        
        $response = [
            "status" => true,
            "message" => "Вы записаны, приходите, пожалуйста, на назначенную дату!"
        ];
        echo json_encode($response);
        die();
        
    }

    if($type_task == 3  and $limite_human_task > 0){
        mysqli_query($mysql, "INSERT INTO `players` (`id_human`, `id_task`, `id_type`) VALUES ('$id_human', '$id_task', '$type_task')");
        mysqli_query($mysql, "UPDATE `special_tasks` SET `people_feedback` = `people_feedback`+ 1 WHERE `special_tasks`.`id_task` = '$id_task'");
        mysqli_query($mysql, "UPDATE `personal_date` SET `limite_task` = `limite_task`- 1 WHERE `personal_date`.`id` = '$id_human'");
        $mysql -> close();
        
        $response = [
            "status" => true,
            "message" => "Вы записаны на особенное задание!"
        ];
        echo json_encode($response);
        die();
    }

   
    
    

   
   



?>