// DATATABLE - GENERAL OPTIONS
$(document).ready( function () {
    $('.dataTable').DataTable({
        "ordering" : false,
        "language" : {
            "sProcessing"        : "Procesando...",
            "sLengthMenu"        : "Mostrar _MENU_ registros",
            "sZeroRecords"       : "No se encontraron resultados",
            "sEmptyTable"        : "Ningún dato disponible",
            "sInfo"              : "Registros del _START_ al _END_ (_TOTAL_ registros)",
            "sInfoEmpty"         : "0 Registros",
            "sInfoFiltered"      : "- (filtrado de un total de _MAX_ registros)",
            "sInfoPostFix"       : "",
            "sSearch"            : '<span class="fa fa-search"></span>',
            "sSearchPlaceholder" : "Buscar",
            "sUrl"               : "",
            "sInfoThousands"     :  ",",
            "sLoadingRecords"    : "Cargando...",
            "oPaginate"          : {
                "sFirst"    : "Primero",
                "sLast"     : "Último",
                "sNext"     : "Siguiente",
                "sPrevious" : "Anterior"
            },
            "oAria"              : {
                "sSortAscending"  : ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending" : ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
} );

// GENERAL FUNCTION TO GET DATA
function getDataForm(form){
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

// CONEXION POST CONTROLLER
function conexionPostController(url,data,form,redirect){
    //La variable "form" es opcional si se desea limpiar el formulario
    //La variable "redirect" es opcional si se desea redireccionar la página
    return $.post(url,data)
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
            console.log("Response from the factory => ",respuesta);
        }
    })
    .fail(function(){
        showAlert('ERROR','Error al procesar la solicitud','red');  
    });
}

// CONEXION GET CONTROLLER
function conexionGetController(url)
{
    return $.get(url)
    .done(function(response){
        const respuesta = JSON.parse(response);
            
        if(typeof respuesta === 'object' && typeof respuesta.error !== 'undefined')
            return respuesta;
    })
    .fail(function(){
        showAlert('ERROR','Error al procesar la solicitud','red');  
    });

}

// EMAIL VALIDATION
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

// SHOW ALERT NOTIFY
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

// SHOW INPUT - PASSWORD
function showPassword(){
    let input_password = $(this).parent().parent().children('#password'),
        icon           = $('.icon_show_password');
    
    switch (input_password.attr('type')) {
        case 'password':
                input_password.attr('type','text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            break;

        case 'text':
                input_password.attr('type','password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            break;
    
        default:
            showAlert('CUIDADO','No es posible cambiar este tipo de input','yellow');
    }
}