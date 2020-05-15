(()=>{
    // Acciones
    $('#agregar_admin').click(saveAdmin);
    $('#show_password').click(showPassword);

    // funcion general para obtener datos del formulario
    function getData(form){
        let data = {};

        $.each($(`#${form} input`),function(){
            data[this.name] = this.value;
        });

        $.each($(`#${form} select`),function(){
            data[this.name] = this.value;
        });

        for (const key in data) {
            if (data.hasOwnProperty(key)) {
                const element = data[key];
                var campo     = document.getElementById(key).getAttribute('data-name');

                if(element == 0 || typeof element == 'undefined' || element == null)
                {
                    alert(`El campo ${campo} está vacío, favor de llenarlo`);
                    $(`#${key}`).focus();
                    return false;
                }
            }
        }

        return data;
    };

    function emailValidation(correo){
        let validation = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(correo.val())
        console.log(validation);
        if(validation)
        {
            return true;
        }else{
            alert('El correo que ingresó debe ser correcto');
            correo.focus();
            return false;
        }
    }

    function saveAdmin(event){
        event.preventDefault();
        let datos = getData('crear-admin');
        if(typeof datos === 'object')
        {
            if(!emailValidation($('#crear-admin #email')))
                return false;

            $.post("controllers/insertar-admin.php",datos,function(response){
                console.log(JSON.parse(response));
            })
            .fail(function(){
                console.log('Error al procesar registro');
            });
        } else {
            console.log('Hubo un error en el formulario');
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
            console.log('No es posible cambiar este tipo de input');
        }
    }
})();

