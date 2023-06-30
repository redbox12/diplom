

$(document).ready(function() { // Загрузка всех заданий
    my_task();

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

    $("#all").attr('disabled', true); //закрепляем кнопку все задания
   

});

function my_task() {

    $('.line').remove(); //удаляю линию
    $.ajax({
        url: 'forms/tasks_catalog_back.php',
        type: 'POST',
        dataType: 'json',
        data: {
            my_task: 1,
        },
        success: function(data) {
            if (data.status){  
                 //вывод всех задач без даты
                    console.log(data);
                    data.task.forEach(function(task){   
                        $('#my-task h4').text('МОИ ЗАДАЧИ');
                        $('#my-task').append('<div class="col-lg-5 col-md-12 mb-1 ms-lg-3 mt-2 task_card">'+ task + '</div>');
                        $('.limite_number').text(data.limite_task);
                });


            } else{ //ошибки
                console.log("Не пашет!");
                 $('.line').remove();
            }
            
        }

    });

  
  


 
  }

  $('#my-static').on( "mouseover", ".limite", function() {
    $('.limite').tooltip();
  });


  $('.limite').click(function(e){
    e.preventDefault();
    $('.limite').tooltip('show');
    setInterval(function(){ //время 4.5 сек. до исчезновения подсказки
        $('.limite').tooltip('hide');
    }, 5000);
    
  });





//модальное окно, информирующее об изименении задачи
$(document).on( "click", ".my-task-res  i", function(e) {
    e.preventDefault();
    //$('.btn-tooltip').tooltip();
    let i = $('.info i').index(this);
    let id_task = $(`input[id="id_task_i${i}"]`).val();
    let id_type = $(`input[id="id_type_i${i}"]`).val();
    let id_human = $(`input[id="id_human_i${i}"]`).val();
    let edit_info = true;

    console.log('--------');
    console.log(i);
    console.log(id_task);
    console.log(id_type);
    console.log(id_human);
    // 
    console.log('--------');
    //$(`#info-change${i}`).tooltip('show');
    $('#modal-info').modal("toggle");

    $.ajax({
        url: 'forms/edit_and_delete_task_admin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id_task: id_task,
            edit_info: edit_info,
            id_type: id_type,
            id_human: id_human
        },
        success: function(data) {
            if (data.status){  
                //$('.info').remove()
                setTimeout("location.reload();", 2000);
                //$('.info').removeClass();
                console.log("Все ништяк");
            } else{ //ошибки
                console.log("Не пашит!");
            }
            
        }
    });
    


});

//   $('#my-task').on( "mouseover", ".task_card", function() {
//     $('.btn-tooltip').tooltip();
//   });



$("#all").on('click', function(e){
    e.preventDefault();
    my_task();
    let task_type = $("#all").val();
    console.log(task_type);

    $("#need").attr('disabled', false);
    $("#mtrl").attr('disabled', false);
    $("#special").attr('disabled', false);  //открепляем кнопку все задания
    $(".task_card").remove(); //удалем повтор

    $.ajax({
        url: 'forms/my_task_admin_back.php',
        type: 'POST',
        dataType: 'json',
        data: {
            type_task: task_type,
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

    $("#all").attr('disabled', true); //закрепляем кнопку все задания



});

$("#need").on('click', function(e){
    my_task();
    e.preventDefault();
    let task_type = $("#need").val();
    console.log(task_type);

    $("#all").attr('disabled', false);
    $("#mtrl").attr('disabled', false); 
    $("#special").attr('disabled', false); //открепляем кнопку все задания
    $(".task_card").remove(); //удалем повтор

    $.ajax({
        url: 'forms/my_task_admin_back.php',
        type: 'POST',
        dataType: 'json',
        data: {
            type_task: task_type,
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

    $("#need").attr('disabled', true); //закрепляем кнопку все задания



});

$("#mtrl").on('click', function(e){
    e.preventDefault();
    my_task();
    
    let task_type = $("#mtrl").val();
    console.log(task_type);

    $("#all").attr('disabled', false); 
    $("#need").attr('disabled', false);
    $("#special").attr('disabled', false);//открепляем кнопку все задания

    $(".task_card").remove(); //удалем повтор

    $.ajax({
        url: 'forms/my_task_admin_back.php',
        type: 'POST',
        dataType: 'json',
        data: {
            type_task: task_type,
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

    $("#mtrl").attr('disabled', true); //закрепляем кнопку все задания



});

$("#special").on('click', function(e){
    e.preventDefault();
    my_task();
    
    let task_type = $("#special").val();
    console.log(task_type);

    $("#all").attr('disabled', false); 
    $("#need").attr('disabled', false);
    $("#mtrl").attr('disabled', false); //открепляем кнопку все задания


    $(".task_card").remove(); //удалем повтор

    $.ajax({
        url: 'forms/my_task_admin_back.php',
        type: 'POST',
        dataType: 'json',
        data: {
            type_task: task_type,
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

    $("#special").attr('disabled', true); //закрепляем кнопку все задания



});


  //отклик на задачу в каталоге задач
$(document).on( "click", ".response  .response-task", function(e) {
    e.preventDefault();
    let i = $('.response .response-task').index(this);
    let id_task = $(`input[id="id_task${i}"]`).val();
    let id_type = $(`input[id="id_type${i}"]`).val();
    let id_human = $(`input[id="id_human${i}"]`).val();
   
    console.log("------");
    console.log(i);
    console.log(id_task);
    console.log(id_type);
    console.log(id_human);

    

    $.ajax({
        url: 'forms/tasks_catalog_back.php',
        type: "POST",
        dataType: 'json',
        data: {
            type_task: id_type,
            id_task: id_task,
            id_human: id_human
        },
        success: function(data) {
            if(data.status){
                $(".msg-task").text(data.message);
                $('#modal-response-task').modal("toggle");
                $('.btn-close').click(function (e) { 
                    e.preventDefault();
                    location.reload();
                });
            } else {
                $(".msg-task").text(data.message);
                $('#modal-response-task').modal("toggle");
                $('.btn-close').click(function (e) { 
                    e.preventDefault();
                    $(".msg-task").text(" ");
                });
               
            }

        }

    });

    //location.reload();

    
  });


  //отказаться от задачи 
$('#my-task').on( "click", ".otkaz-task", function(e) {
    e.preventDefault();
    let i = $('.otkaz-task').index(this);
    let id_task = $(`input[id="id_task_m${i}"]`).val();
    let id_type = $(`input[id="id_type_m${i}"]`).val(); 
    let id_human = $(`input[id="id_human_m${i}"]`).val();


   
    console.log("------");
    console.log(i);
    console.log(id_task);
    console.log(id_type);
    console.log(id_human);
  
    

    $.ajax({
        url: 'forms/tasks_catalog_otkaz.php',
        type: "POST",
        dataType: 'json',
        data: {
            type_task: id_type,
            id_task: id_task,
            id_human: id_human
        },
        success: function(data) {
            if(data.status){
                $(".msg-task").text(data.message);
                $('#modal-response-task').modal("toggle");
                $('.btn-close').click(function (e) { 
                    e.preventDefault();
                    location.reload();
                });
                console.log(data.message);
            } else {
                // $(".msg-task").text(data.message);
                // $('#modal-response-task').modal("toggle");
                // $('.btn-close').click(function (e) { 
                //     e.preventDefault();
                //     $(".msg-task").text(" ");
                // });

                console.log("Не пашет");
               
            }

        }

    });

});

 //отказаться на странице задания
$('.otkaz').on( "click", ".otkaz-task", function(e) {
    e.preventDefault();
    let i = $('.otkaz-task').index(this);
    let id_task = $(`input[name="id_task_m${i}"]`).val();
    let id_type = $(`input[name="id_type_m${i}"]`).val(); 
    let id_human = $(`input[name="id_human_m${i}"]`).val();


   
    console.log("------");
    console.log(i);
    console.log(id_task);
    console.log(id_type);
    console.log(id_human);
  
    

    $.ajax({
        url: 'forms/tasks_catalog_otkaz.php',
        type: "POST",
        dataType: 'json',
        data: {
            type_task: id_type,
            id_task: id_task,
            id_human: id_human
        },
        success: function(data) {
            if(data.status){
                $(".msg-task").text(data.message);
                $('#modal-response-task').modal("toggle");
                $('.btn-close').click(function (e) { 
                    e.preventDefault();
                    document.location.href='tasks_catalog.php';
                });
                console.log(data.message);
            } else {
    
                console.log("Не пашет");
               
            }

        }

    });

});
