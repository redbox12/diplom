
//убрать красные подчеркивание
$('.ubrat').click(function(){
    $(`input`).removeClass("border-danger");
    $(`textarea`).removeClass("border-danger");
    $(`select`).removeClass("border-danger");
    $('.msg').addClass("none");
});

// Получение картинки
let avatar = false;
$('input[name="avatar"]').change(function(e){
    avatar = e.target.files[0];
    console.log(avatar);
});

// Необходимые задания
$('.need-task').click(function(e){
    e.preventDefault();

    $(`input`).removeClass("border-danger");
    $(`textarea`).removeClass("border-danger");
    $(`select`).removeClass("border-danger");

    

    let name = $('input[name="name"]').val();
    let date = $('input[name="date"]').val();
    let time = $('input[name="time"]').val();
    let clothes = $('select.clothes').children("option:selected").val();
    let amout_people = $('input[name="amout_people"]').val();
    let description = $('textarea[name="description"]').val();
    let type_task = $('input[name="name"]').attr('id');

    let formData = new FormData();
    formData.append('name', name);
    formData.append('date', date);
    formData.append('time', time);
    formData.append('clothes', clothes);
    formData.append('amout_people', amout_people);
    formData.append('description', description);
    formData.append('type_task', type_task);
    formData.append('avatar', avatar);


    $.ajax({
        url: 'forms/task_crete.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cashe: false,
        data: formData,
        success: function(data) {
            if (data.status){
                console.log('Все ок');
                $('.msg').removeClass('none'); 
                $('.task-need-form').addClass('none'); 
                $('.task-need-win').removeClass('none'); //сообщение задание успешно создано!
              
             
            } else{
                console.log('бРАТАН НЕ РАБОТАЕТ');
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

//Материальные задания
$('.mtrl-task').click(function(e){
    e.preventDefault();
    $(`input`).removeClass("border-danger");
    $(`textarea`).removeClass("border-danger");
    $(`select`).removeClass("border-danger");

    

    let name_mtrl = $('input[name="name_mtrl"]').val();
    let date_start_mtrl = $('input[name="date_start_mtrl"]').val();
    let date_end_mtrl = $('input[name="date_end_mtrl"]').val();
    let telephone_mtrl = $('input[name="telephone_mtrl"]').val();
    let card_mtrl = $('input[name="card_mtrl"]').val();
    let summ_den_mtrl = $('input[name="summ_den_mtrl"]').val();
    let description_mtrl= $('textarea[name="description_mtrl"]').val();
    let type_task = $('input[name="name_mtrl"]').attr('id');

    let formData = new FormData();
    formData.append('name_mtrl', name_mtrl);
    formData.append('date_start_mtrl', date_start_mtrl);
    formData.append('date_end_mtrl', date_end_mtrl);
    formData.append('telephone_mtrl', telephone_mtrl);
    formData.append('card_mtrl', card_mtrl);
    formData.append('summ_den_mtrl', summ_den_mtrl);
    formData.append('description_mtrl', description_mtrl);
    formData.append('type_task', type_task);
    formData.append('avatar', avatar);


    $.ajax({
        url: 'forms/task_crete_mtrl.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cashe: false,
        data: formData,
        success: function(data) {
            if (data.status){
                console.log('Все ок');
                $('.msg').removeClass('none'); 
                //сообщение задание успешно создано!
              
             
            } else{
                console.log('НЕ РАБОТАЕТ материя');
                if(data.type === 1){
                    data.fields.forEach(function(field){
                         $(`input[name="${field}"]`).addClass("border-danger");
                         $(`textarea[name="${field}"]`).addClass("border-danger");
                         $(`select[name="${field}"]`).addClass("border-danger");
                    });  

                }
                $('.msg').removeClass('none').text(data.message); 
            }
        }



    }); 
 
 

});

//форма для номера телефона
$("#yourTelephone").click(function(e){
    e.preventDefault();
    $.mask.definitions['~']='[8]';
    $("#yourTelephone").mask("~ (999) 999-99-99");
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
  $('.mask-card-number').click(function(e){
    $(this).setCursorPosition(0);
    
  }).mask('9999 9999 9999 9999');

