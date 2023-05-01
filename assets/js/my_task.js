
//сброс фильтров
$('.ubrat').click(function(){
    $(".task_card").remove(); //удалем повтор
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


$(document).on( "click", ".delete  .finished-task", function(e) {
    e.preventDefault();
    let i = $('.delete .finished-task').index(this);
    let id_task = $(`input[name="id_task${i}"]`).val();
    let id_type = $(`input[name="id_type${i}"]`).val();
   
    console.log("------");
    console.log(i);
    console.log(id_task);
    console.log(id_type);

    $('#modal-delete-task').modal("toggle");

    $.ajax({
        type: "POST",
        dataType: 'json',
        data: {
            type_task: id_task,
            id_task: id_task
        },
        success: function(data) {

        }

    });
    
  });





