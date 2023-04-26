<?php 
session_start();
include 'conect.php';

$type_task = $_POST['type_task'];
$date_task = $_POST['date_task'];


    if($type_task == 0 and $date_task == "" ){ //вывод всех задач
        
        $result=[];
        $result[] = $mysql->query('SELECT * FROM `need_tasks`'); //забираю данные из БД
        $result[] = $mysql->query('SELECT * FROM `material_task`'); //забираю данные из БД
        $result[] = $mysql->query('SELECT * FROM `special_tasks`');
         $all_task = array(); //массив в котором лежат все задания
        
        for($i = 0; $i < 3; $i++){
            while ($row = $result[$i]->fetch_assoc()) // получаем все строки в цикле по одной
            {
                $id_task =  $row['id_task'];
                $id_type =  $row['id_type'];
                $id_admin =  $row['id_admin'];
                $name = $row['name']; //название задания
               
    
                if($i == 0){
                    $date = date("d.m", strtotime($row['date'])); //дата 
                    $time = $row['time']; //время
                    $time_length = $row['time_length']; //продолжительность
                    $people_amout = $row['people_amout']; //кол-во людей
                    $people_feedback = $row['people_feedback']; //кол-во откликнувших. людей
    
                    
                    $all_task[] = ' 
                    <div class= "card mb-1">
                            <div class="card-body">
                                <div class="row">
                                    <h5 class="card-title fw-bold pt-3 ms-2 m-0">'.$name.'</h5>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <span class="small text-muted ">Начало: '.$date.'</span>
                                        <br><span class="text-muted small pt-2">Время: '.$time.'</span>
                                        <br><span class="text-muted small pt-2">Продолжительность:  '.$time_length.' мин</span>
                                    </div>
    
                                    <div class="col-lg-4 mt-lg-2 ps-lg-0">
                                        <i style="font-size: 32px;" class="bi bi-people-fill"></i>
                                        <span style="font-size: 25px;"> '.$people_feedback.'/ '.$people_amout.' </span>
                                    </div>
                                </div>
    
                                <div class="row">
                                 <form class="p-0 m-0">
                                    <div class="col mt-2 ">
                                        <input type="hidden" name="id_task" value="'.$id_task.'">
                                        <input type="hidden" name="id_task" value="'.$id_type.'">
                                        <button class="btn btn-danger btn-sm" type="submit">Завершить</button>
                                    </div>
                                </form>
                                </div>
    
                            </div>
                        </div>';
    
                
                }
    
                if($i ==  1){ //вывод материальной помощи
                    $date_start = date("d.m", strtotime($row['date_start'])); //дата начала
                    $date_end = date("d.m", strtotime($row['date_end'])); //дата окончания
                    $summ_deneg = $row['summ_deneg'];  //сумма денег     
                    
    
                    $all_task[] = '
                    <div class="card mb-1">
                        <div class="card-body">
                            <div class="row">
                                <h5 class="card-title fw-bold pt-3 ms-2 m-0">'.$name.'</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <span class="small text-muted ">Начало сбора: '.$date_start.'</span>
                                    <br><span class="text-muted small pt-2">Дата окончание: '.$date_end.'</span>
                                    <br><span class="text-muted small pt-2">Необходимо денег:  '.$summ_deneg.' р</span>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col mt-2 ">
                                    <button class="btn btn-danger btn-sm" type="submit">Завершить</button>
                                </div>
                            </div>
    
                        </div>
                    </div>';
                    
                
                }

                if($i == 2){ //выво особый помощи 
                    $date = date("d.m", strtotime($row['date'])); //дата 
                    $time = $row['time']; //время
                    //$time_length = $row['time_length']; //продолжительность
                    $people_amout = $row['people_amout']; //кол-во людей
                    $people_feedback = $row['people_feedback']; //кол-во откликнувших. людей
    
                    
                    $all_task[] = ' 
                    <div class= "card mb-1">
                            <div class="card-body">
                                <div class="row">
                                    <h5 class="card-title fw-bold pt-3 ms-2 m-0">'.$name.'</h5>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <span class="small text-muted ">Начало: '.$date.'</span>
                                        <br><span class="text-muted small pt-2">Время: '.$time.'</span>
                                        <br>
                                    </div>
    
                                    <div class="col-lg-4 mt-lg-2 ps-lg-0">
                                        <i style="font-size: 32px;" class="bi bi-people-fill"></i>
                                        <span style="font-size: 25px;"> '.$people_feedback.'/ '.$people_amout.' </span>
                                    </div>
                                </div>
    
                                <div class="row">
                                 <form class="p-0 m-0">
                                    <div class="col mt-2 ">
                                        <input type="hidden" name="id_task" value="'.$id_task.'">
                                        <input type="hidden" name="id_task" value="'.$id_type.'">
                                        <button class="btn btn-danger btn-sm" type="submit">Завершить</button>
                                    </div>
                                </form>
                                </div>
    
                            </div>
                        </div>';
                }

            }
            $result[$i]->free();
            
        }
        $mysql->close();

        $response = [
            "status" => true,
            "message" => "Вывод всех заданий",
            "type" => 0, //тип вывода всех задач без даты
            "task" => $all_task
            
        ];

        echo json_encode($response);
        die();
        
    } 
    
    if (!empty($date_task) and $type_task == 0) { //вывод задач с датой
        
        $result=[];
        $result[] = mysqli_query($mysql, "SELECT * FROM `need_tasks` WHERE `date`='$date_task'"); //забираю данные из БД
        $result[] = mysqli_query($mysql, "SELECT * FROM  `material_task` WHERE `date_start`<='$date_task' AND `date_end`>='$date_task'"); //забираю данные из БД
        $result[] = mysqli_query($mysql, "SELECT * FROM `special_tasks` WHERE `date`='$date_task'");
        $all_task = array(); //массив в котором лежат все задания
        $flag_empty = 0; //если 0 значит нет задач на эту дату. В цикле делаем ++ если есть задача
        

        for($i = 0; $i < 3; $i++){
            if(mysqli_num_rows($result[$i])>0){
                while ($row = $result[$i]->fetch_assoc()) // получаем все строки в цикле по одной
                {
                    $id_task =  $row['id_task'];
                    $id_type =  $row['id_type'];
                    $id_admin =  $row['id_admin'];
                    $name = $row['name']; //название задания
                
        
                    if($i == 0){
                        $date = date("d.m", strtotime($row['date'])); //дата 
                        $time = $row['time']; //время
                        $time_length = $row['time_length']; //продолжительность
                        $people_amout = $row['people_amout']; //кол-во людей
                        $people_feedback = $row['people_feedback']; //кол-во откликнувших. людей
        
                        
                        $all_task[] = ' 
                        <div class= "card mb-1">
                                <div class="card-body">
                                    <div class="row">
                                        <h5 class="card-title fw-bold pt-3 ms-2 m-0">'.$name.'</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <span class="small text-muted ">Начало: '.$date.'</span>
                                            <br><span class="text-muted small pt-2">Время: '.$time.'</span>
                                            <br><span class="text-muted small pt-2">Продолжительность:  '.$time_length.' мин</span>
                                        </div>
        
                                        <div class="col-lg-4 mt-lg-2 ps-lg-0">
                                            <i style="font-size: 32px;" class="bi bi-people-fill"></i>
                                            <span style="font-size: 25px;"> '.$people_feedback.'/ '.$people_amout.' </span>
                                        </div>
                                    </div>
        
                                    <div class="row">
                                    <form class="p-0 m-0">
                                        <div class="col mt-2 ">
                                            <input type="hidden" name="id_task" value="'.$id_task.'">
                                            <input type="hidden" name="id_task" value="'.$id_type.'">
                                            <button class="btn btn-danger btn-sm" type="submit">Завершить</button>
                                        </div>
                                    </form>
                                    </div>
        
                                </div>
                            </div>';
        
                    
                    }
        
                    if($i ==  1){ //вывод материальной помощи
                        
                            $date_start = date("d.m", strtotime($row['date_start'])); //дата начала
                            $date_end = date("d.m", strtotime($row['date_end'])); //дата окончания
                            $summ_deneg = $row['summ_deneg'];  //сумма денег     
                            
            
                            $all_task[] = '
                            <div class="card mb-1">
                                <div class="card-body">
                                    <div class="row">
                                        <h5 class="card-title fw-bold pt-3 ms-2 m-0">'.$name.'</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <span class="small text-muted ">Начало сбора: '.$date_start.'</span>
                                            <br><span class="text-muted small pt-2">Дата окончание: '.$date_end.'</span>
                                            <br><span class="text-muted small pt-2">Необходимо денег:  '.$summ_deneg.' р</span>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col mt-2 ">
                                            <button class="btn btn-danger btn-sm" type="submit">Завершить</button>
                                        </div>
                                    </div>
            
                                </div>
                            </div>';
                            
                       

                        


                    }

                    if($i == 2){ //выво особый помощи 
                        $date = date("d.m", strtotime($row['date'])); //дата 
                        $time = $row['time']; //время
                        //$time_length = $row['time_length']; //продолжительность
                        $people_amout = $row['people_amout']; //кол-во людей
                        $people_feedback = $row['people_feedback']; //кол-во откликнувших. людей
        
                        
                        $all_task[] = ' 
                        <div class= "card mb-1">
                                <div class="card-body">
                                    <div class="row">
                                        <h5 class="card-title fw-bold pt-3 ms-2 m-0">'.$name.'</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <span class="small text-muted ">Начало: '.$date.'</span>
                                            <br><span class="text-muted small pt-2">Время: '.$time.'</span>
                                            <br>
                                        </div>
        
                                        <div class="col-lg-4 mt-lg-2 ps-lg-0">
                                            <i style="font-size: 32px;" class="bi bi-people-fill"></i>
                                            <span style="font-size: 25px;"> '.$people_feedback.'/ '.$people_amout.' </span>
                                        </div>
                                    </div>
        
                                    <div class="row">
                                    <form class="p-0 m-0">
                                        <div class="col mt-2 ">
                                            <input type="hidden" name="id_task" value="'.$id_task.'">
                                            <input type="hidden" name="id_task" value="'.$id_type.'">
                                            <button class="btn btn-danger btn-sm" type="submit">Завершить</button>
                                        </div>
                                    </form>
                                    </div>
        
                                </div>
                            </div>';
                    }

                }

                
                $result[$i]->free();
                $flag_empty++;
            } 
            

        }
        $mysql->close();

        if ($flag_empty == 0){

            $date_task = date("d.m", strtotime($date_task)); //дата 
            $response = [
                "status" => false,
                "message" => "Задачи на $date_task пока еще не создана!",
                "type" => 0.1, //тип вывода всех задач c  датой
            ];
    
            echo json_encode($response);
            die();
            
        } else {
            
             $response = [
                "status" => true,
                "message" => "Вывод всех заданий с датой",
                "type" => 0.1, //тип вывода всех задач c  датой
                "task" => $all_task
            ];

            echo json_encode($response);
            die();
            
        }
        
       
    }

    /* 
        Вывод материальной помощи 
    */ 
    
    if($type_task == 1 and $date_task == ""){
        $result = $mysql->query('SELECT * FROM `material_task`');

        while ($row = $result->fetch_assoc()) // получаем все строки в цикле по одной
        {
            $id_task =  $row['id_task'];
            $id_type =  $row['id_type'];
            $id_admin =  $row['id_admin'];
            $name = $row['name']; //название задания
            
            $date_start = date("d.m", strtotime($row['date_start'])); //дата начала
            $date_end = date("d.m", strtotime($row['date_end'])); //дата окончания
            $summ_deneg = $row['summ_deneg'];  //сумма денег     
            

            $all_task[] = '
            <div class="card mb-1">
                <div class="card-body">
                    <div class="row">
                        <h5 class="card-title fw-bold pt-3 ms-2 m-0">'.$name.'</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <span class="small text-muted ">Начало сбора: '.$date_start.'</span>
                            <br><span class="text-muted small pt-2">Дата окончание: '.$date_end.'</span>
                            <br><span class="text-muted small pt-2">Необходимо денег:  '.$summ_deneg.' р</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mt-2 ">
                            <button class="btn btn-danger btn-sm" type="submit">Завершить</button>
                        </div>
                    </div>

                </div>
            </div>';
        }

        $mysql->close();

        $response = [
            "status" => true,
            "message" => "Вывод всех заданий",
            "type" => 1, //тип вывода всех задач без даты
            "task" => $all_task
        ];

        echo json_encode($response);
        die();
        
    } 
    
    if(!empty($date_task) and $type_task == 1){
        
    }






?>