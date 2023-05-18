<!-- Боковое меню 
-->
<?php

session_start();
?>
<aside id="sidebar" class="sidebar">


    <ul class="sidebar-nav" id="sidebar-nav">


        <?php 
        if(!isset($_SESSION['user'])){
             //если не зарегистрирован

           
            
            echo '<li class="nav-item">
            <a class="nav-link" href="pages-login.php">
                <i class="bi bi-grid"></i>
                <span>Список задач</span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link collapsed" href="pages-login.php">
                <i class="bi bi-clipboard"></i>
                <span>Мои задания</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-login.php">
                <i class="bi bi-person"></i>
                <span>Профиль</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-login.php">
                <i class="bi bi-envelope"></i>
                <span>Техническая поддержка</span>
            </a>
        </li><!-- End Contact Page Nav -->



        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-login.php">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Войти/Зарегистр...</span>
            </a>
        </li>
        <!-- End Login Page Nav -->
    </ul>';
    // ob_start();
    // header('Location:pages-login.php');
    // ob_end_flush();
    }
        
        if($_SESSION['user']['admin'] == 1){ //админ 
               // <li class="nav-item">
            //     <a class="nav-link collapsed" href="users-profile.php">
            //         <i class="bi bi-stickies"></i>
            //         <span>Шаблоны</span>
            //     </a>
            // </li>
            // <li class="nav-item">
            // <a class="nav-link collapsed"  href="pages-error-404.php">
            //     <i class="bi bi-grid"></i>
            //     <span>Список задач</span>
            // </a>
            // </li>
           
            echo '

            <li class="nav-item">
                <a class="nav-link collapsed" href="my_task_admin.php">
                    <i class="bi bi-clipboard"></i>
                    <span>Мои задачи</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="create_task.php">
                    <i class="bi bi-pencil-square"></i>
                    <span>Создать задачу</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-error-404.php">
                    <i style="font-size: 25px;" class="bx bxs-church"></i>
                    <span>Мой храм</span>
                </a>
            </li>

        

            <li class="nav-item">
                <a class="nav-link collapsed" href="users-profile.php">
                    <i class="bi bi-person"></i>
                    <span>Профиль</span>
                </a>
            </li>
          
                <li class="nav-item">
                    <a class="nav-link collapsed" href="pages-login.php">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Выйти из аккаунта</span>
                    </a>
                </li><!-- End Login Page Nav --> 
                </ul>';
            
        }  
        
        else if($_SESSION['user']['admin'] == 0 && isset($_SESSION['user'])){
            echo '<li class="nav-item">
            <a class="nav-link collapsed" href="tasks_catalog.php">
                <i class="bi bi-grid"></i>
                <span>Список задач</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="my_game.php">
                <i class="bi bi-clipboard"></i>
                <span>Мои задания</span>
            </a>
        </li>
       
        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>Профиль</span>
            </a>
        </li>
    
        </ul>';
    } 


    ?>


</aside><!-- End Sidebar-->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<script src="assets/js/jquery-3.6.4.min.js"></script>
<script src="assets/js/main.js"></script>