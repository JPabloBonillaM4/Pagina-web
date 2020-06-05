(()=>{
    // Acciones
    $('#crear-admin').on('submit',saveAdmin);
    $('#show_password').click(showPassword);
    $('#login-admin').on('submit',loginAdmin);

    // funcion general para obtener datos del formulario
    function getData(form){
        let data = {};

        try {
            $.each($(`#${form}`).serializeArray(),function(){
                data[this.name] = this.value;
            });
                    
            for (const key in data) {
                if (data.hasOwnProperty(key)) {
                    const element = data[key];
                    var campo     = document.getElementById(key).getAttribute('data-name');
    
                    if(element == 0 || typeof element == 'undefined' || element == null)
                    {
                        showAlert('CUIDADO',`El campo ${campo} está vacío, favor de llenarlo`,'yellow');
                        $(`#${key}`).focus();
                        return false;
                    }
                }
            }

            return data;
        } catch (error) {
            console.error('El ID y el NAME de los inputs debe ser igual, DATA-NAME se usa para detectar el input vacío');
            console.error('ERROR => ', error);

            return false;
        }

    };

    function emailValidation(correo){
        let validation = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(correo.val())
        if(validation)
        {
            return true;
        }else{
            showAlert('CUIDADO','El correo que ingresó debe ser válido','yellow');
            correo.focus();
            return false;
        }
    }

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
            conexionPostController("controllers/adminController.php",datos,form);
    }

    function conexionPostController(url,data,form){//La variable "form" es opcional si se desea limpiar el formulario
        $.post(url,data,function(response){
            const respuesta = JSON.parse(response);
                
            if(typeof respuesta === 'object' && typeof respuesta.error !== 'undefined')
            {
                if(!respuesta.error)
                {
                    showAlert('!EXITO¡',respuesta.mensaje,'green');

                    if(typeof form !== 'undefined')
                        $(`#${form}`).trigger("reset");
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

    function showAlert(titulo,mensaje,color){
        iziToast.show({
            title    : titulo,
            message  : mensaje,
            color    : color,
            position : 'topRight',
            layout   : 2,
            balloon  : true
        });
    }
})();

