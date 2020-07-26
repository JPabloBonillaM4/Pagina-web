<?php
// GET ALL CATEGORIES
function getCategories(){
    try {
        include_once('../includes/funciones/bd_conexion.php');
        mysqli_set_charset($conexion, 'utf8');
        return $conexion->query("SELECT * FROM categoria_evento");
    } catch (Exception $e) {
        $error = $e->getMessage();
        return '<pre>'.var_dump(array(
            'error'   => $error,
            'message' => 'Ocurrió un error al obtener los datos'
        )).'</pre>';
    }
}
// SAVE EVENT
function save($request){
    $name        = $request['cat_evento'];
    $icon        = $request['icono'];
    $error       = false;
    try {
        include_once('../functions/functions.php');
        $prepare_estatement = $conexion->prepare("INSERT INTO categoria_evento (cat_evento,icono) VALUES (?,?)");
        $prepare_estatement->bind_param("ss",$name,$icon);
        $prepare_estatement->execute();
        $id_registered = $prepare_estatement->insert_id;
        $errorData     = $prepare_estatement->error_list;
        if($id_registered > 0)
        {
            $message = 'Subcategoria registrada correctamente';
        } else {
            $error   = true;
            $message = 'Error en el proceso';
        }
        $prepare_estatement->close();
        $conexion->close();

        $respuesta = [
            'error'         => $error,
            'errorData'     => $errorData,
            'mensaje'       => $message,
            'id_registrado' => $id_registered
        ];
        
    } catch (Exception $e) {
        $respuesta = [
            'error'     => true,
            'errorData' => "Error: " . $e->getMessage(),
            'mensaje'   => 'Error en el registro'
        ];
    }

    return json_encode($respuesta);
}
// SAVE, EDIT, DELETE AND GET
if(isset($_POST['action']) || isset($_GET['action'])){
    $action = (isset($_POST['action'])) ? $_POST['action'] : $_GET['action'];

    switch ($action) {
        case 'guardar':
                die(save($_POST));
            break;

        case 'get':
                die(get($_GET['id']));
            break;
        
        case 'edit':
                die(edit($_POST));
            break;

        case 'delete':
                die(destroy($_POST['id']));
            break;
    }
    
}