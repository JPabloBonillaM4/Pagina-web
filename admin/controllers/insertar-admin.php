<?php

    header("Content-Type: text/html;charset=utf-8");

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

            $respuesta = [
                'error'         => $error,
                'errorData'     => $errorData,
                'mensaje'       => $message,
                'id_registrado' => $id_registered
            ];

            $prepare_estatement->close();
            $conexion->close();
            
        } catch (Exception $e) {
            $respuesta = [
                'error'     => true,
                'errorData' => "Error: " . $e->getMessage(),
                'mensaje'   => 'Error en el registro'
            ];
        }

        die(json_encode($respuesta));
    }