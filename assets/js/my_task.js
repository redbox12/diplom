//форма для набора только цифр
$(".onlyNumbers").bind("change keyup input click", function() {
    if (this.value.match(/[^0-9]/g)) {
    this.value = this.value.replace(/[^0-9]/g, '');
    }
}); 

//курсор в начало при заполнение банковской карты
$.fn.setCursorPosition = function(pos) {
    if ($(this).get(0).setSelectionRange) {
      $(this).get(0).setSelectionRange(pos, pos);
    } else if ($(this).get(0).createTextRange) {
      var range = $(this).get(0).createTextRange();
      range.collapse(true);
      range.moveEnd('character', pos);
      range.moveStart('character', pos);
      range.select();
    }
  };
//форма для карты
  $('.mask-card-number').click(function(){
    $(this).setCursorPosition(0);
  }).mask('9999 9999 9999 9999');


//сброс фильтров
$('.ubrat').click(function(){
    $(".task_card").remove(); //удалем повтор
    $.ajax({
        url: 'forms/my_task_admin_back.php',
        type: 'POST',
        dataType: 'json',
        data: {
            type_task: 0,
        },
        success: function(data) {
            if (data.status){  
                if(data.type == 0){ //вывод всех задач без даты
                    console.log(data);
                    data.task.forEach(function(task){   
                        $('#task-card').append('<div class="col-lg-5 col-md-12 mb-1 ms-lg-3 mt-2 task_card">'+ task + '</div>');
                });

                }
             
            } else{ //ошибки
            
            if (data.type == 0.1) { //если не имеется никакой задачи на дату
                $('#task-card').append('<div class="col-lg-10 col-md-12 mb-1 ms-lg-3 mt-2 task_card">'+ 
                '<div class="alert alert-warning alert-dismissible fade show" role="alert"> <strong>'+ data.message + 
                    '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button> </div> </div>');
            }


                console.log("Не пашет!");
            }
            
        }
    });
});

//вывод всех заданий 
$(document).ready(function() { // Загрузка всех заданий

    
 
    $.ajax({
        url: 'forms/my_task_admin_back.php',
        type: 'POST',
        dataType: 'json',
        data: {
            type_task: 0,
        },
        success: function(data) {
            if (data.status){  
                if(data.type == 0){ //вывод всех задач без даты
                    console.log(data);
                    data.task.forEach(function(task){   
                        $('#task-card').append('<div class="col-lg-5 col-md-12 mb-1 ms-lg-3 mt-2 task_card">'+ task + '</div>');
                });

                }
             
            } else{ //ошибки
            
            if (data.type == 0.1) { //если не имеется никакой задачи на дату
                $('#task-card').append('<div class="col-lg-10 col-md-12 mb-1 ms-lg-3 mt-2 task_card">'+ 
                '<div class="alert alert-warning alert-dismissible fade show" role="alert"> <strong>'+ data.message + 
                    '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button> </div> </div>');
            }


                console.log("Не пашет!");
            }
            
        }
    });

    

});


 $(".filter-task").on('click', function (e) { 

    e.preventDefault();
    let type_task = $('select.type-task').children("option:selected").val();
    let date_task = $('input[name="date_task"]').val();
    $(".task_card").remove(); //удалем повтор

    $.ajax({
        url: 'forms/my_task_admin_back.php',
        type: 'POST',
        dataType: 'json',
        data: {
            type_task: type_task,
            date_task: date_task
        },
        success: function(data) {
            if (data.status){  
                if(data.type == 0){ //вывод всех задач без даты
                    console.log(data);
                    data.task.forEach(function(task){   
                        $('#task-card').append('<div class="col-lg-5 col-md-12 mb-1 ms-lg-3 mt-2 task_card">'+ task + '</div>');
                });

                }
             
            } else{ //ошибки
            
            if (data.type == 0.1) { //если не имеется никакой задачи на дату
                $('#task-card').append('<div class="col-lg-10 col-md-12 mb-1 ms-lg-3 mt-2 task_card">'+ 
                '<div class="alert alert-warning alert-dismissible fade show" role="alert"> <strong>'+ data.message + 
                    '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button> </div> </div>');
            }


                console.log("Не пашит!");
            }
            
        }
    });

   
});

//Завершение задачи
$(document).on( "click", ".delete  .finished-task", function(e) {
    e.preventDefault();
    let i = $('.delete .finished-task').index(this);
    let id_task = $(`input[id="id_task${i}"]`).val();
    let id_type = $(`input[id="id_type${i}"]`).val();
   
    console.log("------");
    console.log(i);
    console.log(id_task);
    console.log(id_type);

    $('#modal-delete-task').modal("toggle");

    $('.btn-finished').click(function(){
        $.ajax({
            url: 'forms/finished_task.php',
            type: "POST",
            dataType: 'json',
            data: {
                type_task: id_type,
                id_task: id_task
            },
            success: function(data) {
                if(data.status){
                    console.log(data.message);
                    $('.modal-body-delete').empty();
    
                    $('.modal-body-delete').append('<div class="row mt-3"> <div class="mx-auto col-10 alert alert-primary" role="alert"> '+ data.message+'</div></div><div class="row mt-3"> <div class="mx-auto col-10"> <button type="button" class="btn btn-danger close-setting" data-bs-dismiss="modal" aria-label="Закрыть">Закрыть</button> </div></div> ');
                    //<button type="button" class="btn btn-secondary">Secondary</button>
                   
                    $('.close-setting').click(function(){
                        location.reload();
                    });
                    
                } else{ //ошибки
                    console.log("Не пашет!");
                    $('.modal-body-delete').empty();
    
                    $('.modal-body-delete').append('<div class="row mt-3"> <div class="mx-auto col-10 alert alert-warning" role="alert">'+ data.message+'</div></div><div class="row mt-3"> <div class="mx-auto col-10"> <button type="button" class="btn btn-danger close-setting" data-bs-dismiss="modal" aria-label="Закрыть">Закрыть</button> </div></div> ');

                    $('.close-setting').click(function(){
                        location.reload();
                    });
                }
            }
        });
    });
    
    
  });

//кнопка убрать в модальном окне "Редактирование задачу"
  $('.ubrat_input').click(function(){
    $(`input[name="name"]`).val('');
    $(`input[name="date"]`).val('');
    $(`input[name="time"]`).val('');
    $(`input[name="time_length"]`).val('');
    $(`select[name="clothes"]`).val('Выбрать...') ;
    $(`input[name="amout_people"]`).val('');
    $(`textarea[name="description"]`).val('');

    $(`input[name="name_mtrl"]`).val('');
    $(`input[name="date_start"]`).val('');
    $(`input[name="date_end"]`).val('');
    $(`input[name="card_mtrl"]`).val('');
    $(`input[name="summ_den_mtrl"]`).val('');
    $(`textarea[name="description_mtrl"]`).val('');

    // $(`input`).val('');
    // $(`select[name="clothes"]`).val('Выбрать...') ;
    // $(`textarea`).val('');
});

//Редактирование задачу
$(document).on( "click", ".delete  .edit_task", function(e) {
    e.preventDefault();
    let i = $('.delete .edit_task').index(this);
    let id_task = $(`input[id="id_task${i}"]`).val();
    let id_type = $(`input[id="id_type${i}"]`).val();
    
    $(`input`).removeClass("border-danger");
    $(`textarea`).removeClass("border-danger");
    $(`select`).removeClass("border-danger");
    $('.msg').addClass('none')

   
    console.log("------");
    console.log(i);
    console.log(id_task);
    console.log(id_type);

    if(id_type == 1){
        let get_need_task = true; //запрос на данные по "Работы"
        $('#modal-edit-task-1').modal("toggle"); //вывод модального окна для измененения задачи
        
        // Загрузка кружок

        $.ajax({
                url: 'forms/edit_and_delete_task_admin.php',
                type: "POST",
                dataType: 'json',
                data: {
                    type_task: id_type,
                    id_task: id_task,
                    get_need_task: get_need_task    
                },
                success: function(data) {
                    if(data.status){
                        $(`input[name="name"]`).val(data.name);
                        $(`input[name="date"]`).val(data.date);
                        $(`input[name="time"]`).val(data.time);
                        $(`input[name="time_length"]`).val(data.time_length);
                        $(`select[name="clothes"] option[value=${data.clothes}]`).prop('selected', true);
                        $(`input[name="amout_people"]`).val(data.people_amout);
                        $(`textarea[name="description"]`).val(data.description);
                       }
                }
        
            });

            $('.need-task-edit').on( "click", function(e) {
                e.preventDefault();
                let need_edit_task = true;
    
                $(`input`).removeClass("border-danger");
                $(`textarea`).removeClass("border-danger");
                $(`select`).removeClass("border-danger");
            
                
            
                let name = $('input[name="name"]').val();
                let date = $('input[name="date"]').val();
                let time = $('input[name="time"]').val();
                let time_length = $('input[name="time_length"]').val();
                let clothes = $('select.clothes').children("option:selected").val();
                let amout_people = $('input[name="amout_people"]').val();
                let description = $('textarea[name="description"]').val();
                
            
                let formData = new FormData();
                formData.append('id_task', id_task);
                formData.append('name', name);
                formData.append('date', date);
                formData.append('time', time);
                formData.append('time_length', time_length);
                formData.append('clothes', clothes);
                formData.append('amout_people', amout_people);
                formData.append('description', description);
               
                formData.append('need_edit_task', need_edit_task);
            
            
                $.ajax({
                    url: 'forms/edit_and_delete_task_admin.php',
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    cashe: false,
                    data: formData,
                    success: function(data) {
                        if (data.status){
                            console.log('Все ок');
                            $('.msg').removeClass('none').text(data.message); 
                            setTimeout("location.reload();", 900);
                            // $('.task-need-form').addClass('none'); 
                            // $('.task-need-win').removeClass('none'); //сообщение задание успешно создано
                          
                         
                        } else{
                            console.log('не работает');
                            if(data.type === 1){
                                data.fields.forEach(function(field){
                                     $(`input[name="${field}"]`).addClass("border-danger");
                                     $(`textarea[name="${field}"]`).addClass("border-danger");
                                     $(`select[name="${field}"]`).addClass("border-danger");
                                });  
            
            
                            }
                            $('.msg').removeClass('none').text(data.message); //
                        }
                    }
            
            
            
                }); 

               
            });
    }

    if(id_type == 2){
        let get_mtrl_task = true; //запрос на данные по "Работы"
        $('#modal-edit-task-2').modal("toggle"); //вывод модального окна для измененения задачи
        
        // Загрузка кружок

        $.ajax({
                url: 'forms/edit_and_delete_task_admin.php',
                type: "POST",
                dataType: 'json',
                data: {
                    type_task: id_type,
                    id_task: id_task,
                    get_mtrl_task: get_mtrl_task    
                },
                success: function(data) {
                    if(data.status){
                        $(`input[name="name_mtrl"]`).val(data.name_mtrl);
                        $(`input[name="date_start"]`).val(data.date_start);
                        $(`input[name="date_end"]`).val(data.date_end);
                        $(`input[name="card_mtrl"]`).val(data.card_bank);
                        $(`input[name="summ_den_mtrl"]`).val(data.summ_deneg);
                        $(`textarea[name="description_mtrl"]`).val(data.description_mtrl);
                       }
                }
        
            });

            $('.mtrl-task-edit').on( "click", function(e) {
                e.preventDefault();
                let mtrl_edit_task = true;
                console.log('Нажал на кнопку');
    
                $(`input`).removeClass("border-danger");
                $(`textarea`).removeClass("border-danger");

            
                
            
                let name_mtrl = $('input[name="name_mtrl"]').val();
                let date_start = $('input[name="date_start"]').val();
                let date_end = $('input[name="date_end"]').val();
                let card_mtrl = $('input[name="card_mtrl"]').val();
                let summ_den_mtrl = $('input[name="summ_den_mtrl"]').val();
                let description_mtrl = $('textarea[name="description_mtrl"]').val();
                
            
                let formData = new FormData();
                formData.append('id_task', id_task);
                formData.append('mtrl_edit_task', mtrl_edit_task);
                formData.append('name_mtrl', name_mtrl);
                formData.append('date_start', date_start);
                formData.append('date_end', date_end);
                formData.append('card_mtrl', card_mtrl);
                formData.append('summ_den_mtrl', summ_den_mtrl);
                formData.append('description_mtrl', description_mtrl);
               
                
            
            
                $.ajax({
                    url: 'forms/edit_and_delete_task_admin.php',
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    cashe: false,
                    data: formData,
                    success: function(data) {
                        if (data.status){
                            console.log('Все ок');
                            $('.msg').removeClass('none').text(data.message); 
                            setTimeout("location.reload();", 900);
                        
                           
                        } else{
                            console.log('не работает');
                            if(data.type === 1){
                                data.fields.forEach(function(field){
                                     $(`input[name="${field}"]`).addClass("border-danger");
                                     $(`textarea[name="${field}"]`).addClass("border-danger");
                                     $(`select[name="${field}"]`).addClass("border-danger");
                                });  
            
            
                            }
                            $('.msg').removeClass('none').text(data.message); //
                        }
                    }
            
            
            
                }); 

               
            });
    }

    if(id_type == 3){
        let get_special_task = true; //запрос на данные по "Работы"
        $('#modal-edit-task-3').modal("toggle"); //вывод модального окна для измененения задачи
        
        // Загрузка кружок

        $.ajax({
                url: 'forms/edit_and_delete_task_admin.php',
                type: "POST",
                dataType: 'json',
                data: {
                    type_task: id_type,
                    id_task: id_task,
                    get_special_task: get_special_task    
                },
                success: function(data) {
                    if(data.status){
                        $(`input[name="name_s"]`).val(data.name);
                        $(`input[name="date_s"]`).val(data.date);
                        $(`input[name="time_s"]`).val(data.time);
                        $(`input[name="time_length_s"]`).val(data.time_length);
                        $(`select[name="clothes_s"] option[value=${data.clothes}]`).prop('selected', true);
                        $(`input[name="amout_people_s"]`).val(data.people_amout);
                        $(`textarea[name="description_s"]`).val(data.description);
                       }
                }
        
            });

            $('.special-task-edit').on( "click", function(e) {
                e.preventDefault();
                let special_edit_task = true;
    
                $(`input`).removeClass("border-danger");
                $(`textarea`).removeClass("border-danger");
                $(`select`).removeClass("border-danger");
            
                
            
                let name = $('input[name="name_s"]').val();
                let date = $('input[name="date_s"]').val();
                let time = $('input[name="time_s"]').val();
                let time_length = $('input[name="time_length_s"]').val();
                let clothes = $('select.clothes_s').children("option:selected").val();
                let amout_people = $('input[name="amout_people_s"]').val();
                let description = $('textarea[name="description_s"]').val();
                
            
                let formData = new FormData();
                formData.append('id_task', id_task);
                formData.append('name', name);
                formData.append('date', date);
                formData.append('time', time);
                formData.append('time_length', time_length);
                formData.append('clothes', clothes);
                formData.append('amout_people', amout_people);
                formData.append('description', description);
               
                formData.append('special_edit_task', special_edit_task);
            
            
                $.ajax({
                    url: 'forms/edit_and_delete_task_admin.php',
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    cashe: false,
                    data: formData,
                    success: function(data) {
                        if (data.status){
                            console.log('Все ок');
                            $('.msg').removeClass('none').text(data.message); 
                            setTimeout("location.reload();", 900);
                            // $('.task-need-form').addClass('none'); 
                            // $('.task-need-win').removeClass('none'); //сообщение задание успешно создано
                          
                         
                        } else{
                            console.log('не работает');
                            if(data.type === 1){
                                data.fields.forEach(function(field){
                                     $(`input[name="${field}"]`).addClass("border-danger");
                                     $(`textarea[name="${field}"]`).addClass("border-danger");
                                     $(`select[name="${field}"]`).addClass("border-danger");
                                });  
            
            
                            }
                            $('.msg').removeClass('none').text(data.message); //
                        }
                    }
            
            
            
                }); 

               
            });
    }


    
  });



