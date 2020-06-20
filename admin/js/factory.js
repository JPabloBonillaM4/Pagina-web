// DataTables - Opciones generales
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

// OPEN MODAL
$('.openModal').click(function (event) {
    event.preventDefault();
    $(`#${$(this).attr('data-modal')}`).modal('show');
});

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



