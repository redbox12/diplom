<?php 
 $all_task[] = '
 <div class="card mb-1 delete">
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
                <input type="hidden" name="id_task'.$j.'" value="'.$id_task.'">
                <input type="hidden" name="id_type'.$j.'" value="'.$id_type.'">
                <button class="btn btn-danger btn-sm finished-task">Завершить</button>
             </div>
       
         </div>

     </div>
 </div>';

 $j++;
 
?>