<?php 
session_start();
  include 'blocks/header.php';
  include 'blocks/side-menu.php';
  include 'forms/conect.php';
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
        <div class="ms-lg-2 col-lg-3 mt-3 p-0 mb-3">
        <p class="mx-auto"> <strong>Кол-во задач: </strong> &nbsp; <span class="badge bg-primary  text-light">'.$summ_task.'</span></p> 
        </div>
        
        <div class="col-lg-2 mt-lg-3 p-0 mx-auto">
        <p class="mx-auto"> <strong>Работ:</strong> &nbsp; <span class="badge bg-primary  text-light">'.$num_rows[0].'</span> </p> 
        </div>
        
        <div class="col-lg-2 mt-lg-3 p-0 mx-auto">
        <p class="mx-auto"><strong> Сбор средств: </strong>  &nbsp;<span class="badge bg-primary text-light">'.$num_rows[1].'</span></p> 
        </div>

        <div class="col-lg-4 mt-lg-3 p-0 mx-auto">
        <p class="mx-auto text-start"> <strong>Особые поручения:</strong>  &nbsp;<span class="badge bg-primary  text-light">'.$num_rows[2].'</span></p>     
        </div>';

    }   


   
 
?>

<body>
    <main id="main" class="main">
        <div class="container ">
            <div class="row my-2">
                <h1> Мои задачи </h1>
            </div>



            <div class="row mt-3">
                <div class="card ms-lg-3 col-lg-10 col-md-12">
                    <div class="card-body">
                        <div class="row mt-2">
                            <!-- Вывод кол-во заданий -->
                            <?php  get_static();?>
                        </div>
                        <form>
                            <div class="row mt-2">
                                <div class="col-lg-3 col-sm-4 mb-2">
                                    <label>Тип задания: </label>
                                    <select class="form-select type-task" aria-label="Пример выбора по умолчанию">
                                        <option value="0">Все</option>
                                        <option value="1">Работы</option>
                                        <option value="2">Сбор средств</option>
                                        <option value="3">Особые поручения</option>
                                    </select>

                                </div>
                                <div class="col-lg-3 col-sm-6 mb-2">
                                    <label>Дата: </label>
                                    <input type="date" class="form-control" name="date_task">
                                </div>
                                <div class="col-lg-6 col-sm-6 mb-2 mt-sm-2 mt-lg-4 justify-content-md-center">
                                    <button class="btn btn-primary filter-task" type="submit">Применить</button>
                                    <button type="reset" class="btn btn-secondary ubrat ms-1">Cбросить</button>
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

            <div class="modal fade" id="modal-delete-task" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            <p>Вы точно хотите завершить задание?</p>
                            <button type="button" class="btn btn-success">Да</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Нет</button>

                        </div>
                        <div class="modal-footer d-flex justiful-content-center">

                        </div>
                    </div>
                </div>
            </div>


            <div class="row" id="task-card">
                <!-- Вывод заданий -->

            </div>

        </div>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/my_task.js"></script>
        <script src="assets/js/finished_task.js"></script>


    </main>
</body>