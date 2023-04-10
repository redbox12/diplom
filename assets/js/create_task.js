

// Получение картинки
let avatar = false;
$('input[name="avatar"]').change(function(e){

});

// Необходимые задания
$('.need-task').click(function(e){
    e.preventDefault();

    $(`input`).removeClass("border-danger");
    $(`textarea`).removeClass("border-danger");

    let name = $('input[name="name"]').val();
    let date = $('input[name="date"]').val();
    let time = $('input[name="time"]').val();
    let clothes = $('select.clothes').children("option:selected").val();
    let amout_people = $('input[name="amout_people"]').val();
    let description = $('textarea[name="description"]').val();
    let type_task = $('input[name="name"]').attr('id');



    $.ajax({
        url: 'forms/task_crete.php',
        type: 'POST',
        dataType: 'json',
        // processData: false,
        // contentType: false,
        // cashe: false,
        data: {
            name: name,
            date: date,
            time: time,
            clothes: clothes,
            amout_people: amout_people,
            description: description,
            type_task: type_task
        },
        success: function(data) {
            if (data.status){
                console.log('Все ок');
                $('.msg').removeClass('none'); 
              
             
            } else{
                console.log('бРАТАН НЕ РАБОТАЕТ');
                if(data.type === 1){
                    data.fields.forEach(function(field){
                         $(`input[name="${field}"]`).addClass("border-danger");
                         $(`textarea[name="${field}"]`).addClass("border-danger");
                         $(`select.${field}`).addClass("border-danger");
                    });  
                }
                $('.msg').removeClass('none').text(data.message); //
            }
        }



    }); 
 
 

});