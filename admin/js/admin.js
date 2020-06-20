(()=>{
    // Acciones
    $('#crear-admin').on('submit',saveAdmin);
    $('#show_password').click(showPassword);
    $('#login-admin').on('submit',loginAdmin);
    // $('.editAdmin').click(getInfo);
    // $('.deleteAdmin').click(deleteInfo);

    // SAVE NEW ADMIN
    function saveAdmin(event){
        event.preventDefault();
        let form  = $(this).attr('id'),
            datos = getData(form);
        if(typeof datos === 'object')
        {
            if(!emailValidation($(`#${form} #email`)))
                return false;

            conexionPostController("controllers/adminController.php",datos,form);
        }
    }
    
    // LOGIN ADMIN
    function loginAdmin(event){
        event.preventDefault();
        let form  = $(this).attr('id')
            datos = getData(form);
        
        if(typeof datos === 'object')
            conexionPostController("controllers/adminController.php",datos,form,'admin-main.php');
    }

    function conexionPostController(url,data,form,redirect){
        //La variable "form" es opcional si se desea limpiar el formulario
        //La variable "redirect" es opcional si se desea redireccionar la página
        $.post(url,data)
        .done(function(response){
            const respuesta = JSON.parse(response);
                
            if(typeof respuesta === 'object' && typeof respuesta.error !== 'undefined')
            {
                if(!respuesta.error)
                {
                    showAlert('!EXITO¡',respuesta.mensaje,'green');

                    if(typeof form !== 'undefined')
                        $(`#${form}`).trigger("reset");
                    
                    if(typeof redirect !== 'undefined')
                    {
                        setTimeout(() => {
                            window.location.href = redirect;
                        }, 2500);
                    }
                    
                }
                else
                {
                    showAlert('ERROR',respuesta.mensaje,'red');

                    if(respuesta.errorData)
                        console.log(respuesta.errorData);
                }
            }
        })
        .fail(function(){
            showAlert('ERROR','Error al procesar la solicitud','red');  
        });
    }

    function showPassword(){
        let input_password = $(this).parent().parent().children('#password'),
            icon           = $('.icon_show_password');
        
        if(input_password.attr('type') == 'password')
        {
            input_password.attr('type','text');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
        else if(input_password.attr('type') == 'text')
        {
            input_password.attr('type','password');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        }
        else
        {
            showAlert('CUIDADO','No es posible cambiar este tipo de input','yellow');
        }
    }

})();

