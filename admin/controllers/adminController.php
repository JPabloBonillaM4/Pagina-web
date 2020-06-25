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
    function save(){
        $hash_options = array(
            'cost'=>12
        );
    
        $name         = $_POST['name'];
        $user         = $_POST['user'];
        $email        = $_POST['email'];
        $password     = password_hash($_POST['password'],PASSWORD_BCRYPT,$hash_options);
        $error        = false;
        $message      = null;

        try {
            include_once('../functions/functions.php');

            $prepare_estatement = $conexion->prepare("INSERT INTO admins (user,name,password,email) VALUES (?,?,?,?)");
            $prepare_estatement->bind_param("ssss",$user,$name,$password,$email);
            $prepare_estatement->execute();
            $id_registered = $prepare_estatement->insert_id;
            $errorData     = $prepare_estatement->error_list;
            if($id_registered > 0)
            {
                $message = 'Administrador registrado correctamente';
            } else {
                $error   = true;
                $message = 'No pudo registrarse el usuario administrador';
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

        try {
            include_once('../functions/functions.php');
            if(!empty($request['password'])){
                $prepare_estatement = $conexion->prepare("UPDATE admins SET user = ?,name = ?, password = ?, email = ?, updated_at = NOW() WHERE id = ?");
                $prepare_estatement->bind_param("ssssi",$user,$name,$password,$email,$id);    
            } else {
                $prepare_estatement = $conexion->prepare("UPDATE admins SET user = ?,name = ?, email = ?, updated_at = NOW() WHERE id = ?");
                $prepare_estatement->bind_param("sssi",$user,$name,$email,$id);
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
                'error'      => true,
                'errorData' => "Error: " . $e->getMessage(),
                'mensaje'    => 'Error al procesar registro'
            );
        }

        return json_encode($response);
    }

    // DELETE ADMIN USER
    function delete(){
        $error = false;
        $msg   = 'Eliminar - Conexión correcta';
        $response = array(
            'error' => $error,
            'msg'   => $msg
        );

        return json_encode($response);
    }

    // SAVE, EDIT, DELETE AND GET
    if(isset($_POST['action']) || isset($_GET['action'])){
        $action = (isset($_POST['action'])) ? $_POST['action'] : $_GET['action'];

        switch ($action) {
            case 'guardar':
                    die(save());
                break;

            case 'get':
                    die(get($_GET['id']));
                break;
            
            case 'edit':
                    die(edit($_POST));
                break;

            case 'delete':
                    
                break;
        }
        
    }
    
    // LOGIN ADMIN
    if(isset($_POST['login_admin'])){
        $user_email = $_POST['correo_usuario'];
        $password_adm = $_POST['password'];
        $error        = false;
        $message      = null;

        try {
            include_once('../functions/functions.php');

            $prepare_estatement = $conexion->prepare("SELECT * FROM admins WHERE user = ? or email = ?");
            $prepare_estatement->bind_param("ss",$user_email,$user_email);
            $prepare_estatement->execute();
            $prepare_estatement->bind_result($id_admin,$user_admin,$name_admin,$password_admin,$email_admin,$status_admin,$updated_at);
            $errorData = $prepare_estatement->error_list;
            if($prepare_estatement->affected_rows){
                $exist = $prepare_estatement->fetch();
                if($exist)
                {
                    if(password_verify($password_adm,$password_admin)){
                        session_start();
                        $_SESSION['login']     = true;
                        $_SESSION['data_user'] = array(
                            'usuario' => $user_admin,
                            'nombre'  => $name_admin
                        );
                        $message = 'Bienvenido '.$name_admin;
                    }
                    else{
                        $error   = true;
                        $message = 'Usuario o contraseña incorrectas, verifique sus datos';
                    }
                }else {
                    $error   = true;
                    $message = 'Usuario inexistente, verifique sus datos';
                }
            }

            $prepare_estatement->close();
            $conexion->close();

            $respuesta = [
                'error'     => $error,
                'errorData' => $errorData,
                'mensaje'   => $message,
                'usuario'   => array(
                    "id"       => $id_admin,
                    "user"     => $user_admin,
                    "name"     => $name_admin,
                    "email"    => $email_admin
                )
            ];
        } catch (Exception $e) {
            $respuesta = [
                'error'     => true,
                'errorData' => "Error: " . $e->getMessage(),
                'mensaje'   => 'Error en la consulta'
            ];
        }

        die(json_encode($respuesta));
    }