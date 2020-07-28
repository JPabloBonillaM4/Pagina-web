<?php
header("Content-Type: text/html;charset=utf-8");
// GET ALL GUESTS
function getGuests(){
    try {
        include_once('../includes/funciones/bd_conexion.php');
        mysqli_set_charset($conexion, 'utf8');
        return $conexion->query("SELECT * FROM invitados where status = 1");
    } catch (Exception $e) {
        $error = $e->getMessage();
        return '<pre>'.var_dump(array(
            'error'   => $error,
            'message' => 'Ocurrió un error al obtener los datos'
        )).'</pre>';
    }
}
// SAVE INVITED
function save($request){
    $name        = $request['nombre'];
    $last_name   = $request['apellido'];
    $description = $request['descripcion'];
    $directory   = '../img/invitados/';
    $image       = null;
    $error       = false;

    if(!is_dir($directory)){
        mkdir($directory, 0755, true);
    }

    if(move_uploaded_file($_FILES['imagen']['tmp_name'],$directory.$_FILES['imagen']['name'])){
        $image = $_FILES['imagen']['name'];
    } else {
        $respuesta = [
            'error'         => true,
            'errorData'     => error_get_last(),
            'mensaje'       => 'Ocurrió un error al subir la imagen'
        ];
    }
    try {
        include_once('../functions/functions.php');
        mysqli_set_charset($conexion, 'utf8');
        $prepare_estatement = $conexion->prepare("INSERT INTO invitados (nombre,apellido,descripcion,url_imagen) VALUES (?,?,?,?)");
        $prepare_estatement->bind_param("ssss",$name,$last_name,$description,$image);
        $prepare_estatement->execute();
        $id_registered = $prepare_estatement->insert_id;
        $errorData     = $prepare_estatement->error_list;
        if($id_registered > 0)
        {
            $message = 'invitado registrado correctamente';
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