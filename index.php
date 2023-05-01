<?php 
  include 'blocks/header.php';
//  \\ if(!isset($_SESSION['user'])){ //если пользователь не зарегистрирован
    
//   }
  include 'blocks/side-menu.php';
?>


<body>
    <main id="main" class="main">

        <div class="container ">
            <div class="row">

                <h1>Привет, в мир помощи 🌍 </h1>
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Незарегистрированные пользователи не имеют доступа к полному функцианалу
                            сайта.</h5>
                        <p class="card-text">Пожалуйста зарегистрируйтесь или войдите.</p>
                        <a href="pages-register.php" class="btn btn-primary">Регистрация</a>
                        <a href="pages-login.php" class="btn btn-primary">Вход</a>
                    </div>
                </div>


            </div>
        </div>

    </main>

</body>