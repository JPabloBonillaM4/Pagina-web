<?php
    // SAVE EVENT
    function save($request){
        $name        = $request['event'];
        $date        = new DateTime($request['date']);
        $date_format = $date->format('Y-m-d');
        $time        = $request['time'];
        $category    = (int)$request['category'];
        $invitate    = (int)$request['invitate'];
        $error       = false;
        try {
            include_once('../functions/functions.php');
            $prepare_estatement = $conexion->prepare("INSERT INTO eventos (nombre,fecha,hora,id_categoria,id_invitado) VALUES (?,?,?,?,?)");
            $prepare_estatement->bind_param("sssii",$name,$date_format,$time,$category,$invitate);
            $prepare_estatement->execute();
            $id_registered = $prepare_estatement->insert_id;
            $errorData     = $prepare_estatement->error_list;
            if($id_registered > 0)
            {
                $message = 'Evento registrado correctamente';
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
    // GET EVENT
    function get($id){
        $error = false;
        $msg   = null;
        $event  = null;
        if(filter_var($id,FILTER_VALIDATE_INT) && $id > 0)
        {
            try {
                include_once('../functions/functions.php');
                mysqli_set_charset($conexion, 'utf8');
                $result = $conexion->query("SELECT * FROM eventos WHERE id = $id");
                $event   = $result->fetch_assoc();
            } catch (Exception $e) {
                $error = true;
                $msg   = 'Error al obtener datos del evento';
            }
        }else {
            $error = true;
            $msg   = 'Valor de consulta inválido';
        }
        return json_encode(array(
            'error' => $error,
            'msg'   => $msg,
            'event' => $event
        ));
    }
    // GET ALL EVENTS
    function getEvents(){
        try {
            include_once('../includes/funciones/bd_conexion.php');
            mysqli_set_charset($conexion, 'utf8');
            return $conexion->query("SELECT eventos.id as id, eventos.nombre AS nombre, eventos.fecha AS fecha, eventos.hora AS hora,
                                            categoria_evento.cat_evento AS nombre_evento, eventos.clave AS clave,
                                            CONCAT(invitados.nombre,' ',invitados.apellido) AS nombre_invitado
                                            FROM eventos 
                                    INNER JOIN categoria_evento ON eventos.id_categoria = categoria_evento.id_categoria 
                                    INNER JOIN invitados ON eventos.id_invitado = invitados.id_invitado
                                    WHERE eventos.status = 1 ORDER BY eventos.id ASC;");
        } catch (Exception $e) {
            $error = $e->getMessage();
            return '<pre>'.var_dump(array(
                'error'   => $error,
                'message' => 'Ocurrió un error al obtener los datos'
            )).'</pre>';
        }
    }
    // DELETE EVENT
    function destroy($id){
        $error         = false;
        $msg           = null;
        $status_delete = 0;

        try {
            include_once('../functions/functions.php');
            $prepare_estatement = $conexion->prepare("UPDATE eventos SET status = ? WHERE id = ?");
            $prepare_estatement->bind_param("ii",$status_delete,$id);
            $prepare_estatement->execute();
            $id_delete = $prepare_estatement->insert_id;
            $errorData = $prepare_estatement->error_list;
            if($prepare_estatement->affected_rows){
                $msg = 'Evento eliminado correctamente';
            } else {
                $error = true;
                $msg   = 'No se pudo eliminar el evento';
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
    // EDIT EVENT
    function edit($request){
        $name        = $request['nombre'];
        $date        = new DateTime($request['fecha']);
        $date_format = $date->format('Y-m-d');
        $time        = $request['hora'];
        $category    = (int)$request['id_categoria'];
        $invitate    = (int)$request['id_invitado'];
        $id          = $request['id'];
        $error       = false;

        try {
            include_once('../functions/functions.php');
            $prepare_estatement = $conexion->prepare("UPDATE eventos SET nombre = ?,fecha = ?, hora = ?,id_categoria = ?,id_invitado = ?, updated_at = NOW() WHERE id = ?");
            $prepare_estatement->bind_param("ssssii",$name,$date_format,$time,$category,$invitate,$id);
            $prepare_estatement->execute();
            $id_update = $prepare_estatement->insert_id;
            $errorData = $prepare_estatement->error_list;
            if($prepare_estatement->affected_rows){
                $msg = 'Evento actualizado correctamente';
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
                'mensaje'   => 'Error al procesar evento'
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
    // GET CATEGORIES
    function getCategories(){
        try {
            include('../includes/funciones/bd_conexion.php');
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
    // GET INVITATES
    function getInvitates(){
        try {
            include('../includes/funciones/bd_conexion.php');
            mysqli_set_charset($conexion, 'utf8');
            return $conexion->query("SELECT * FROM invitados");
        } catch (Exception $e) {
            $error = $e->getMessage();
            return '<pre>'.var_dump(array(
                'error'   => $error,
                'message' => 'Ocurrió un error al obtener los datos'
            )).'</pre>';
        }
    }
