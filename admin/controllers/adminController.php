<?php

    header("Content-Type: text/html;charset=utf-8");

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

    function editAdmin(){
        return 'Editar - Conexión correcta';
    }

    function deleteAdmin(){
        return 'ELiminar - Conexión correcta';
    }

    if(isset($_POST['agregar-admin']))
    {
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

        die(json_encode($respuesta));
    }
    
    if(isset($_POST['login_admin']))
    {
        $user_email = $_POST['correo_usuario'];
        $password_adm = $_POST['password'];
        $error        = false;
        $message      = null;

        try {
            include_once('../functions/functions.php');

            $prepare_estatement = $conexion->prepare("SELECT * FROM admins WHERE user = ? or email = ?");
            $prepare_estatement->bind_param("ss",$user_email,$user_email);
            $prepare_estatement->execute();
            $prepare_estatement->bind_result($id_admin,$user_admin,$name_admin,$password_admin,$email_admin);
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
                    "id"       =>$id_admin,
                    "user"     =>$user_admin,
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

    if(isset($_POST['edit-admi'])){

    }

    if(isset($_POST['delete-admi'])){

    }