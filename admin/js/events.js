(()=>{
    $('#crear-event').on('submit',saveEvent);
    $('.editEvent').click(getEventEditInfo);
    $('.deleteEvent').click(modalDelete);
    $('#delete_event_admin').on('submit',deleteEvent);

    // SAVE NEW ADMIN
    function saveEvent(event){
        event.preventDefault();
        let form  = $(this).attr('id'),
            datos = getDataForm(form);
        if(typeof datos === 'object')
        {
            // conexionPostController("controllers/adminController.php",datos,form).then(function(){
            //     $('.message_repeat_password').first().html('')
            // });
        }
    }
    // GET ADMIN INFO BY USER
    function getEventEditInfo(event){
        event.preventDefault();
        const id           = $(this).attr('data-id'),
              action       = $(this).attr('data-action'),
              dataObtained = conexionGetController("controllers/eventsController.php?id=" + id + "&action=" + action);
        
        dataObtained.then((data) => {
            data = JSON.parse(data)
            if(!data.error)
            {
                let datosUsuario = data.event;
                for (const key in datosUsuario) {
                    if (datosUsuario.hasOwnProperty(key)) {
                        // $(`#${$(this).attr('data-modal')} form #${key}`).val(datosUsuario[key])
                        
                    }
                }
                $(`#${$(this).attr('data-modal')} h5 span`).text(data.event.nombre);
                $(`#${$(this).attr('data-modal')}`).modal('show');
            } else {
                showAlert('ERROR',data.msg,'red');
            }
        }).catch((err) => {
            console.log(err);
        });
    }
    // MODAL DELETE
    function modalDelete(event){
        event.preventDefault();
        $(`#${$(this).attr('data-modal')} form input[id=id_delete]`).val($(this).attr('data-id'));
        $(`#${$(this).attr('data-modal')}`).modal('show');
    }

    // DELETE EVENT
    function deleteEvent(event){
        event.preventDefault();
        let form = $(this).attr('id'),
            datos = getDataForm(form);

        if(typeof datos === 'object'){
            conexionPostController("controllers/eventsController.php",datos).then(result => {
                let data = JSON.parse(result);
                if(!data.error){
                    $(`#${$(this).attr('data-modal')}`).modal('hide');
                    jQuery(`[data-id="${data.id}"]`).parents('tr').remove();
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            });
        }
    }
})();