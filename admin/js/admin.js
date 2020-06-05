(()=>{
    // Acciones
    $('#crear-admin').on('submit',saveAdmin);
    $('#show_password').click(showPassword);

    // funcion general para obtener datos del formulario
    function getData(form){
        let data = {};

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

    function saveAdmin(event){
        event.preventDefault();
        let form  = $(this).attr('id'),
            datos = getData(form);
        if(typeof datos === 'object')
        {
            if(!emailValidation($(`#${form} #email`)))
                return false;

            $.post("controllers/insertar-admin.php",datos,function(response){
                const respuesta = JSON.parse(response);

                if(!respuesta.error)
                {
                    showAlert('!EXITO¡',respuesta.mensaje,'green');
                    $(`#${form}`).trigger("reset");
                }
                else
                {
                    showAlert('ERROR',respuesta.mensaje,'red');
                    if(respuesta.errorData)
                        console.log(respuesta.errorData);
                }
            })
            .fail(function(){
                showAlert('ERROR','Error al procesar la solicitud','red');  
            });
        }
    }

    function showPassword(){
        let input_password = $('#password'),
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

