<?php 
session_start();
if($_SESSION['user']){
    header('Location: users-profile.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pages / Register - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href=".../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Прихожанин</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Создать новый аккаунт</h5>
                                        <p class="text-center small">Введите свои личные данные, чтобы создать
                                            учетную
                                            запись</p>
                                    </div>

                                    <form>

                                        <div class=" col-12">
                                            <label for="yourName" class="form-label">Ваше имя</label>
                                            <input type="text" name="full_name" class="form-control m-0" id="yourName"
                                                placeholder="Иван Иванов" required>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <label for="yourEmail" class="form-label">Ваш номер телефона</label>
                                            <input type="tel" name="telephone" class="form-control" id="yourTelephone"
                                                placeholder="8 (999) 999-99-99">

                                        </div>


                                        <div class="col-12 mt-2">
                                            <label for="yourPassword" class="form-label">Пароль</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Пароль" required>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <label for="yourPassword" class="form-label">Пароль</label>
                                            <input type="password" name="password_confirm" class="form-control"
                                                placeholder="Подтвердите пароль" required>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox" value=""
                                                    id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">Я согласен и
                                                    принимаю <a href="#">условия</a></label>
                                                <div class="invalid-feedback">You must agree before submitting.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-primary w-100 register-bat" type="submit">Создать
                                                аккаунт</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">У вас уже есть аккаунт? <a
                                                    href="pages-login.php">Войти</a>
                                            </p>
                                        </div>

                                        <div class="col-12">
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