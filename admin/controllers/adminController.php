<?php

    header("Content-Type: text/html;charset=utf-8");

    // GET ALL ADMIN USERS
    function getAdminUsers(){

        try {
            include_once('../includes/funciones/bd_conexion.php');
            return $conexion->query("SELECT id,user,name,email FROM admins WHERE status = 1 ORDER BY id ASC");
        } catch (Exception $e) {
            $error = $e->getMessage();
            return '<pre>'.var_dump(array(
                'error'   => $error,
                'message' => 'Ocurrió un error al obtener los datos'
            )).'</pre>';
        }

    }

    // SAVE ADMIN USER
    function save($request){
        $hash_options = array(
            'cost'=>12
        );
    
        $name     = $request['name'];
        $user     = $request['user'];
        $email    = $request['email'];
        $password = password_hash($request['password'],PASSWORD_BCRYPT,$hash_options);
        $error    = false;
        $message  = null;
        $level    = 1;

        try {
            include_once('../functions/functions.php');
            if(isset($request['level'])){
                $prepare_estatement = $conexion->prepare("INSERT INTO admins (user,name,password,email,level) VALUES (?,?,?,?,?)");
                $prepare_estatement->bind_param("ssssi",$user,$name,$password,$email,$level);    
            }else{
                $prepare_estatement = $conexion->prepare("INSERT INTO admins (user,name,password,email) VALUES (?,?,?,?)");
                $prepare_estatement->bind_param("ssss",$user,$name,$password,$email);    
            }
            $prepare_estatement->execute();
            $id_registered = $prepare_estatement->insert_id;
            $errorData     = $prepare_estatement->error_list;
            if($id_registered > 0)
            {
                $message = 'Administrador registrado correctamente';
            } else {
                $error   = true;
                $message = 'Error en el proceso';
                if($prepare_estatement->errno == 1062)
                    $message .= ', el usuario ya se encuentra registrado';
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

        $error = false;
        $msg   = null;
        $user  = null;

        if(filter_var($id,FILTER_VALIDATE_INT) && $id > 0)
        {
            try {
                include_once('../functions/functions.php');
                $result = $conexion->query("SELECT * FROM admins WHERE id = $id");
                $user   = $result->fetch_assoc();
            } catch (Exception $e) {
                $error = true;
                $msg   = 'Error al obtener datos del usuario';
            }
        }else {
            $error = true;
            $msg   = 'Valor de consulta inválido';
        }

        return json_encode(array(
            'error' => $error,
            'msg'   => $msg,
            'user'  => $user
        ));

    }

    // EDIT ADMIN USER
    function edit($request){
        $hash_options = array(
            'cost'=>12
        );

        $error    = false;
        $msg      = null;
        $name     = $request['name'];
        $user     = $request['user'];
        $email    = $request['email'];
        $password = password_hash($request['password'],PASSWORD_BCRYPT,$hash_options);
        $id       = (int)$request['id'];
        $level    = 1;
        $noLevel  = 0;

        try {
            include_once('../functions/functions.php');
            if(!empty($request['password']) && isset($request['level'])){
                $prepare_estatement = $conexion->prepare("UPDATE admins SET user = ?,name = ?, password = ?, email = ?,level = ?, updated_at = NOW() WHERE id = ?");
                $prepare_estatement->bind_param("ssssii",$user,$name,$password,$email,$level,$id);
            } else if(!empty($request['password'])){
                $prepare_estatement = $conexion->prepare("UPDATE admins SET user = ?,name = ?, password = ?, email = ?,level = ?, updated_at = NOW() WHERE id = ?");
                $prepare_estatement->bind_param("ssssii",$user,$name,$password,$email,$noLevel,$id);    
            } else if(isset($request['level'])){
                $prepare_estatement = $conexion->prepare("UPDATE admins SET user = ?,name = ?, email = ?, level = ?, updated_at = NOW() WHERE id = ?");
                $prepare_estatement->bind_param("sssii",$user,$name,$email,$level,$id);
            }else{
                $prepare_estatement = $conexion->prepare("UPDATE admins SET user = ?,name = ?, email = ?,level = ?, updated_at = NOW() WHERE id = ?");
                $prepare_estatement->bind_param("sssii",$user,$name,$email,$noLevel,$id);
            }
            $prepare_estatement->execute();
            $id_update = $prepare_estatement->insert_id;
            $errorData = $prepare_estatement->error_list;
            if($prepare_estatement->affected_rows){
                $msg = 'Usuario actualizado correctamente';
            } else {
                $error = true;
                $msg   = 'No se pudo actualizar el usuario';
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
            $prepare_estatement = $conexion->prepare("UPDATE admins SET status = ? WHERE id = ?");
            $prepare_estatement->bind_param("ii",$status_delete,$id);
            $prepare_estatement->execute();
            $id_delete = $prepare_estatement->insert_id;
            $errorData = $prepare_estatement->error_list;
            if($prepare_estatement->affected_rows){
                $msg = 'Usuario eliminado correctamente';
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
                'mensaje'   => 'Error al procesar registro'
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