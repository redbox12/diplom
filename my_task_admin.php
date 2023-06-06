<?php 
session_start();
ob_start(); 
  include 'blocks/header.php';
  include 'blocks/side-menu.php';
  include 'forms/conect.php';

  if($_SESSION['user']['normal'] == 1 or $_SESSION['user']['super_normal'] == 1 ){
    header('Location: tasks_catalog.php');
    ob_end_flush();
}
  
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
        <div class="ms-lg-2 col-lg-3 mt-3 p-0 mb-lg-3">
        <p class="mx-auto"> <strong>Всего задач: </strong> &nbsp; <span class="badge bg-primary  text-light">'.$summ_task.'</span></p> 
        </div>
        
        <div class="col-lg-2 mt-lg-3 p-0 mx-auto">
        <p class="mx-auto"> <strong>Работы:</strong> &nbsp; <span class="badge bg-primary  text-light">'.$num_rows[0].'</span> </p> 
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
                            <button type="button" class="btn-close close-setting" data-bs-dismiss="modal"
                                aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body modal-body-delete">
                            <p>
                                <strong>Вы точно хотите завершить задание?</strong>
                            </p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Задача выполнена
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Задача не выполнена
                                </label>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-success btn-finished">Да</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Нет</button>
                            </div>


                        </div>
                        <div class="modal-footer d-flex justiful-content-center">

                        </div>
                    </div>
                </div>
            </div>



            <div class="row" id="task-card">
                <!-- Вывод заданий -->

            </div>



            <!-- Модальное окно для "Работ" -->

            <div class="modal fade" id="modal-edit-task-1" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"> Редактирование задачи</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            <div class="task-need-form">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-11 mx-auto">
                                        <label for="inputNanme4" class="form-label">Название
                                            задачи</label>
                                        <input type="text" class="form-control" name="name" id="1"
                                            placeholder="Помыть пол в храме">
                                    </div>
                                </div>

                                <div class="row justify-content-center mt-3">
                                    <div class="col-lg-5  mx-auto col-sm-6 ">
                                        <label for="inputDate" class="col-form-label">
                                            Дата проведения</label>
                                        <input type="date" class="form-control" name="date">

                                    </div>
                                    <div class="col-lg-5 mx-auto col-sm-6">
                                        <label for="inputTime" class="col-form-label">Время
                                            проведения</label>
                                        <input type="time" id="validationDefault01" class="form-control" name="time">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-11 mx-auto col-sm-12 mt-3">
                                        <label for="inputAddress" class="form-label">Продолжительность
                                        </label>
                                        <input name="time_length" class="form-control onlyNumbers" placeholder="20 мин">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-11 mx-auto col-sm-12 mt-3">
                                        <label for="inputAddress" class="form-label">Одежда</label>
                                        <select name="clothes" id="inputState" class="form-select clothes">
                                            <option selected="">Выбрать...</option>
                                            <option value="1">Обычная</option>
                                            <option value="2">Рабочая</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-11 mx-auto col-sm-12 mt-3">
                                        <label for="inputAddress" class="form-label">Кол-во
                                            человек</label>
                                        <input name="amout_people" id="validationDefault01" type="text"
                                            class="form-control onlyNumbers" placeholder="3">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-11 mx-auto col-sm-12 mt-3">
                                        <label for="floatingTextarea">Описание</label>
                                        <textarea name="description" id="validationDefault01" class="form-control"
                                            style="height: 100px;"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-11 mx-auto mt-2">
                                        <div class="msg none alert alert-primary alert-dismissible fade show mt-2 "
                                            role="alert">
                                            Валидация
                                        </div>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-lg-start justify-content-center mt-3 ">
                                    <button type="submit"
                                        class="btn btn-primary me-2 ms-lg-3 need-task-edit">Cохранить</button>
                                    <button type="reset" class="btn btn-secondary ubrat_input">Убрать</button>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justiful-content-center">

                        </div>
                    </div>
                </div>
            </div>


            <!-- Модальное окно для "Сбор средств" -->

            <div class="modal fade" id="modal-edit-task-2" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Редактирование задачи</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            <div class="task-mtrl-form">
                                <div class="col-sm-12 col-lg-11 mx-auto">
                                    <label for="inputNanme4" class="form-label">Название</label>
                                    <input type="text" class="form-control" name="name_mtrl" placeholder="Ремонт храма">
                                </div>
                                <div class="row d-flex justify-content-start mt-2">
                                    <div class="col-lg-5 mx-auto col-sm-6">
                                        <label for="inputDate" class=" col-form-label">
                                            Дата начало</label>
                                        <input type="date" class="form-control" name="date_start">
                                    </div>

                                    <div class="col-lg-5 mx-auto col-sm-6 ">
                                        <label for="inputDate" class="col-form-label">
                                            Дата окончания</label>

                                        <input type="date" class="form-control" name="date_end">

                                    </div>

                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-11 col-sm-12 mx-auto">
                                        <label class="form-label">Номер карты для перевода</label>

                                        <input type="text" class="mask-card-number form-control"
                                            placeholder="9999 9999 9999 9999" name="card_mtrl" value="">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-11 col-sm-12 mx-auto">
                                        <label class="form-label">Сумма денег</label>
                                        <input name="summ_den_mtrl" type="text" class="form-control onlyNumbers"
                                            placeholder="2000 р." value="">
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="col-sm-12 col-lg-11 mt-3 mx-auto">
                                        <label for="floatingTextarea">Описание</label>
                                        <textarea name="description_mtrl" class=" form-control"
                                            style="height: 100px;"></textarea>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="msg none alert alert-primary alert-dismissible fade show mt-2 "
                                            role="alert">
                                            Валидация полей
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-lg-start justify-content-center mt-3 ">
                                    <button type="submit"
                                        class="btn btn-primary me-2 ms-lg-3 mtrl-task-edit">Cохранить</button>
                                    <button type="reset" class="btn btn-secondary ubrat_input">Убрать</button>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justiful-content-center">

                        </div>
                    </div>
                </div>
            </div>


            <!-- Модальное окно для "Особые поручения" -->

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

            <div class="modal fade" id="modal-edit-task-3" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"> Редактирование задачи</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            <div class="ta">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-11 mx-auto">
                                        <label for="inputNanme4" class="form-label">Название
                                            задачи</label>
                                        <input type="text" class="form-control" name="name_s" id="1"
                                            placeholder="Помыть пол в храме">
                                    </div>
                                </div>

                                <div class="row justify-content-center mt-3">
                                    <div class="col-lg-5  mx-auto col-sm-6 ">
                                        <label for="inputDate" class="col-form-label">
                                            Дата проведения</label>
                                        <input type="date" class="form-control" name="date_s">

                                    </div>
                                    <div class="col-lg-5 mx-auto col-sm-6">
                                        <label for="inputTime" class="col-form-label">Время
                                            проведения</label>
                                        <input type="time" id="validationDefault01" class="form-control" name="time_s">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-11 mx-auto col-sm-12 mt-3">
                                        <label for="inputAddress" class="form-label">Продолжительность
                                        </label>
                                        <input name="time_length_s" class="form-control onlyNumbers"
                                            placeholder="20 мин">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-11 mx-auto col-sm-12 mt-3">
                                        <label for="inputAddress" class="form-label">Одежда</label>
                                        <select name="clothes_s" id="inputState" class="form-select clothes">
                                            <option selected="">Выбрать...</option>
                                            <option value="1">Обычная</option>
                                            <option value="2">Рабочая</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-11 mx-auto col-sm-12 mt-3">
                                        <label for="inputAddress" class="form-label">Кол-во
                                            человек</label>
                                        <input name="amout_people_s" id="validationDefault01" type="text"
                                            class="form-control onlyNumbers" placeholder="3">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-11 mx-auto col-sm-12 mt-3">
                                        <label for="floatingTextarea">Описание</label>
                                        <textarea name="description_s" id="validationDefault01" class="form-control"
                                            style="height: 100px;"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-11 mx-auto mt-2">
                                        <div class="msg none alert alert-primary alert-dismissible fade show mt-2 "
                                            role="alert">
                                            Валидация
                                        </div>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-lg-start justify-content-center mt-3 ">
                                    <button type="submit"
                                        class="btn btn-primary me-2 ms-lg-3 special-task-edit">Cохранить</button>
                                    <button type="reset" class="btn btn-secondary ubrat_input">Убрать</button>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justiful-content-center">

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"
            type="text/javascript"></script>
        <script src="assets/js/my_task.js"></script>
        <script src="assets/js/finished_task.js"></script>


    </main>
</body>