<?php
include 'blocks/header.php'; //подключение шапки
include 'forms/conect.php';
?>

<body>
    <main id="main" class="main">
        <?php
        if(!isset($_SESSION['user'])){
            
        }
        include 'blocks/side-menu.php'; //боковое меню
        ?>
        <div class="container">
            <div class="row">
                <h1> Каталог </h1>
                <?php include 'catalog/search.php'; // строка поиска ?>
            </div>

            <!-- <div class="row row-cols-3 pt-2"> -->
            <div class="row ">
                <?php include 'catalog/out_all_card.php'; //вывод все карты настолок ?>
            </div>

    </main>
</body>

</html>