<?php 
if($_SESSION['user']['admin'] == 1){
    $prots = 0.0;
    $donate = str_replace([' ', '(', ')', '-'], '', $donate);
    $summ_deneg = str_replace([' ', '(', ')', '-'], '', $summ_deneg);
    $prots = (float) $donate*100/$summ_deneg;
    if($prots < 1 and $prots != 0){
        $prots = 2;
    }
    $summ_deneg = number_format($summ_deneg, 0, '.', ' '); //вывод с пробелами
    $donate = number_format($donate, 0, '.', ' '); 
    $all_task[] = '
    <div class="card mb-1 delete">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-2 mt-md-2 mt-sm-3 pe-0">
                        <i class="bx bx-coin d-flex align-items-center card-icon rounded-circle justify-content-center rubl"></i>
                </div>

                <div class="col-10 pe-0 mt-lg-2 ">
                <h5 class="card-title fw-bold pt-3 m-0 text-sm-center text-md-start text-capitalize text-truncate" >'.$name.'</h5> 
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-lg-10 col-sm-12">
                    <span class="small text-muted ">Дата сбора:&nbsp'.$date_start.' - '.$date_end.'  </span>
                    <br><span class="text-muted small pt-2">Необходимая сумма:&nbsp'.$summ_deneg.' руб.</span>
                    <br><span class="text-muted small pt-2">Собраная сумма:&nbsp'.$donate.' руб.</span>
                </div>
            </div>

            <div class="row">   
                <div class="col-lg-12 col-sm-12 mx-auto mt-1">
            <div class="progress">
                <div class="progress-bar text-center" role="progressbar" style="background: #fff9c8; width: '.$prots.'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
                </div>
            </div>
            
            <div class="row mt-2">
                <div class="col mt-2 ">
                <form action="product_page.php" method="POST">
                        <input type="hidden" id="id_task'.$j.'" name="id_task" value="'.$id_task.'">
                        <input type="hidden" id="id_type'.$j.'"name="id_type" value="'.$id_type.'">
                        <button class="btn btn-danger btn-sm finished-task">Завершить</button>
                        <button class="btn btn-primary btn-sm ms-1" type="submit" >Подробнее...</button>
                        <button class="btn btn-sm p-0 edit_task"><i class="bx bx-edit mt-1" style="font-size: 32px;"></i></button>
                    </form>  
                </div>
            </div>
   
        </div>
    </div>';
    
    $j++;
   

}else{
    $prots = 0.0;
    $donate = str_replace([' ', '(', ')', '-'], '', $donate);
    $summ_deneg = str_replace([' ', '(', ')', '-'], '', $summ_deneg);
    $prots = (float) $donate*100/$summ_deneg;
    if($prots < 1 and $prots != 0){
        $prots = 2;
    }
    $summ_deneg = number_format($summ_deneg, 0, '.', ' '); //вывод с пробелами
    $donate = number_format($donate, 0, '.', ' '); 
    $all_task[] = '
    <div class="card mb-1 response">
        <div class="card-body">
        <div class="row mb-2">
            <div class="col-2 mt-md-2 mt-sm-3 pe-0">
                    <i class="bx bx-coin d-flex align-items-center card-icon rounded-circle justify-content-center rubl"></i>
            </div>

            <div class="col-10 ps-0 ps-lg-1 pe-0  mt-lg-2 ">
            <h5 class="card-title fw-bold pt-3 m-0 text-sm-center text-md-start  text-truncate" >'.$name.'</h5> 
            </div>
        
    </div>
    
            <div class="row">
                <div class="col-lg-10 col-sm-12">
                    <span class="small text-muted ">Дата сбора:&nbsp'.$date_start.' - '.$date_end.'  </span>
                    <br><span class="text-muted small pt-2">Необходимая сумма:&nbsp'.$summ_deneg.' руб.</span>
                    <br><span class="text-muted small pt-2">Собраная сумма:&nbsp'.$donate.' руб.</span>
                </div>
            </div>

            <div class="row">   
                <div class="col-lg-12 col-sm-12 mx-auto mt-1">
            <div class="progress">
                <div class="progress-bar text-center" role="progressbar" style="background: #fff9c8; width: '.$prots.'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
                </div>
            </div>
    
    
            <div class="row">
                <div class="col mt-2 ">
                <form action="product_page.php" method="POST">
                   <input type="hidden" name="id_task" value="'.$id_task.'">
                   <input type="hidden" name="id_type" value="'.$id_type.'">
                   <button class="btn btn-primary btn-sm ms-1" type="submit" >Подробнее...</button>
                </form>   
                </div>
          
            </div>
   
        </div>
    </div>';
   

}

 
?>