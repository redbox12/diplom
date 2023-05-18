<?php 
if($_SESSION['user']['admin'] == 1){

    $button = '
    <div class="delete">    
        <input type="hidden" id="id_task'.$j.'" name="id_task" value="'.$id_task.'">
        <input type="hidden" id="id_type'.$j.'"name="id_type" value="'.$id_type.'">
        <button class="btn btn-danger btn-sm  finished-task">Завершить</button>
    </div>';
    
} else {
    $button = '';
}
$result = mysqli_query($mysql, "SELECT * FROM `material_task` WHERE `id_task`='$id_task'");
$row = $result->fetch_assoc();
$id_admin = $row['id_admin'];

  //забираем  данные из БД организатора для вывода инф-ии о нём
  $result_admin = mysqli_query($mysql, "SELECT * FROM `personal_date` WHERE `id`='$id_admin'");
  $row_admin = $result_admin->fetch_assoc();

  $info_task = [
    "name" => $row['name'], 
    "date_start" =>  date("d.m", strtotime($row['date_start'])),
    "date_end" => date("d.m", strtotime($row['date_end'])),
    "card_bank" => $row['card_bank'],
    "summ_deneg" => $row['summ_deneg'],
    "donate" => $row['donate'],
    "description" => $row['description'],
    "telephone_admin" => $row_admin['telephone'],
    "name_admin" =>  $row_admin['name']
];
//Для корректного вывода денег
$prots = 0.0;
$info_task['donate'] = str_replace([' ', '(', ')', '-'], '', $info_task['donate']);
$info_task['summ_deneg'] = str_replace([' ', '(', ')', '-'], '', $info_task['summ_deneg']);
$prots = (float) $info_task['donate']*100/$info_task['summ_deneg'];
if($prots < 1 and $prots != 0){
    $prots = 2;
}
$info_task['summ_deneg'] = number_format($info_task['summ_deneg'], 0, '.', ' '); //вывод с пробелами
$info_task['donate'] = number_format($info_task['donate'], 0, '.', ' '); 

    
echo '
<div class="row ">
<h1 class=""> <strong>'.$info_task['name'].' </strong></h1>
</div>

<div class="row mt-3">
<div class="col-lg-3 col-md-7 col-sm-12">
    <div class="card">
        <div class="card-body">
            <img src="assets/img/donation.png" class="img-fluid mt-lg-2 p-1 pb-lg-4 p-md-4" alt="...">
           
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

            <dl class="row">
                <dt class="col-lg-5 col-sm-3">Дата начало:</dt>
                <dd class="col-lg-5 col-sm-9">' .$info_task['date_start'].'</dd>

                <dt class="col-lg-5 col-sm-3">Дата окончания:</dt>
                <dd class="col-lg-5 col-sm-9">'.$info_task['date_end'].'</dd>

                <dt class="col-lg-5 col-sm-3">Банковская карта:</dt>
                <dd class="col-lg-6 col-sm-9">'.$info_task['card_bank'].'</dd>
            </dl>
            '.$button.'
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card mb-lg-2">
        <div class="card-body">
            
            <dl class="row mt-4 pb-2">
                <dt class="col-lg-8 col-sm-3">Необходимая сумма:&nbsp</dt>
                <dd class="col-lg-4 col-sm-9">'.$info_task['summ_deneg'].'р. </dd>

                <dt class="col-lg-8 col-sm-3">Собраная сумма:&nbsp</dt>
                <dd class="col-lg-4 col-sm-9">'.$info_task['donate'].'р. </dd>
                <div class="row">   
                <div class="col-lg-12 col-sm-12 mx-auto mt-1">
            <div class="progress"  style="height: 40px;" >
                <div class="progress-bar text-center" role="progressbar" style="background: #fff9c8; width: '.$prots.'%; height: 70px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
                </div>
            </div>

            </dl>
        </div>
    </div>
</div>
</div>

<div class="row">
<div class="col-lg-5 col-md-6 col-sm-12">
    <div class="card">
        <div class="card-body">
            <h4 class=" text-center my-2"><strong>Как пожертвовать?</strong></h4>

            <div class="row mx-lg-2 mt-lg-2">
               <p> 1. Переведите сумму денег на указанную карту выше через приложение в банке<br><br>
               2. В СМС переводе укажите на что жертвуйте. Например: “На стройматериалы”</p>

            </div>

            
        </div>
    </div>
</div> 
<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card pb-lg-5">
        <div class="card-body">
            <h4 class=" text-center mt-2"><strong>Организатор</strong></h4>

            <dl class="row">
                <dt class="col-lg-5 col-sm-3">Имя:</dt>
                <dd class="col-lg-6 col-sm-9">'.$info_task['name_admin'].'</dd>

                <dt class="col-lg-5 col-sm-3">Телефон:</dt>
                <dd class="col-lg-5 col-sm-9">'.$info_task['telephone_admin'].'</dd>


            </dl>
            
        </div>
    </div>
</div>    

</div>
';

// <table class="table table-borderless table-sm">
// <tr>
//     <th scope="row">Имя:</th>
//     <td>' .$info_task['name_admin'].'</td>
// </tr>
// <tr>
//     <th scope="row">Телефон:</th>
//     <td>'.$info_task['telephone_admin'].'</td>
// </tr>
// </tbody>
// </table>

?>