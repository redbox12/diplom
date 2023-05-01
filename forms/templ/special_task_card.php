<?php 
$all_task[] = ' 
<div class= "card mb-1 delete">
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
             
                <div class="col mt-2 ">
                    <input  type="hidden" name="id_task'.$j.'" value="'.$id_task.'">
                    <input  type="hidden" name="id_type'.$j.'" value="'.$id_type.'">
                    <button class="btn btn-danger btn-sm finished-task" type="submit" >Завершить</button>
                </div>
          
            </div>

        </div>
    </div>';

    $j++;
?>