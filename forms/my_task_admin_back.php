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
        $j = 0; //счетчик для завершения задания
        
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
                    
                    include 'templ/need_task_card.php';
                }
    
                if($i ==  1){ //вывод материальной помощи
                    $date_start = date("d.m", strtotime($row['date_start'])); //дата начала
                    $date_end = date("d.m", strtotime($row['date_end'])); //дата окончания
                    $summ_deneg = $row['summ_deneg'];  //сумма денег     
                    
                    include 'templ/material_task_card.php';
                   
                
                }

                if($i == 2){ //выво особый помощи 
                    $date = date("d.m", strtotime($row['date'])); //дата 
                    $time = $row['time']; //время
                    $time_length = $row['time_length']; //продолжительность
                    $people_amout = $row['people_amout']; //кол-во людей
                    $people_feedback = $row['people_feedback']; //кол-во откликнувших. людей
                    
            
                    include 'templ/special_task_card.php';
                    
                    
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
        $j = 0; //счетчик для завершения задания

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
        
                        include 'templ/need_task_card.php';
        
                    
                    }
        
                    if($i ==  1){ //вывод материальной помощи
                        
                            $date_start = date("d.m", strtotime($row['date_start'])); //дата начала
                            $date_end = date("d.m", strtotime($row['date_end'])); //дата окончания
                            $summ_deneg = $row['summ_deneg'];  //сумма денег             
                            include 'templ/material_task_card.php';
                    }

                    if($i == 2){ //выво особый помощи 
                        $date = date("d.m", strtotime($row['date'])); //дата 
                        $time = $row['time']; //время
                        $time_length = $row['time_length']; //продолжительность
                        $people_amout = $row['people_amout']; //кол-во людей
                        $people_feedback = $row['people_feedback']; //кол-во откликнувших. людей
                        include 'templ/special_task_card.php';
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
                "message" => "Задачи на $date_task пока еще не созданы!",
                "type" => 0.1, //тип вывода всех задач c  датой
            ];
    
            echo json_encode($response);
            die();
            
        } else {
            
             $response = [
                "status" => true,
                "message" => "Вывод всех заданий с датой",
                "type" => 0, //тип вывода всех задач c  датой
                "task" => $all_task
            ];

            echo json_encode($response);
            die();
            
        }
        
       
    }

     /* 
        Вывод необходимой помощи 
    */ 

    if($type_task == 1 and $date_task == ""){ //вывод необходимой помощи без даты
        $result =$result = mysqli_query($mysql, "SELECT * FROM `need_tasks`");
        
        if(mysqli_num_rows($result)>0){
            $j = 0; //счетчик для завершения задания
            while ($row = $result->fetch_assoc()){
                $id_task =  $row['id_task'];
                $id_type =  $row['id_type'];
                $id_admin =  $row['id_admin'];
                $name = $row['name']; //название задания

                $date = date("d.m", strtotime($row['date'])); //дата 
                $time = $row['time']; //время
                $time_length = $row['time_length']; //продолжительность
                $people_amout = $row['people_amout']; //кол-во людей
                $people_feedback = $row['people_feedback']; //кол-во откликнувших. людей

                include 'templ/need_task_card.php';
                
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
            
        } else{
            $response = [
                "status" => false,
                "message" => 'Задание пока не создано! Перейдите в раздел Мои задания',
                "type" => 0.1
            ];

            echo json_encode($response);
            die();
        }
    } 

    if(!empty($date_task) and $type_task == 1){ //вывод необход. помощи с датой 
        $result = mysqli_query($mysql, "SELECT * FROM `need_tasks` WHERE `date`='$date_task'"); //забираю данные из БД

        if(mysqli_num_rows($result)>0){
            $j = 0; //счетчик для завершения задания
            while ($row = $result->fetch_assoc()) // получаем все строки в цикле по одной
            {
                $id_task =  $row['id_task'];
                $id_type =  $row['id_type'];
                $id_admin =  $row['id_admin'];
                $name = $row['name']; //название задания

                $date = date("d.m", strtotime($row['date'])); //дата 
                $time = $row['time']; //время
                $time_length = $row['time_length']; //продолжительность
                $people_amout = $row['people_amout']; //кол-во людей
                $people_feedback = $row['people_feedback']; //кол-во откликнувших. людей

                include 'templ/need_task_card.php';
            }
            $mysql->close();

            $response = [
                "status" => true,
                "message" => "Вывод всех заданий",
                "type" => 0, 
                "task" => $all_task
            ];

            echo json_encode($response);
            die();
            
        } else {
            
            $date_task = date("d.m", strtotime($date_task)); //дата 
            $response = [
                "status" => false,
                "message" => "Задачи на $date_task пока еще не созданы!",
                "type" => 0.1, //тип вывода всех задач c  датой
            ];
    
            echo json_encode($response);
            die();
        }
        
    }

    /* 
        Вывод материальной помощи 
    */ 
    
    if($type_task == 2 and $date_task == ""){ //вывод матер. помощи без даты
       $result = mysqli_query($mysql, "SELECT * FROM  `material_task`");
        
        if(mysqli_num_rows($result)>0){
            $j = 0; //счетчик для завершения задания
            while ($row = $result->fetch_assoc()) // получаем все строки в цикле по одной
            {
                $id_task =  $row['id_task'];
                $id_type =  $row['id_type'];
                $id_admin =  $row['id_admin'];
                $name = $row['name']; //название задания
                
                $date_start = date("d.m", strtotime($row['date_start'])); //дата начала
                $date_end = date("d.m", strtotime($row['date_end'])); //дата окончания
                $summ_deneg = $row['summ_deneg'];  //сумма денег     
                

                include 'templ/material_task_card.php';
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
            
        } else { //когда нет заданий 
            $response = [
                "status" => false,
                "message" => 'Задание пока не создано! Перейдите в раздел "Мои задания"',
                "type" => 0.1
            ];

            echo json_encode($response);
            die();
        }
        

       
        
    } 
    
    if(!empty($date_task) and $type_task == 2){ //вывод матер. помощи на основе даты
        $result = mysqli_query($mysql, "SELECT * FROM  `material_task` WHERE `date_start`<='$date_task' AND `date_end`>='$date_task'");

        if(mysqli_num_rows($result)>0){
            $j = 0; //счетчик для завершения задания
            while ($row = $result->fetch_assoc()) // получаем все строки в цикле по одной
            {
                $id_task =  $row['id_task'];
                $id_type =  $row['id_type'];
                $id_admin =  $row['id_admin'];
                $name = $row['name']; //название задания
                
                $date_start = date("d.m", strtotime($row['date_start'])); //дата начала
                $date_end = date("d.m", strtotime($row['date_end'])); //дата окончания
                $summ_deneg = $row['summ_deneg'];  //сумма денег     
                
                include 'templ/material_task_card.php';
            }
            $mysql->close();

            $response = [
                "status" => true,
                "message" => "Вывод всех заданий",
                "type" => 0, 
                "task" => $all_task
            ];

            echo json_encode($response);
            die();
            
        } else {
            
            $date_task = date("d.m", strtotime($date_task)); //дата 
            $response = [
                "status" => false,
                "message" => "Задачи на $date_task пока еще не созданы!",
                "type" => 0.1, //тип вывода всех задач c  датой
            ];
    
            echo json_encode($response);
            die();
        }
    }

/*
    Вывод особых поручений 
*/

if($type_task == 3 and $date_task == ""){
    $result = mysqli_query($mysql, "SELECT * FROM `special_tasks`");

    if(mysqli_num_rows($result)>0){
        $j = 0; //счетчик для завершения задания
        while ($row = $result->fetch_assoc()) // получаем все строки в цикле по одной
        {
            $id_task =  $row['id_task'];
            $id_type =  $row['id_type'];
            $id_admin =  $row['id_admin'];
            $name = $row['name']; //название задания
            
            $date = date("d.m", strtotime($row['date'])); //дата 
            $time = $row['time']; //время
            $time_length = $row['time_length']; //продолжительность
            $people_amout = $row['people_amout']; //кол-во людей
            $people_feedback = $row['people_feedback']; //кол-во откликнувших. людей
            
            include 'templ/special_task_card.php';
        }

        $mysql->close();

            $response = [
                "status" => true,
                "message" => "Вывод всех заданий",
                "type" => 0, 
                "task" => $all_task
            ];

            echo json_encode($response);
            die();
            
    } else { //когда нет заданий 
        $response = [
            "status" => false,
            "message" => 'Задание пока не создано! Перейдите в раздел "Мои задания"',
            "type" => 0.1
        ];

        echo json_encode($response);
        die();
    }

    
}

if(!empty($date_task) and $type_task == 3){ //вывод особ. поручения на основе даты
    $result = mysqli_query($mysql, "SELECT * FROM  `special_tasks` WHERE `date`='$date_task'");

    if(mysqli_num_rows($result)>0){
        $j = 0; //счетчик для завершения задания
        while ($row = $result->fetch_assoc()) // получаем все строки в цикле по одной
        {
            $id_task =  $row['id_task'];
            $id_type =  $row['id_type'];
            $id_admin =  $row['id_admin'];
            $name = $row['name']; //название задания
            
            $date = date("d.m", strtotime($row['date'])); //дата 
            $time = $row['time']; //время
            $time_length = $row['time_length']; //продолжительность
            $people_amout = $row['people_amout']; //кол-во людей
            $people_feedback = $row['people_feedback']; //кол-во откликнувших. людей

            include 'templ/special_task_card.php';
        }
        $mysql->close();

        $response = [
            "status" => true,
            "message" => "Вывод всех заданий",
            "type" => 0, 
            "task" => $all_task
        ];

        echo json_encode($response);
        die();
        
    } else {
        
        $date_task = date("d.m", strtotime($date_task)); //дата 
        $response = [
            "status" => false,
            "message" => "Задачи на $date_task пока еще не созданы!",
            "type" => 0.1, //тип вывода всех задач c  датой
        ];

        echo json_encode($response);
        die();
    }
}

?>