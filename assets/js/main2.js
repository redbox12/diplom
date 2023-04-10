//forms/signin.php

/* 

Авторизация 

*/
//номер телефона
$("#yourTelephone").click(function(e){
    e.preventDefault();
    $.mask.definitions['~']='[8]';
    $("#yourTelephone").mask("~ (999) 999-99-99");
});
// $.mask.definitions['~']='[78]';
// $("input[name='phone]'").mask("~ (999) 999-9999");


$('.login-btn').click(function(e){
    e.preventDefault();
    $(`input`).removeClass('border-danger');
    
    let telephone =  $('input[name="telephone"]').val();
    let password = $('input[name="password"]').val(); //val() - дает данные 
    
    
    //console.log(tel) - вывод переменной

    // $.ajax({
    //     url: 'forms/signin.php',
    //     type: 'POST',
    //     dataType: 'text',
    //     data: {
    //         telephone: telephone,
    //         password: password

    //     },
    //     success: function (data) {
    //         //console.log(data);
    //         $('.msg').text(data);
    //     }
    // });

    $.ajax({
        url: 'forms/signin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            telephone: telephone,
            password: password

        },
        success (data) {
            //console.log(data);
            if (data.status){
                //console.log(data);
                document.location.href='/diplom/users-profile.php';
            } else{

                if(data.type == 1){
                    data.fields.forEach(function(field){
                         $(`input[name="${field}"]`).addClass("border-bottom border-danger");
                    });  
                }
                $('.msg').removeClass('none').text(data.message);
            }
            
        }
    });



}); 

/* 

Регистрация

*/
// $('input[name="telephone"]').click(function(e){
//     e.preventDefault();
//     $('input[name="telephone"]').mask("+7 (999) 999 - 99 99");
// });

$('.register-bat').click(function(e){
    e.preventDefault();

    $(`input`).removeClass('border-danger');
    
    let name = $('input[name="full_name"]').val();
    let telephone =  $('input[name="telephone"]').val();
    let password = $('input[name="password"]').val(); 
    let password_confirm = $('input[name="password_confirm"]').val(); //val() - дает данные 

    $.ajax({
        url: 'forms/signup.php',
        type: 'POST',
        dataType: 'json',
        data: {
            full_name: name,
            telephone: telephone,
            password: password,
            password_confirm: password_confirm

        },
        success (data) {
            if (data.status){
                //console.log(telephone);   
                document.location.href='/diplom/pages-login.php';
            } else{

                if(data.type == 1){
                    data.fields.forEach(function(field){
                         $(`input[name="${field}"]`).addClass("border-bottom border-danger");
                    });  
                }
                $('.msg').removeClass('none').text(data.message);
            }
        }



    }); 
});