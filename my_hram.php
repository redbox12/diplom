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

?>

<body>
    <main id="main" class="main">
        <div class="container ">
            <h1> Мой храм </h1>
            <div class="row mt-3">
                <div class="col-lg-3 col-md-7 col-sm-12">
                    <div class="card p-0">
                        <div class="card-body p-0 text-center">
                            <img src="assets/img/hram.png" class="hram img-fluid mt-lg-2  p-md-4" style="width: 90%;"
                                lt="...">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-5 col-sm-12">
                    <div class="card response description">
                        <div class="card-body  justify-content-center ps-5">
                            <h4 class=" text-center mt-3"><strong>Описание</strong></h4>

                            <dl class="row pt-3 ">
                                <dt class="col-lg-4 col-sm-3">Название:</dt>
                                <dd class="col-lg-8 col-sm-9">Храм Георгия победоносца </dd>

                                <dt class="col-lg-4 col-sm-3">Андрес:</dt>
                                <dd class="col-lg-8 col-sm-9"> г. Химки, ул.Лесная д.10</dd>

                                <dt class="col-lg-4 col-sm-3">Настоятель:</dt>
                                <dd class="col-lg-8 col-sm-9"> иерей Виктор Влашко</dd>
                            </dl>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="d-flex justify-content-lg-start justify-content-center ms-lg-3 ">
                    <h3><strong>Помошники</strong> </h3>
                </div>
            </div>

            <div class="row mt-2">
                <div class="ms-lg-3 col-sm-11">
                    <ul class="list-group list-group-horizontal-md ">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Организатор
                            <span id="organizer" class="badge bg-primary rounded-pill ms-lg-2">--</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Стандартный
                            <span id="normal" class="badge bg-primary rounded-pill ms-lg-2">--</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Особый
                            <span id="special" class="badge bg-primary rounded-pill ms-lg-2">--</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Заблокированный
                            <span id="ban" class="badge bg-primary rounded-pill ms-lg-2">--</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row mt-4">

                <div class="card col-lg-9 col-sm-12 ms-lg-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title">
                                    <strong>Пользователи</strong>
                                </h5>
                            </div>
                            <div class="col-6 mt-3  text-end">

                            </div>
                        </div>


                        <!-- Таблица доступа -->
                        <div class="table-responsive-sm">
                            <table class="table table-sm">
                                <thead>
                                    <tr class="text-lg-start text-center">
                                        <th scope="col">Имя</th>
                                        <th scope="col">Телефон</th>
                                        <th scope="col">Доступ</th>
                                        <th scope="col">Лимит</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="table_people">


                                </tbody>
                            </table>
                        </div>
                        <!-- End small tables -->

                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-change-people" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    <input disabled type="text" name="name_modal" class=" form-control form-select-sm"
                                        value="Петя Королев">
                                </div>
                            </div>
                            <div class="row mt-3"">
                                <div class=" col-sm-12 col-lg-11 mx-auto">
                                <label for="inputNanme4" class="form-label">Уровень доступа </label>
                                <select name="level_access" class="form-select form-select-sm "
                                    aria-label="Пример выбора по умолчанию">
                                    <option value="1">
                                        Стандартный
                                    </option>
                                    <option value="2">Особый
                                    </option>
                                    <option value="3">Организатор</option>
                                    <option value="4">Заблокированный</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12 col-lg-11 mx-auto">
                                <label for="inputNanme4" class="form-label">Лимит</label>
                                <input type="text" name="limite_task_modal" class=" form-control form-select-sm">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div
                                class="col-sm-12 col-lg-11 mx-auto d-flex justify-content-center justify-content-lg-start">
                                <button type="button" class="btn btn-success save_setting">Сохранить</button>

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer d-flex justiful-content-center">

                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/my_hram.js">
    </script>
</body>