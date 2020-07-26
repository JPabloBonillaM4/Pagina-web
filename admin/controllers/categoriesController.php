<?php
// GET ALL CATEGORIES
function getCategories(){
    try {
        include_once('../includes/funciones/bd_conexion.php');
        mysqli_set_charset($conexion, 'utf8');
        return $conexion->query("SELECT * FROM categoria_evento where status = 1");
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
// GET ADMIN USER
function get($id){

    $error    = false;
    $msg      = null;
    $category = null;
    if(filter_var($id,FILTER_VALIDATE_INT) && $id > 0)
    {
        try {
            include_once('../functions/functions.php');
            $result   = $conexion->query("SELECT * FROM categoria_evento WHERE id_categoria = $id");
            $category = $result->fetch_assoc();
        } catch (Exception $e) {
            $error = true;
            $msg   = 'Error al obtener datos del usuario';
        }
    }else {
        $error = true;
        $msg   = 'Valor de consulta inválido';
    }

    return json_encode(array(
        'error'     => $error,
        'msg'       => $msg,
        'category'  => $category
    ));

}
// EDIT ADMIN USER
function edit($request){
    $name  = $request['cat_evento'];
    $icon  = $request['icono'];
    $id    = (int)$request['id_categoria'];
    $error = false;

    try {
        include_once('../functions/functions.php');
        $prepare_estatement = $conexion->prepare("UPDATE categoria_evento SET cat_evento = ?,icono = ?, updated_at = NOW() WHERE id_categoria = ?");
        $prepare_estatement->bind_param("ssi",$name,$icon,$id);
        $prepare_estatement->execute();
        $id_update = $prepare_estatement->insert_id;
        $errorData = $prepare_estatement->error_list;
        if($prepare_estatement->affected_rows){
            $msg = 'Categoria actualizada correctamente';
        } else {
            $error = true;
            $msg   = 'No se pudo actualizar la categoria';
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
        $prepare_estatement = $conexion->prepare("UPDATE categoria_evento SET status = ? WHERE id_categoria = ?");
        $prepare_estatement->bind_param("ii",$status_delete,$id);
        $prepare_estatement->execute();
        $id_delete = $prepare_estatement->insert_id;
        $errorData = $prepare_estatement->error_list;
        if($prepare_estatement->affected_rows){
            $msg = 'Categoria eliminada correctamente';
        } else {
            $error = true;
            $msg   = 'No se pudo eliminar la categoria';
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