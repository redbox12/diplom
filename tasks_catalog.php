<?php
include 'forms/conect.php';
include 'blocks/header.php'; //подключение шапки
include 'blocks/side-menu.php'; //боковое меню

?>

<body>
    <main id="main" class="main">
        <div class="container ">
            <div class="row ">
                <h1 class=""> Список задач </h1>
            </div>

            <div class="row mt-4" id="my-static">
                <div class="col ms-2">
                    <h5><span class="badge text-light py-2 px-2 btn limite" style="background: #3b9a9c;"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Это число обозначает количество заданий, которые вы можете взять"><i
                                class="bi bi-lightning-charge" style="color: white;"></i>
                            Лимит задач: <span
                                class="badge bg-white text-secondary limite_number"><?php echo $_SESSION['user']['limite_task']?>
                            </span></span>
                    </h5>
                </div>

            </div>

            <div class="row mt-lg-2 mt-sm-1">
                <div class="ms-lg-2 col-lg-2 col-sm-12 mt-3">
                    <button type="button" id="all" class="btn btn-primary btn-lg me-lg-3" value="0" style="width: 98%;">
                        Все задачи</button>
                </div>

                <div class=" ms-lg-2 col-lg-2 col-sm-12 mt-3">
                    <button type="button" id="need" class="btn btn-primary btn-lg me-lg-3 " value="1"
                        style="width: 98%;"> Работы</button>
                </div>

                <div class="ms-lg-2 col-lg-2 col-sm-12 mt-3">
                    <button type="button" id="mtrl" class="btn btn-primary btn-lg me-lg-3 ps-lg-2 " value="2"
                        style="width: 98%;">Сбор средств</button>
                </div>
                <div class="ms-lg-2 col-lg-3 col-sm-12 mt-3"><?php if($_SESSION['user']['super_normal'] == 1)
                    echo '  
                            <button type="button" id="special" class="btn btn-primary btn-lg" value="3"  style="width: 98%;">Особые
                        поручения</button>';
                    ?>
                </div>
                <form>
                </form>


            </div>

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



            <div class="row mt-4" id="my-task">
                <h4 class="ms-md-4"> </h4>
            </div>



            <div class="row mt-4" id="task-card">
                <h4 class="ms-md-4">Cвободные задачи</h4>
                <!-- Вывод заданий -->

            </div>





        </div>

    </main>


    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/tasks_catalog.js"></script>
</body>

</html>