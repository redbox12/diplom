//вывод всех заданий 
/*
#modal-change-people - модалка с изменениями
.save_setting - кнопка сохранить изменения 
.access_level  - класс вывода из my_hram_back.php пользователей с доступом и лимитом
.edit_task  - кнопка изменить

*/
$(document).ready(function() { // Загрузка всех заданий
 
    $.ajax({
        url: 'forms/my_hram_back.php',
        type: 'POST',
        dataType: 'json',
            data: {
                all_people: 0,
            },
        success: function(data) {
            if (data.status){  
            console.log(data);
            data.people.forEach(function(people){   
                $('.table_people').append(people);      
            });
            $('#organizer').text(data.people_num_admin);
            $('#normal').text(data.people_num_normal);
            $('#special').text(data.people_num_super_normal);
            $('#ban').text(data.num_people_ban);
            
            
            } else{ //ошибки
                $('.table_people').append('Нет людей');
                console.log("Не пашет!");
            }
            
        }
    });

    

});
let id_human;
$(document).on( "click", ".table_people  .edit_task", function(e) {

    e.preventDefault();
    let i = $('.table_people  .edit_task').index(this);
    id_human = $(`input[id="id_human${i}"]`).val();
    let name = $(`input[id="name${i}"]`).val();
    let limite_task = $(`input[id="limite_task${i}"]`).val();
    let level_access = $(`input[id="level_access${i}"]`).val();
    

  
   
    console.log("------");
    console.log(i);
    console.log('id пипол: '+id_human);
    console.log('Уровень: '+level_access);
    console.log('Лимит: '+limite_task);
    console.log("------");

    $(`select[name="level_access"] option[value="${level_access}"]`).prop('selected', true);
    $(`input[name="limite_task_modal"]`).val(limite_task);
    $(`input[name="name_modal"]`).val(name);
    $('#modal-change-people').modal("toggle"); //вывод модального окна для измененения задачи
   
    // $(`select[name="clothes"] option[value=${data.clothes}]`).prop('selected', true);

   
});

$('.save_setting').click(function(e){
    e.preventDefault();
    let limite_task =  $(`input[name="limite_task_modal"]`).val(); //лимит по задачам
    let level_access = $('select[name="level_access"]').children("option:selected").val(); //уровень доступа

    console.log(limite_task);
    console.log(level_access);
    console.log(id_human);

    $.ajax({
        url: 'forms/my_hram_back.php',
        type: 'POST',
        dataType: 'json',
        data: {
            setting_people: true,
            id_human: id_human,
            limite_task: limite_task,
            level_access: level_access
        },
        success: function(data) {
            if (data.status){  
                console.log(data.message);
                $('.setting-body-modal').empty();

                $('.setting-body-modal').append('<div class="row mt-3"> <div class="mx-auto col-10 alert alert-primary" role="alert"> Изменения сохранены!</div></div><div class="row mt-3"> <div class="mx-auto col-10"> <button type="button" class="btn btn-danger close-setting" data-bs-dismiss="modal" aria-label="Закрыть">Закрыть</button> </div></div> ');
                //<button type="button" class="btn btn-secondary">Secondary</button>
               
                $('.close-setting').click(function(){
                    location.reload();
                });
                
            } else{ //ошибки
                // $('.table_people').append('Нет людей');
                console.log("Не пашет!");
            }
            
        }
    });

});


/* 
 
Исключить пользователя из задачи страница product_page
 
 */
let id_task_page; 
let id_type_page;
let id_human2;

$(document).on( "click", ".table_users  .delete_people", function(e) {

    e.preventDefault();
    let i = $('.table_users  .delete_people').index(this);
    id_task_page = $(`input[id="id_task${i}"]`).val();
    id_type_page = $(`input[id="id_type${i}"]`).val();
    id_human2 = $(`input[id="id_human${i}"]`).val();
    let name = $(`input[id="name${i}"]`).val();
    let limite_task = $(`input[id="limite_task${i}"]`).val();
    let level_access = $(`input[id="level_access${i}"]`).val();
    

  
   
    console.log("------");
    console.log(i);
    console.log('id пипол: '+id_human2);
    console.log('Уровень: '+level_access);
    console.log('Лимит: '+limite_task);
    console.log("------");

    //$(`select[name="level_access"] option[value="${level_access}"]`).prop('selected', true);
    $(`input[name="limite_task_modal"]`).val(limite_task);
    $(`input[name="name_modal"]`).val(name);

    $('#change-people').modal("toggle"); 
});

//кнопка исключить пользователя
$('.save_setting2').click(function(e){

    e.preventDefault();
    let level_access = $('select[name="level_access"]').children("option:selected").val(); //уровень доступа
    console.log(level_access);

    
    console.log("---------------");
    console.log(id_task_page);
    console.log(id_type_page);
    console.log(id_human2);
    console.log(level_access);
    console.log("---------------");

    $.ajax({
        url: 'forms/delete_user_page.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id_human: id_human2,
            id_task: id_task_page,
            id_type: id_type_page,
            level_access: level_access
        },
        success: function(data) {
            if (data.status){  
                console.log(data.message);
                $('.setting-body-modal').empty();

                $('.setting-body-modal').append('<div class="row mt-3"> <div class="mx-auto col-10 alert alert-primary" role="alert"> Изменения сохранены!</div></div><div class="row mt-3"> <div class="mx-auto col-10"> <button type="button" class="btn btn-danger close-setting" data-bs-dismiss="modal" aria-label="Закрыть">Закрыть</button> </div></div> ');
                //<button type="button" class="btn btn-secondary">Secondary</button>
               
                $('.close-setting').click(function(){
                    location.reload();
                });
                
            } else{ //ошибки
                // $('.table_people').append('Нет людей');
                console.log("Не пашет!");
            }
            
        }
    });

});