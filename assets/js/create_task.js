
//убрать красные подчеркивание
$('.ubrat').click(function(){
    $(`input`).removeClass("border-danger");
    $(`textarea`).removeClass("border-danger");
    $(`select`).removeClass("border-danger");
    $('.msg').addClass("none");
    $('.msg2').addClass("none");
    $('.msg3').addClass("none");
});

//форма для номера телефона
$("#yourTelephone").click(function(){
    $.mask.definitions['~']='[8]';
    $("#yourTelephone").mask("~ (999) 999-99-99");
});

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
    let time_length = $('input[name="time_length"]').val();
    let clothes = $('select.clothes').children("option:selected").val();
    let amout_people = $('input[name="amout_people"]').val();
    let description = $('textarea[name="description"]').val();
    let type_task = $('input[name="name"]').attr('id');

    let formData = new FormData();
    formData.append('name', name);
    formData.append('date', date);
    formData.append('time', time);
    formData.append('time_length', time_length);
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
                $('.task-need-win').removeClass('none'); //сообщение задание успешно создано
              
             
            } else{
                console.log('не работает');
                if(data.type === 1){
                    data.fields.forEach(function(field){
                         $(`input[name="${field}"]`).addClass("border-danger");
                         $(`textarea[name="${field}"]`).addClass("border-danger");
                         $(`select[name="${field}"]`).addClass("border-danger");
                    });  

                    if (data.type === 2){
                        $(`input[name="avatar"]`).addClass("border-danger");
                        console.log('Проблема с фото');
                    }

                }
                $('.msg').removeClass('none').text(data.message); //
            }
        }



    }); 
 
 

});

//фото для материальной помощи
let avatar2 = false;
$('input[name="avatar2"]').change(function(e){
    avatar2 = e.target.files[0];
    console.log(avatar2);
});

//Материальные задания
$('.task-mtrl-form').on('submit', function(e){
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
    let type_task = 2;

    let formData = new FormData();
    formData.append('name_mtrl', name_mtrl);
    formData.append('date_start_mtrl', date_start_mtrl);
    formData.append('date_end_mtrl', date_end_mtrl);
    formData.append('telephone_mtrl', telephone_mtrl);
    formData.append('card_mtrl', card_mtrl);
    formData.append('summ_den_mtrl', summ_den_mtrl);
    formData.append('description_mtrl', description_mtrl);
    formData.append('type_task', type_task);
    formData.append('avatar2', avatar2);

   

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
                $(".msg2").addClass("none").text(data.message);
                $('.task-mtrl-form').addClass('none'); 
                $('.task-mtrl-win').removeClass('none');
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

                if (data.type === 2){
                    $(`input[name="avatar2"]`).addClass("border-danger");
                    console.log('Проблема с фото');
                }
                
                $(".msg2").removeClass("none").text(data.message); 
            }
        }



    }); 
 
 

});

let avatar3 = false;
$('input[name="avatar3"]').change(function(e){
    avatar3 = e.target.files[0];
    console.log(avatar3);
});


//особое поручение
// $('.task-special-form').on('submit', function(e){
$('.task-special').click(function(e){
    e.preventDefault();
    
    $(`input`).removeClass("border-danger");
    $(`textarea`).removeClass("border-danger");
    $(`select`).removeClass("border-danger");

    

    let name_special = $('input[name="name_special"]').val();
    let date_special = $('input[name="date_special"]').val();
    let time_special = $('input[name="time_special"]').val();
    let time_length = $('input[name="time_length_special"]').val();
    let clothes_special = $('select.clothes_special').children("option:selected").val();
    let amout_people_special = $('input[name="amout_people_special"]').val();
    let description_special = $('textarea[name="description_special"]').val();
    let type_task= 3;

    let formData = new FormData();
    formData.append('name_special', name_special);
    formData.append('date_special', date_special);
    formData.append('time_special', time_special);
    formData.append('time_length', time_length);
    formData.append('clothes_special', clothes_special);
    formData.append('amout_people_special', amout_people_special);
    formData.append('description_special', description_special);
    formData.append('type_task', type_task);
    formData.append('avatar3', avatar3);


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
                $('.msg3').removeClass('none'); 
                $('.task-special-form').addClass('none'); 
                $('.task-special-win').removeClass('none'); //сообщение задание успешно создано
              
             
            } else{
                console.log('не работает специалка');
                if(data.type === 1){
                    data.fields.forEach(function(field){
                        console.log('Все красное!');
                        $(`textarea[name="${field}"]`).addClass("border-danger");
                        $(`input[name="${field}"]`).addClass("border-danger");
                        $(`select[name="${field}"]`).addClass("border-danger");
                    });  

                }

                if (data.type === 2){
                   $(`input[name="avatar3"]`).addClass("border-danger");
                    console.log('Проблема с фото');
                }

               $('.msg3').removeClass('none').text(data.message); //
            }
        
        }
    }); 
});

