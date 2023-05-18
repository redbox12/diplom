<?php 
if($_SESSION['user']['admin'] == 1){
    $all_task[] = ' 
            <div class= "card mb-1 delete">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-2 mt-md-2 mt-sm-3 pe-0">
                                <i class="bx bx-star d-flex align-items-center card-icon rounded-circle justify-content-center special_icon" ></i>
                                    
                            </div>

                            <div class="col-10 ps-0 ps-lg-1 pe-0 mt-lg-2 ">
                            <h5 class="card-title fw-bold pt-3 m-0 text-sm-center text-md-start  text-truncate" >'.$name.'</h5> 
                            </div>
                    
                        </div>
            <div class="row">
                <div class="col-lg-8">
                    <span class="small text-muted ">Дата: '.$date.'</span>
                    <br><span class="text-muted small pt-2">Время: '.$time.'</span>
                    <br><span class="text-muted small pt-2">Продолжительность:  '.$time_length.' мин</span>
                </div>

                <div class="col-lg-4 mt-lg-2 ps-lg-0">
                    <i style="font-size: 32px;" class="bi bi-people-fill"></i>
                    <span style="font-size: 25px;"> '.$people_feedback.'/ '.$people_amout.' </span>
                </div>
            </div>

            <div class="row">
             
                <div class="col mt-2 ">
                <form action="product_page.php" method="POST">
                    <input  type="hidden" id="id_task'.$j.'" name="id_task" value="'.$id_task.'">
                    <input  type="hidden" id="id_type'.$j.'" name="id_type" value="'.$id_type.'">
                    <button class="btn btn-danger btn-sm finished-task">Завершить</button>
                    <button class="btn btn-primary btn-sm ms-1" type="submit" >Подробнее...</button>
                </form>  
                </div>
          
            </div>

        </div>
    </div>';

    $j++;
} else if($_SESSION['user']['super_normal'] == 1){

    $id_human = $_SESSION['user']['id'];
    $task_id_human_otkl = mysqli_query($mysql, "SELECT * FROM `players` WHERE `id_human` = '$id_human' AND `id_task` = '$id_task' AND `id_type` = '$id_type'");
       
        if($people_feedback < $people_amout and mysqli_num_rows($task_id_human_otkl) == 0){
            $all_task[] = ' 
            <div class= "card mb-1 response">
                    <div class="card-body">
                    <div class="row mb-2">
                    <div class="col-2 mt-md-2 mt-sm-3 pe-0">
                        <i class="bx bx-star d-flex align-items-center card-icon rounded-circle justify-content-center special_icon" ></i>
                            
                    </div>

                    <div class="col-10 ps-0 ps-lg-1 pe-0 mt-lg-2">
                    <h5 class="card-title fw-bold pt-3 m-0 text-sm-center text-md-start  text-truncate" >'.$name.'</h5> 
                    </div>
            
                </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <span class="small text-muted ">Дата: '.$date.'</span>
                                <br><span class="text-muted small pt-2">Время: '.$time.'</span>
                                <br><span class="text-muted small pt-2">Продолжительность:  '.$time_length.' мин</span>
                            </div>
            
                            <div class="col-lg-4 mt-lg-2 ps-lg-0">
                                <i style="font-size: 32px;" class="bi bi-people-fill"></i>
                                <span style="font-size: 25px;"> '.$people_feedback.'/ '.$people_amout.' </span>
                            </div>
                        </div>
            
                        <div class="row">
                         
                            <div class="col mt-2 ">
                            <form action="product_page.php" method="POST">
                                <input  type="hidden" id="id_task'.$j.'" name="id_task" value="'.$id_task.'">
                                <input  type="hidden" id="id_type'.$j.'" name="id_type" value="'.$id_type.'">
                                <input type="hidden" id="id_human'.$j.'" name="id_human" value="'.$_SESSION['user']['id'].'">
                                <button class="btn btn-success btn-sm response-task">Откликнуться</button>
                                <button class="btn btn-primary btn-sm ms-1" type="submit" >Подробнее...</button>
                            </form> 
                            </div>
                      
                        </div>
            
                    </div>
                </div>';
            
                $j++;
        }
    
    // }

}

?>