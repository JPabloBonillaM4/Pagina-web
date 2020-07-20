<?php
    // GET ADMIN USER
    function get($id){
        $error = false;
        $msg   = null;
        $event  = null;
        if(filter_var($id,FILTER_VALIDATE_INT) && $id > 0)
        {
            try {
                include_once('../functions/functions.php');
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
                                    WHERE status = 1 ORDER BY eventos.id ASC;");
        } catch (Exception $e) {
            $error = $e->getMessage();
            return '<pre>'.var_dump(array(
                'error'   => $error,
                'message' => 'Ocurrió un error al obtener los datos'
            )).'</pre>';
        }
    }
    // GET CATEGORIES
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
