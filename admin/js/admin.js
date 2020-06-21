(()=>{
    // Acciones
    $('#crear-admin').on('submit',saveAdmin);
    $('#show_password').click(showPassword);
    $('#login-admin').on('submit',loginAdmin);
    $('.editAdmin').click(getAdminEditInfo);
    $('.deleteAdmin').click(openModal);

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

    function getAdminEditInfo(event){
        event.preventDefault();
        const id           = $(this).attr('data-id'),
              action       = $(this).attr('data-action'),
              dataObtained = conexionGetController("controllers/adminController.php?id=" + id + "&action=" + action);

        dataObtained.then((data) => {
            console.log(JSON.parse(data));
        }).catch((err) => {
            console.log(err);
        });
    }
})();

