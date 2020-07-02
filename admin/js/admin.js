(()=>{
    // Acciones
    $('#crear-admin').on('submit',saveAdmin);
    $('#login-admin').on('submit',loginAdmin);
    $('.editAdmin').click(getAdminEditInfo);
    $('.deleteAdmin').click(modalDelete);
    $('#edit_admin_info').on('submit',editAdmin);
    $('#delete_user_admin').on('submit',deleteAdmin);

    // LOGIN ADMIN
    function loginAdmin(event){
        event.preventDefault();
        let form  = $(this).attr('id')
            datos = getDataForm(form);
        
        if(typeof datos === 'object')
            conexionPostController("controllers/adminController.php",datos,form,'admin-main.php');
    }
    
    // SAVE NEW ADMIN
    function saveAdmin(event){
        event.preventDefault();
        let form  = $(this).attr('id'),
            datos = getDataForm(form);
        if(typeof datos === 'object')
        {
            if(!emailValidation($(`#${form} #email`)))
                return false;

            conexionPostController("controllers/adminController.php",datos,form);
        }
    }
    
    // GET ADMIN INFO BY USER
    function getAdminEditInfo(event){
        event.preventDefault();
        const id           = $(this).attr('data-id'),
              action       = $(this).attr('data-action'),
              dataObtained = conexionGetController("controllers/adminController.php?id=" + id + "&action=" + action);

        dataObtained.then((data) => {
            data = JSON.parse(data)
            if(!data.error)
            {
                let datosUsuario = data.user;
                for (const key in datosUsuario) {
                    if (datosUsuario.hasOwnProperty(key)) {
                        if(key != 'password')
                            $(`#${$(this).attr('data-modal')} form #${key}`).val(datosUsuario[key])
                    }
                }
                $(`#${$(this).attr('data-modal')} h5 span`).text(data.user.name);
                $(`#${$(this).attr('data-modal')}`).modal('show');
            } else {
                showAlert('ERROR',data.msg,'red');
            }
        }).catch((err) => {
            console.log(err);
        });
    }

    // EDIT ADMIN USER
    function editAdmin(event){
        event.preventDefault();
        let form = $(this).attr('id'),
            datos = getDataForm(form);
        if(typeof datos === 'object')
        {
            var response = conexionPostController("controllers/adminController.php",datos);
            response.then((result) => {
                let data = JSON.parse(result);
                if(!data.error){
                    setTimeout(() => {
                        $(`#${$(this).attr('data-modal')}`).modal('hide');
                        window.location.reload();
                    }, 2000);
                }
            }).catch((err) => {
                console.log(err);
            });
            
        }
    }

    // MODAL DELETE
    function modalDelete(event){
        event.preventDefault();
        $(`#${$(this).attr('data-modal')} form input[id=id_delete]`).val($(this).attr('data-id'));
        $(`#${$(this).attr('data-modal')}`).modal('show');
    }

    // DELETE ADMIN
    function deleteAdmin(event){
        event.preventDefault();
        let form = $(this).attr('id'),
            datos = getDataForm(form);

        if(typeof datos === 'object'){
            conexionPostController("controllers/adminController.php",datos).then(result => {
                let data = JSON.parse(result);
                if(!data.error){
                    $(`#${$(this).attr('data-modal')}`).modal('hide');
                    jQuery(`[data-id="${data.id}"]`).parents('tr').remove();
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                }
            });
        }
    }
})();

