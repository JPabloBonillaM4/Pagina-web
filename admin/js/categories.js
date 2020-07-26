(()=>{
    $('#crear-subcategory').on('submit',saveSubcategory);

    // SAVE NEW SUBCATEGORY
    function saveSubcategory(event){
        event.preventDefault();
        let form  = $(this).attr('id'),
            datos = getDataForm(form);
        if(typeof datos === 'object')
        {
            console.log("data =>",datos);
            conexionPostController("controllers/categoriesController.php",datos,form).then(function(){
                //Nuevo código aquí
            });
        }
    }
})();