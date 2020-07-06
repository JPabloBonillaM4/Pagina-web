$('#login-admin').on('submit',loginAdmin);
// LOGIN ADMIN
function loginAdmin(event){
    event.preventDefault();
    let form  = $(this).attr('id')
        datos = getDataForm(form);
    
    if(typeof datos === 'object')
        conexionPostController("login-admin.php",datos,form,'admin-main.php');
}