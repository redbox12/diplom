<?php 
    ob_start(); 
    include 'blocks/header.php';
    include 'blocks/side-menu.php';
?>


<body>
    <main id="main" class="main">

        <div class="container ">

            <?php 
        if(!isset($_SESSION['user'])){ //если пользователь не зарегистрирован

        echo ' <div class="row">

        <h1 class="mt-2">Привет, добрый прихожанин!😇</h1>
        <div class="col-lg-10 col-md-12  card mt-3">

            <div class="card-body ">
                <h5 class="card-title text-danger">Незарегистрированные пользователи не имеют доступа к полному
                    функцианалу
                    сайта.</h5>
                <p class="card-text">Пожалуйста зарегистрируйтесь или войдите.</p>
                <a href="pages-register.php" class="btn btn-primary">Регистрация</a>
                <a href="pages-login.php" class="btn btn-primary">Вход</a>
            </div>
        </div>


    </div>';



        } else{
            header('Location: users-profile.php');
            ob_end_flush();
        }
       
        ?>

        </div>

    </main>

</body>