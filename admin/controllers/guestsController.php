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
// GET INVITED INFO
function get($id){
    $error   = false;
    $msg     = null;
    $invited = null;

    if(filter_var($id,FILTER_VALIDATE_INT) && $id > 0)
    {
        try {
            include_once('../functions/functions.php');
            mysqli_set_charset($conexion, 'utf8');
            $result  = $conexion->query("SELECT * FROM invitados WHERE id_invitado = $id");
            $invited = $result->fetch_assoc();
        } catch (Exception $e) {
            $error = true;
            $msg   = 'Error al obtener datos del invitado';
        }
    }else {
        $error = true;
        $msg   = 'Valor de consulta inválido';
    }

    return json_encode(array(
        'error'   => $error,
        'msg'     => $msg,
        'invited' => $invited
    ));

}
// EDIT ADMIN USER
function edit($request){
    $error       = false;
    $msg         = null;
    $name        = $request['nombre'];
    $last_name   = $request['apellido'];
    $description = $request['descripcion'];
    $directory   = '../img/invitados/';
    $image       = null;
    $id          = (int)$request['id_invitado'];

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
        if($_FILES['imagen']['size'] > 0){
            // QUERY CON IMAGEN
            $prepare_estatement = $conexion->prepare("UPDATE invitados SET nombre = ?, apellido = ?, descripcion = ?, url_imagen = ?, updated_at = NOW() WHERE id_invitado = ?");
            $prepare_estatement->bind_param("ssssi",$name,$last_name,$description,$image,$id);    
        } else {
            // QUERY SIN IMAGEN
            $prepare_estatement = $conexion->prepare("UPDATE invitados SET nombre = ?, apellido = ?, descripcion = ?, updated_at = NOW() WHERE id_invitado = ?");
            $prepare_estatement->bind_param("sssi",$name,$last_name,$description,$id);
        }
        $prepare_estatement->execute();
        $id_update = $prepare_estatement->insert_id;
        $errorData = $prepare_estatement->error_list;
        if($prepare_estatement->affected_rows){
            $msg = 'Invitado actualizado correctamente';
        } else {
            $error = true;
            $msg   = 'No se pudo actualizar el evento';
        }

        $prepare_estatement->close();
        $conexion->close();

        $response = array(
            'error'      => $error,
            'mensaje'    => $msg,
            'errorData'  => $errorData,
            'id_updated' => $id_update
        );    

    } catch (Exception $e) {
        $response = array(
            'error'     => true,
            'errorData' => "Error: " . $e->getMessage(),
            'mensaje'   => 'Error al procesar registro'
        );
    }

    return json_encode($response);
}
// DELETE ADMIN USER
function destroy($id){
    $error         = false;
    $msg           = null;
    $status_delete = 0;

    try {
        include_once('../functions/functions.php');
        $prepare_estatement = $conexion->prepare("UPDATE invitados SET status = ? WHERE id_invitado = ?");
        $prepare_estatement->bind_param("ii",$status_delete,$id);
        $prepare_estatement->execute();
        $id_delete = $prepare_estatement->insert_id;
        $errorData = $prepare_estatement->error_list;
        if($prepare_estatement->affected_rows){
            $msg = 'Invitado eliminado correctamente';
        } else {
            $error = true;
            $msg   = 'No se pudo eliminar el usuario';
        }

        $prepare_estatement->close();
        $conexion->close();

        $response = array(
            'error'      => $error,
            'mensaje'    => $msg,
            'errorData'  => $errorData,
            'id_deleted' => $id_delete
        );    

        $response = array(
            'error'  => $error,
            'mensaje'=> $msg,
            'id'     => $id
        );
    } catch (Exception $e) {
        $response = array(
            'error'     => true,
            'errorData' => "Error: " . $e->getMessage(),
            'mensaje'   => 'Error al procesar eliminado'
        );
    }

    return json_encode($response);
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