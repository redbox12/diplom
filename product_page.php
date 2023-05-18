<?php
include 'blocks/header.php';
include 'blocks/side-menu.php';
include 'forms/conect.php';

$id_task = $_POST['id_task'];
$type_task = $_POST['id_type'];
$id_human = $_POST['id_human'];







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
            </section>
        </div>




        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/tasks_catalog.js"></script>
        <script src="assets/js/my_task.js"></script>
    </main>

</body>
<!-- </html> -->