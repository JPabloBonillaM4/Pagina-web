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
        $.each($(`form#${form}`).serializeArray(),function(){
            data[this.name] = this.value;
        });
        $.each($(`form#${form} select`),function(index,element){
            data[element.name] = element.value;
        })
        for (const key in data) {
            if (data.hasOwnProperty(key)) {
                const element = data[key];
                var campo     = document.getElementById(key);
                if((element == 0 || typeof element == 'undefined' || element == null) && campo.getAttribute('data-required') == 'true')
                {
                    showAlert('CUIDADO',`El campo ${campo.getAttribute('data-name')} está vacío, favor de llenarlo`,'yellow');
                    $(`#${key}`).focus();
                    return false;
                }
            }
        }
        return data;
    } catch (error) {
        console.error('El ID y el NAME de los inputs debe ser igual, DATA-NAME se usa para detectar el nombre del input vacío');
        console.error('ERROR => ', error);
        return false;
    }
};

// RESET FORM
$('.resetForm').on('click',resetDataForm);
function resetDataForm(){
    $(this).parents('form').first().trigger('reset');
    $.each($('.message_repeat_password'),function(key,element){
        element.innerHTML = '';
    })
}

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
                if(typeof form !== 'undefined' && form != '')
                    $(`#${form}`).trigger("reset");
                
                if(typeof redirect !== 'undefined' && redirect != '')
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
$('.show_password').click(showPassword);
function showPassword(){
    let input_password = $(this).parents().siblings('input.change_password'),
        icon           = $(this).find('.icon_show_password');
    
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

// REPEAT PASSWORD VALIDATION
$('.check_password').on('input', function(){
    //1.- Write this class on the inputs you want to check (.check_password)
    //2.- Write this classes on the inputs you want to check (.first_password && .second_password)
    let password   = $(this).parents('form').find('.first_password').first(),
        password_2 = $(this).parents('form').find('.second_password').first();

    if(password.val() == password_2.val())
        $(this).parents('form').find('.message_repeat_password').first().html('<span><i class="fas fa-check-circle"></i> Contraseñas correctas<span>').css({"color":"green"});
    else
        $(this).parents('form').find('.message_repeat_password').first().html('<span><i class="fas fa-times-circle"></i> Las contraseñas deben coincidir<span>').css({"color":'red'});
});

// ACTIVATE DATEPICKER
let fecha_actual = new Date();
$('.datepickerSingle').daterangepicker({ //single DatePicker
    locale: {
        // format: 'DD/MM/YYYY hh:mm A'
        format : 'YYYY/MM/DD',
        "daysOfWeek": ["Lun","Mar","Mier","Jue","Vie","Sáb","Dom"],
        "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
    },
    singleDatePicker: true,
    showDropdowns: true,
    minYear: fecha_actual.getFullYear() - 1,
    maxYear: fecha_actual.getFullYear() + 5,
    opens: "left",
    drops: "auto"
});
// ACTIVATE SELECT2
$('.select2').select2({
    theme:'bootstrap4'
});
// timePicker
$('.timepicker').datetimepicker({
    format: 'LT',
    sideBySide: true,
    icons: {
        up: "fas fa-arrow-up",
        down: "fas fa-arrow-down",
        next: 'fa fa-chevron-circle-right',
        previous: 'fa fa-chevron-circle-left'
    }
})
// Icon picker
$('.iconPicker').iconpicker({
    placement: 'right',
    templates: {
        search: '<input type="search" class="form-control iconpicker-search" placeholder="Buscar icono..." />'
    }
});
$('.iconpicker-popover').removeClass('fade');