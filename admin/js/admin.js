(()=>{

    // Acciones
    $('#agregar_admin').click(saveAdmin);

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
                    alert(`El campo ${campo} esta vacío, favor de llenarlo`);
                    $(`#${key}`).focus();
                    return false;
                }
            }
        }

        return data;
    };

    function saveAdmin(event){
        event.preventDefault();

        datos = getData('crear-admin');
        console.log(datos);
        if(typeof datos === 'object')
        {
            $.post("controllers/insertar-admin.php",datos,function(response){
                console.log(response);
            })
            .fail(function(){
                console.log('Error al procesar registro');
            });
        } else {
            console.log('Hubo un error en el formulario');
        }
    }

})();

