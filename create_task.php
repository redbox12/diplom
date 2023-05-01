<?php
include 'blocks/header.php'; //подключение шапки
include 'forms/conect.php';
?>

<body>
    <main id="main" class="main">
        <section class="section">
            <?php include 'blocks/side-menu.php'; //боковое меню ?>
            <div class="container">
                <h1> Создать задание </h1>
                <div class=" row mt-5 ">
                    <div class="col-lg-8 col-md-12 card">
                        <div class="card-body mt-5">

                            <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true" tabindex="-1" name="need-task">Необходимая помощь</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false" tabindex="-1">Материальная
                                        помощь</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Особое
                                        поручение</button>
                                </li>

                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="pills-home" role="tabpanel"
                                    aria-labelledby="home-tab">

                                    <!-- для скрытия использую id="task-need" -->
                                    <div class="card-body task-need">

                                        <!-- Vertical Form -->
                                        <!-- <button type="button" class="btn btn-success mt-2 mb-3 pe-4">
                                            <i class="bi bi-stickies-fill mt-5"></i>
                                            Использовать
                                            шаблон</button> -->

                                        <!-- Форма необходимой помощи -->
                                        <form class="task-need-form">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-6">
                                                    <label for="inputNanme4" class="form-label">Название
                                                        задания</label>
                                                    <input type="text" class="form-control" style="width: 98%;"
                                                        name="name" id="1" placeholder="Помыть пол в храме">
                                                </div>
                                            </div>

                                            <div class="row d-flex justify-content-start mt-3">
                                                <div class="col-lg-3 col-sm-6">
                                                    <label for="inputDate" class="col-form-label">
                                                        Дата проведения</label>
                                                    <input type="date" class="form-control" name="date">

                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <label for="inputTime" class="col-form-label">Время
                                                        проведения</label>
                                                    <input type="time" id="validationDefault01" class="form-control"
                                                        name="time">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 mt-3">
                                                    <label for="inputAddress" class="form-label">Продолжительность
                                                    </label>
                                                    <input name="time_length" class="form-control onlyNumbers"
                                                        placeholder="20 мин">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 mt-3">
                                                    <label for="inputAddress" class="form-label">Одежда</label>
                                                    <select name="clothes" id="inputState" class="form-select clothes">
                                                        <option selected="">Выбрать...</option>
                                                        <option value="1">Обычная</option>
                                                        <option value="2">Рабочая</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 mt-3">
                                                    <label for="inputAddress" class="form-label">Кол-во
                                                        человек</label>
                                                    <input name="amout_people" id="validationDefault01" type="text"
                                                        class="form-control" placeholder="3">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 mt-3">
                                                    <label for="floatingTextarea">Описание</label>
                                                    <textarea name="description" id="validationDefault01"
                                                        class="form-control" style="height: 100px;"></textarea>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 mt-3">
                                                    <label>Фотография для задания</label>
                                                    <input name="avatar" type="file" class="form-control">
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="msg none alert alert-warning alert-dismissible fade show mt-2 "
                                                        role="alert">
                                                        A simple warning alert—check it out!
                                                    </div>
                                                </div>

                                            </div>

                                            <div
                                                class="d-flex justify-content-lg-start justify-content-sm-center mt-3 ">
                                                <button type="submit"
                                                    class="btn btn-primary me-2 need-task">Создать</button>
                                                <button type="reset" class="btn btn-secondary ubrat">Убрать</button>

                                            </div>
                                        </form><!-- Vertical Form -->

                                        <div class="col-sm-6 task-need-win none">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Задание создано!</h4>

                                                    <a href="my_task_admin.php" class="btn btn-primary">Перейти
                                                        в мои задания</a>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <!-- Форма материальной помощи -->
                                <div class=" tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <!-- <button type="button" class="btn btn-success mt-2 mb-3 pe-4">
                                        <i class="bi bi-stickies-fill mt-5"></i>
                                        Использовать
                                        шаблон</button> -->

                                    <form class="task-mtrl-form">
                                        <div class="col-sm-12 col-lg-6">
                                            <label for="inputNanme4" class="form-label">Название</label>
                                            <input type="text" class="form-control" style="width: 98%;" name="name_mtrl"
                                                placeholder="Ремонт храма">
                                        </div>
                                        <div class="row d-flex justify-content-start mt-2">
                                            <div class="col-lg-3 col-sm-6">
                                                <label for="inputDate" class=" col-form-label">
                                                    Дата начало</label>
                                                <input type="date" class="form-control" name="date_start_mtrl">
                                            </div>

                                            <div class="col-lg-3 col-sm-6 ">
                                                <label for="inputDate" class="col-form-label">
                                                    Дата окончания</label>

                                                <input type="date" class="form-control" name="date_end_mtrl">

                                            </div>

                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label">Номер телефона для
                                                    перевода</label>
                                                <input type="tel" name="telephone_mtrl" class="form-control"
                                                    placeholder="8 (925) 086-86-37" value="" id="yourTelephone">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label">Номер карты для перевода</label>

                                                <input type="text" class="mask-card-number form-control"
                                                    placeholder="9999 9999 9999 9999" name="card_mtrl" value="">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label">Сумма денег</label>
                                                <input name="summ_den_mtrl" type="text" class="form-control"
                                                    placeholder="2000 р." value="">
                                            </div>
                                        </div>
                                        <div class=" row">
                                            <div class="col-sm-12 col-lg-6 mt-3">
                                                <label for="floatingTextarea">Описание</label>
                                                <textarea name="description_mtrl" class=" form-control"
                                                    style="height: 100px;"></textarea>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-6 mt-3">
                                                <label>Фотография для задания</label>
                                                <input name="avatar2" type="file" class="form-control">
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="msg2 none alert alert-warning alert-dismissible fade show mt-2 "
                                                    role="alert">
                                                    Валидация полей
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-start mt-3">
                                            <button type="submit"
                                                class="btn btn-primary me-2 mtrl-task">Создать</button>
                                            <button type="reset" class="btn btn-secondary ubrat">Убрать</button>
                                        </div>
                                    </form>

                                    <div class="col-sm-6 task-mtrl-win none">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Задание создано!</h4>

                                                <a href="my_task_admin.php" class="btn btn-primary">Перейти
                                                    в мои задания</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Форма особое поручение -->
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="contact-tab">

                                    <form class="task-special-form">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-6">
                                                <label class="form-label">Название
                                                    задания</label>
                                                <input type="text" class="form-control" style="width: 98%;"
                                                    name="name_special" placeholder="Помыть алтарь">
                                            </div>
                                        </div>

                                        <div class=" row d-flex justify-content-start mt-3">
                                            <div class="col-lg-3 col-sm-6">
                                                <label for="inputDate" class="col-form-label">
                                                    Дата проведения</label>
                                                <input type="date" class="form-control" name="date_special">

                                            </div>
                                            <div class="col-lg-3 col-sm-6">
                                                <label for="inputTime" class="col-form-label">Время
                                                    проведения</label>
                                                <input type="time" id="validationDefault01" class="form-control"
                                                    name="time_special">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12 mt-3">
                                                <label for="inputAddress" class="form-label">Продолжительность
                                                </label>
                                                <input name="time_length_special" class="form-control onlyNumbers"
                                                    placeholder="20 мин">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12 mt-3">
                                                <label for="inputAddress" class="form-label">Одежда</label>
                                                <select name="clothes_special" id="inputState"
                                                    class="form-select clothes_special">
                                                    <option selected="">Выбрать...</option>
                                                    <option value="1">Обычная</option>
                                                    <option value="2">Рабочая</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12 mt-3">
                                                <label for="inputAddress" class="form-label">Кол-во
                                                    человек</label>
                                                <input name="amout_people_special" type="text" class="form-control"
                                                    placeholder="2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12 mt-3">
                                                <label for="floatingTextarea">Описание</label>
                                                <textarea name="description_special" class="form-control"
                                                    style="height: 100px;"></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12 mt-3">
                                                <label>Фотография для задания</label>
                                                <input name="avatar3" type="file" class="form-control">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="none msg3 alert alert-warning alert-dismissible fade show mt-2 "
                                                    role="alert">
                                                    A simple warning alert—check it out!
                                                </div>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-lg-start justify-content-sm-center mt-3 ">
                                            <button type="submit"
                                                class="btn btn-primary me-2 task-special">Создать</button>
                                            <button type="reset" class="btn btn-secondary ubrat">Убрать</button>

                                        </div>

                                    </form>

                                    <div class="col-sm-6 task-special-win none">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Задание создано!</h4>

                                                <a href="my_task_admin.php" class="btn btn-primary">Перейти
                                                    в мои задания</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Для формы даты -->



                <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"
                    type="text/javascript"></script>
                <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
                <script src="assets/js/create_task.js"></script>

        </section>

    </main>
</body>

</html>