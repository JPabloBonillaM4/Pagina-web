(()=>{
    // Acciones
    $('#crear-admin').on('submit',saveAdmin);
    $('#show_password').click(showPassword);
    $('#login-admin').on('submit',loginAdmin);
    $('.editAdmin').click(getAdminEditInfo);
    $('#edit_admin_info').on('submit',editAdmin);

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
    
    // LOGIN ADMIN
    function loginAdmin(event){
        event.preventDefault();
        let form  = $(this).attr('id')
            datos = getDataForm(form);
        
        if(typeof datos === 'object')
            conexionPostController("controllers/adminController.php",datos,form,'admin-main.php');
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
                        $(`#${$(this).attr('data-modal')} form #${key}`).val(datosUsuario[key])
                    }
                }
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
                console.log("Response from admin.js =>",data);
                // if(!data.error)
                //     $(`#${$(this).attr('data-modal')}`).modal('hide');
            }).catch((err) => {
                console.log(err);
            });
            
        }
    }
})();

