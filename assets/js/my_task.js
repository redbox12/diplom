

$(".filter-task").click(function (e) { 
    e.preventDefault();
    let type_task = $('select.type-task').children("option:selected").val();
    let date_task = $('input[name="date_task"]').val();
    //console.log(type_task);
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
                        // $('#task-card').append('<h1>'+ task +'</h1>');
                });

                } else if (data.type == 0.1) { //вывод всех задач с датой
                    console.log('Теперь у нас есть дата');
                    console.log(data);
                    data.task.forEach(function(task){   
                        $('#task-card').append('<div class="col-lg-5 col-md-12 mb-1 ms-lg-3 mt-2 task_card">'+ task + '</div>');
                });
                }

                if(data.type == 1){ //вывод всех материальных задач
                    data.task.forEach(function(task){   
                        $('#task-card').append('<div class="col-lg-5 col-md-12 mb-1 ms-lg-3 mt-2 task_card">'+ task + '</div>');
                    });
                }
            
             
            } else{ //ощибки
            
            if (data.type == 0.1) { //если не имеется никакой задачи на дату
                $('#task-card').append('<div class="col-lg-5 col-md-12 mb-1 ms-lg-3 mt-2 task_card">'+ 
                '<div class="alert alert-warning alert-dismissible fade show" role="alert"> <strong>'+ data.message + 
                    '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button> </div> </div>');
            }
                // if(data.type == 1){
                //     data.fields.forEach(function(field){
                //          $(`input[name="${field}"]`).addClass("border-bottom border-danger");
                //     });  
                // }
                // $('.msg').removeClass('none').text(data.message);

                console.log("Не пашит!");
            }
            
        }
    });

    
});