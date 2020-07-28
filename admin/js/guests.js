(()=>{
    $('#crear-invited').on('submit',saveInvited);
    $('.editCategory').click(getCategoryEditInfo);
    $('.deleteCategory').click(modalDelete);
    $('#delete_category_admin').on('submit',deleteCategory);
    $('#edit_category_info').on('submit',editCategory);
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
    // GET CATEGORY INFO BY USER
    function getCategoryEditInfo(event){
        event.preventDefault();
        const id           = $(this).attr('data-id'),
              action       = $(this).attr('data-action'),
              dataObtained = conexionGetController("controllers/categoriesController.php?id=" + id + "&action=" + action);
        
        dataObtained.then((data) => {
            data = JSON.parse(data)
            if(!data.error)
            {
                let datosUsuario = data.category;
                for (const key in datosUsuario) {
                    if (datosUsuario.hasOwnProperty(key)) {
                        if(datosUsuario[key] != null){
                            $(`#${$(this).attr('data-modal')} form #${key}`).val(datosUsuario[key]);
                        }
                        $(`#${key}`).trigger('change');
                    }
                }
                $(`#${$(this).attr('data-modal')} h5 span`).text(data.category.cat_evento);
                $(`#${$(this).attr('data-modal')} #exist`).removeClass();
                $(`#${$(this).attr('data-modal')} #exist`).addClass(`fa ${data.category.icono}`);
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
    function deleteCategory(event){
        event.preventDefault();
        let form = $(this).attr('id'),
            datos = getDataForm(form);
        if(typeof datos === 'object'){
            conexionPostController("controllers/categoriesController.php",datos).then(result => {
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
    // EDIT CATEGORY
    function editCategory(event){
        event.preventDefault();
        let form = $(this).attr('id'),
            datos = getDataForm(form);
        if(typeof datos === 'object'){
            conexionPostController("controllers/categoriesController.php",datos).then(result => {
                let data = JSON.parse(result);
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