<?php
include 'blocks/header.php'; //подключение шапки
include 'forms/conect.php';
?>

<body>
    <main id="main" class="main">
        <?php
        include 'blocks/side-menu.php'; //боковое меню
        ?>
        <div class="container ">
            <h1> Создать задание </h1>
            <div class="row mt-3 d-flex justify-content-lg-start justify-content-sm-center">
                <div class="col-lg-8 col-md-12 ">
                    <div class="card-body ">
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
                                    aria-controls="pills-contact" aria-selected="false">Особое поручение</button>
                            </li>

                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="pills-home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="card-body">
                                    <div class="col-12 border-warning ">
                                    </div>
                                    <!-- Vertical Form -->
                                    <button type="button" class="btn btn-success mt-2 mb-3 pe-4">
                                        <i class="bi bi-stickies-fill mt-5"></i>
                                        Использовать
                                        шаблон</button>

                                    <!-- Форма необходимой помощи -->
                                    <form>
                                        <div class="col-sm-12 col-lg-6">
                                            <label for="inputNanme4" class="form-label">Название задания</label>
                                            <input type="text" class="form-control" style="width: 98%;" name="name"
                                                id="1">
                                        </div>

                                        <div class="col-sm-12 col-lg-3">
                                            <label for="inputDate" class="col-sm-6 col-form-label">
                                                Дата проведения</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="date">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-lg-3 mt-3">
                                            <label for="inputTime" class="col-sm-6col-form-label">Время
                                                проведения</label>
                                            <div class="col-sm-10">
                                                <input type="time" id="validationDefault01" class="form-control"
                                                    name="time">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-lg-8 mt-3">
                                            <label for="inputAddress" class="form-label">Одежда</label>
                                            <select id="inputState" class="form-select clothes">
                                                <option selected="">Выбрать...</option>
                                                <option value="1">Обычная</option>
                                                <option value="2">Рабочая</option>
                                            </select>
                                        </div>

                                        <div class=" col-sm-12 col-lg-8 mt-3">
                                            <label for="inputAddress" class="form-label">Кол-во человек</label>
                                            <input name="amout_people" id="validationDefault01" type="text"
                                                class="form-control">
                                        </div>

                                        <div class="col-sm-12 col-lg-8 mt-3">
                                            <label for="floatingTextarea">Описание</label>
                                            <textarea name="description" id="validationDefault01" class="form-control"
                                                style="height: 100px;"></textarea>
                                        </div>
                                        <div class="col-sm-12 col-lg-8 mt-3">
                                            <label>Фотография для задания</label>
                                            <input name="avatar" type="file" class="form-control">
                                        </div>
                                        <p class="msg none small mb-0 text-warning">
                                        </p>
                                        <div class="d-flex justify-content-start mt-3">
                                            <button type="submit"
                                                class="btn btn-primary me-2 need-task">Создать</button>
                                            <button type="reset" class="btn btn-secondary">Убрать</button>
                                        </div>
                                    </form><!-- Vertical Form -->

                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="profile-tab">
                                Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia.
                                Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi
                                quia
                                distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut laboriosam
                                voluptatum dicta.
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="contact-tab">
                                Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque.
                                Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit
                                molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="assets/js/create_task.js"></script>

    </main>
</body>

</html>