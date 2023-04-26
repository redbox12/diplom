<?php 
session_start();
  include 'blocks/header.php';
  include 'blocks/side-menu.php';
  include 'forms/conect.php';
  //include 'forms/my_task_admin_back.php';
  $num_rows = [];

 $check_task_need = mysqli_query($mysql, "SELECT COUNT(*) FROM `need_tasks`");
 $num_rows[] = mysqli_fetch_array( $check_task_need )[0];

 $check_task_mtrl = mysqli_query($mysql, "SELECT COUNT(*) FROM `material_task`");
 $num_rows[] = mysqli_fetch_array( $check_task_mtrl )[0];

 $check_task_special = mysqli_query($mysql, "SELECT COUNT(*) FROM `special_tasks`");
 $num_rows[] = mysqli_fetch_array( $check_task_special)[0];

    foreach ($num_rows as $value) {
        $summ_task += $value;
    }

    function get_static(){
        
        global $num_rows;
        global $summ_task;
        
        echo '
        <div class="col-lg-3 mt-3 p-0">
        <span> Кол-во заданий: <span class="badge bg-primary  text-light">'.$summ_task.'</span></span> 
        </div>
        
        <div class="col-lg-3 mt-3 p-0">
        <span class="me-3"> Необходимые задания: <span class="badge bg-primary  text-light">'.$num_rows[0].'</span> </span> 
        </div>
        
        <div class="col-lg-3 mt-3 p-0">
        <span class="me-3"> Матреальные задания: <span class="badge bg-primary text-light">'.$num_rows[1].'</span></span> 
        </div>

        <div class="col-lg-3 mt-3 p-0">
        <span class="me-3"> Особые поручение: <span class="badge bg-primary  text-light">'.$num_rows[2].'</span></span>     
        </div>';

    }   


   
 
?>

<body>
    <main id="main" class="main">
        <div class="container ">
            <div class="row my-2">
                <h1> Мои задания </h1>
            </div>



            <div class="row mt-3">
                <div class="card ms-lg-3 col-lg-10 col-md-12">
                    <div class="card-body">
                        <div class="row">
                            <!-- Вывод кол-во заданий -->
                            <?php  get_static();?>
                        </div>
                        <form>
                            <div class="row mt-4">
                                <div class="col-lg-3 col-sm-4 mb-2">
                                    <label>Тип задания: </label>
                                    <select class="form-select type-task" aria-label="Пример выбора по умолчанию">
                                        <option value="0">Все</option>
                                        <option value="1">Необходимые</option>
                                        <option value="2">Материальные</option>
                                        <option value="3">Особые поручение</option>
                                    </select>

                                </div>
                                <div class="col-lg-3 col-sm-6 mb-2">
                                    <label>Дата: </label>
                                    <input type="date" class="form-control" name="date_task">
                                </div>
                                <div class="col-lg-3 col-sm-6 mb-2 mt-sm-2 mt-lg-4">
                                    <button class="btn btn-primary filter-task" type="submit">Применить</button>
                                </div>

                            </div>
                            <!-- <div class="row">
                                <div class="filtres col-lg-5">
                                </div>
                            </div> -->
                        </form>
                    </div>



                </div>
            </div>



            <div class="row" id="task-card">
                <!-- <div class=" col-lg-5 col-md-12 mb-1 ms-lg-3 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h5 class="card-title fw-bold pt-3 ms-2 m-0">Помыть пол в храме</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <span class="small text-muted ">Начало: 12.02</span>
                                    <br><span class="text-muted small pt-2">Время: 12:00</span>
                                    <br><span class="text-muted small pt-2">Продолжительность: 50 мин</span>
                                </div>

                                <div class="col-lg-4 mt-lg-2 ps-lg-0">
                                    <i style="font-size: 32px;" class="bi bi-people-fill"></i>
                                    <span style="font-size: 25px;"> 0/5 </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mt-3">
                                    <button class="btn btn-danger btn-sm" type="submit">Завершить</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div> -->




                <?php //get_tasks("all");?>

                <!-- <div class="col-lg-5 col-md-12 mb-1 ms-lg-3 mt-2">
                    <div class="card mb-1">
                        <div class="card-body">
                            <div class="row">
                                <h5 class="card-title fw-bold pt-3 ms-2 m-0">Помыть пол в храме</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <span class="small text-muted ">Начало: 12.02</span>
                                    <br><span class="text-muted small pt-2">Время: 13:00 </span>
                                    <br><span class="text-muted small pt-2">Продолжительность: 50 мин </span>
                                </div>

                                <div class="col-lg-4 mt-lg-2 ps-lg-0">
                                    <i style="font-size: 32px;" class="bi bi-people-fill"></i>
                                    <span style="font-size: 25px;"> 0/4 </span>
                                </div>
                            </div>

                            <div class="row">
                                <form class="">
                                    <div class="col mt-2 ">
                                        <input type="hidden" name="id_task" value="12">
                                        <input type="hidden" name="id_task" value="2">
                                        <button class="btn btn-danger btn-sm" type="submit">Завершить</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div> -->



                <!-- <div class="row">
                    <div class="col-lg-10 col-sm-10 d-flex justify-content-center mt-2">
                        <button type="button" class="btn btn-primary ms-lg-5">Загрузить ещё </button>
                    </div>
                </div> -->


            </div>





        </div>
        <script src="assets/js/my_task.js"></script>

    </main>
</body>