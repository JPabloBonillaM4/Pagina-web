(()=>{
    $('#crear-invited').on('submit',saveInvited);
    $('.editInvited').click(getInvitedEditInfo);
    $('.deleteInvited').click(modalDelete);
    $('#delete_invited').on('submit',deleteInvited);
    $('#edit_invited_info').on('submit',editInvited);
    // SAVE NEW INVITED
    function saveInvited(event){
        event.preventDefault();
        let form  = $(this).attr('id'),
            datos = getDataFormFiles(form);
        if(typeof datos === 'object')
        {
            conexionPostControllerWithFiles("controllers/guestsController.php",datos,form).then(function(){
                //Nuevo código aquí
            });
        }
    }
    // GET INVITED INFO
    function getInvitedEditInfo(event){
        event.preventDefault();
        const id           = $(this).attr('data-id'),
              action       = $(this).attr('data-action'),
              dataObtained = conexionGetController("controllers/guestsController.php?id=" + id + "&action=" + action);
        
        dataObtained.then((data) => {
            data = JSON.parse(data)
            if(!data.error)
            {
                let datosUsuario = data.invited;
                for (const key in datosUsuario) {
                    if (datosUsuario.hasOwnProperty(key)) {
                        if(datosUsuario[key] != null){
                            $(`#${$(this).attr('data-modal')} form #${key}`).val(datosUsuario[key]);
                            $(`#imagen_actual`).attr('src',`img/invitados/${datosUsuario['url_imagen']}`);
                        }
                        $(`#${key}`).trigger('change');
                    }
                }
                $(`#${$(this).attr('data-modal')} h5 span`).text(`${data.invited.nombre} ${data.invited.apellido}`);
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
    function deleteInvited(event){
        event.preventDefault();
        let form = $(this).attr('id'),
            datos = getDataForm(form);
        if(typeof datos === 'object'){
            conexionPostController("controllers/guestsController.php",datos).then(result => {
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
    // EDIT INVITED
    function editInvited(event){
        event.preventDefault();
        let form = $(this).attr('id'),
            datos = getDataFormFiles(form);
        if(typeof datos === 'object'){
            conexionPostControllerWithFiles("controllers/guestsController.php",datos).then(result => {
                let data = result;
                if(!data.error){
                    $(`#${$(this).attr('data-modal')}`).modal('hide');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            });
        }
    }
})();