<?php
 // LOGIN ADMIN
 if(isset($_POST['login_admin'])){
    $user_email = $_POST['correo_usuario'];
    $password_adm = $_POST['password'];
    $error        = false;
    $message      = null;

    try {
        include_once('../includes/funciones/bd_conexion.php');

        $prepare_estatement = $conexion->prepare("SELECT * FROM admins WHERE status = 1 and user = ? or email = ?");
        $prepare_estatement->bind_param("ss",$user_email,$user_email);
        $prepare_estatement->execute();
        $prepare_estatement->bind_result($id_admin,$user_admin,$name_admin,$password_admin,$email_admin,$status_admin,$level,$updated_at);
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
                        'nombre'  => $name_admin,
                        'nivel'   => $level
                    );
                    $message = 'Bienvenido '.$name_admin;
                }
                else{
                    $error   = true;
                    $message = 'Usuario o contraseña incorrectas, verifique sus datos';
                }
            }else {
                $error   = true;
                $message = 'Usuario inexistente o eliminado, verifique sus datos';
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