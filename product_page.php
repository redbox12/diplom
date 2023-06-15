<?php
include 'blocks/header.php';
include 'blocks/side-menu.php';
include 'forms/conect.php';

$id_task = $_POST['id_task'];
$type_task = $_POST['id_type'];
$id_human = $_POST['id_human'];

//Вывод участников заадания
if ($_SESSION['user']['admin'] == 1) {
    $result = mysqli_query($mysql, "SELECT * FROM `players` WHERE `id_task`='$id_task' AND `id_type`='$type_task' ");
    $all_people_otkl = array(); //массив в котором лежат все задачи
    $j = 0;
    while ($row = $result->fetch_assoc()) // получаем все строки в цикле по одной
    {
        $id_players = $row['id_human'];
        $result2 = mysqli_query($mysql, "SELECT * FROM `personal_date` WHERE `id`='$id_players'");
        if($result2){
            $result_people = $result2->fetch_assoc();
        
    
        $access; //уровень доступа
        if($result_people['normal'] == 1){
            $access = [ //доступ
                'access' => "Стандартный",
                'index_access' => 1
            ];
        }
        
        if($result_people['super_normal'] == 1){
            $access = [ //доступ
                'access' => "Особый",
                'index_access' => 2
            ];
        }
        
        if($result_people['limite_task'] == -1){
            $limite= 0; 
        }
        $all_people_otkl[]= '<tr class="text-lg-start text-center">
        <td>'.$result_people['name'].'</td>
        <td>'.$result_people['telephone'].'</td>
        <td>
        '.$access['access'].'
        </td>
        <td>
        '.$result_people['limite_task'].'
        </td>
        <td>
        <input type="hidden" id="id_task'.$j.'" name="id_task" value="'.$id_task.'">
        <input type="hidden" id="id_type'.$j.'" name="id_type" value="'.$type_task.'">
        <input type="hidden" id="id_human'.$j.'" name="id_human" value="'.$result_people['id'].'">
        <input type="hidden" id="name'.$j.'" name="name" value="'.$result_people['name'].'">
        <input type="hidden" id="limite_task'.$j.'" name="limite_task" value="'.$limite.'">
        <input type="hidden" id="level_access'.$j.'" name="level_access" value="'.$access['index_access'].'">
        <button class="btn btn-sm p-0 delete_people"><i class="bx bx-x-circle  mt-1"
                    style="font-size: 30px; color:#ff0000;"></i></button>
        </td>

    </tr>';

    $j++;
        }
        
    }
    
}

?>

<body>

    <main id="main" class="main">
        <div class="container ">

            <!-- Модальное окно для отклика и отказа от задачи -->

            <div class="modal fade" id="modal-response-task" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            <p class="msg-task"> </p>

                        </div>
                        <div class="modal-footer d-flex justiful-content-center">

                        </div>
                    </div>
                </div>
            </div>
            <!-- Модальное окно для завершения задачи -->
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

            <!-- Модальное окно для исключение пользователя -->

            <div class="modal fade" id="change-people" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Настройка уровня доступа и лимита
                            </h1>
                            <button type="button" class="btn-close close-setting" data-bs-dismiss="modal"
                                aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body setting-body-modal">
                            <div class="row mt-3">
                                <div class="col-sm-12 col-lg-11 mx-auto">
                                    <label for="inputNanme4" class="form-label">Пользователь</label>
                                    <input disabled type="text" name="name_modal" class=" form-control"
                                        value="Петя Королев">
                                </div>
                            </div>
                            <div class="row mt-3"">
                                <div class=" col-sm-12 col-lg-11 mx-auto">
                                <label for="inputNanme4" class="form-label">Действие</label>
                                <select name="level_access" class="form-select "
                                    aria-label="Пример выбора по умолчанию">
                                    <option value="1">
                                        Исключить
                                    </option>
                                    <option value="2">Заблокировать</option>
                                </select>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div
                                class="col-sm-12 col-lg-11 mx-auto d-flex justify-content-center justify-content-lg-start">
                                <button type="button" class="btn btn-primary save_setting2 me-2">Применить</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Закрыть</button>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justiful-content-center">

                    </div>
                </div>
            </div>
        </div>

        <section class="section profile">
            <div class="row">
                <?php
                if ($type_task == 1) { //вывод "Работ"
                  //забираем из БД всю инф-ию
                  include 'forms/templ/page_need_task.php';
                }

                if ($type_task == 2) { //вывод "Сбор средств"
                  //забираем из БД всю инф-ию
                  //echo 'Тут сбор средств!';
                  include 'forms/templ/page_material_task.php';
                }

                if ($type_task == 3) {
                    include 'forms/templ/page_special_task.php';
                }
                ?>
            </div>
            <!-- Таблица доступа -->

            <?php 
                            if ($_SESSION['user']['admin'] == 1 and $id_task != 2 and count($all_people_otkl)>= 1) {

                                echo '
                                <div class="row mt-2">

                                <div class="card col-lg-9 col-sm-12 ms-lg-2">
                                <div class="card-body ">
                                <div class="row">
                                <div class="col-12">
                                <h5 class="card-title">
                                <strong>Участники</strong>
                                </h5>
                                </div>
                                <div class="col-6 mt-3  text-end">

                                </div>
                                </div>
                                <div class="table-responsive-sm">
                                <table class="table table-sm">
                                <thead>
                                <tr class="text-lg-start text-center">
                                <th scope="col">Имя</th>
                                <th scope="col">Телефон</th>
                                <th scope="col">Доступ</th>
                                <th scope="col"> Лимит</th>
                                <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody class="table_users">';

                                foreach ($all_people_otkl as &$value) {
                                    echo $value;
                                }


                                echo '</tbody>
                                </table>
                                </div>
                                </div>
                                </div>
                                </div>';

                                }
                            
                            
                            
                            ?>





        </section>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"
            type="text/javascript"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/tasks_catalog.js"></script>
        <script src="assets/js/my_task.js"></script>
        <script src="assets/js/my_hram.js"></script>

    </main>

</body>
<!-- </html> -->