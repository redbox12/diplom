<?php 
session_start();
// if(!$_SESSION['user']){
//     header('Location: pages-register.php');
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Авторизация</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.php" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Прихожанин</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">
                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Войди в свой аккаунт</h5>
                                        <p class="text-center small">Введите номер телефона и пароль для входа</p>
                                    </div>


                                    <form>
                                        <div class="col-12">
                                            <label class="form-label">Номер телефона</label>
                                            <div class="input-group has-validation">
                                                <input type="tel" name="telephone" class="form-control"
                                                    id="yourTelephone" placeholder="89250868637" required>
                                                <div class="invalid-feedback">Пожалуйста введите ваш номер.</div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="yourPassword" class="form-label">Пароль</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" placeholder="Пароль" required>
                                            <div class="invalid-feedback">Пожалуйста, введите ваш пароль!</div>
                                        </div>
                                        <div class="col-12">
                                            <!-- <button class="btn btn-primary w-100 mt-3" type="submit">Вход</button> -->
                                            <button class="login-btn btn btn-primary w-100 mt-3"
                                                type="submit">Вход</button>

                                        </div>
                                        <div class="col-12 mt-2">
                                            <p class="small mb-0">У вас нет аккаунта? <a
                                                    href="pages-register.php">Создать
                                                    аккаунт</a></p>

                                        </div>
                                        <div class="col-12 border-warning ">

                                            <p class="msg none small mb-0 text-warning">
                                                Test 125
                                            </p>
                                        </div>
                                    </form>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"
        type="text/javascript"></script>
    <script src="assets/js/main2.js"></script>

</body>

</html>