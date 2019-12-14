<?php if(isset($_POST['submit'])): 
    $nombre = utf8_decode($_POST['nombre']);//utf-8_decode()=>permite la decodificacion y aceptacion de cosas como el acento, etc....
    $apellido = utf8_decode($_POST['apellido']);
    $email = $_POST['email'];
    $regalo = $_POST['regalo'];
    $total_pedido = $_POST['total_pedido'];
    $fecha = date('Y-m-d H:i:s');
    //PEDIDOS
    $boletos = $_POST['boletos'];
    $camisas = $_POST['pedido_camisas'];
    $etiquetas = $_POST['pedido_etiquetas'];
    require_once 'includes/funciones/funciones.php';
    $pedido = productos_json($boletos,$camisas,$etiquetas);
    //EVENTOS
    $eventos = $_POST['registro'];
    $registro = eventos_json($eventos);
    try{
        require_once('includes/funciones/bd_conexion.php');
        //PREPARE STATEMENT PARA VOLVER UN QUERY SQL MAS SEGURO
        $stmt =  $conexion->prepare("INSERT INTO registrados (nombre_registrado,apellido_registrado,email_registrado,fecha_registro,pases_articulos,talleres_registrados,regalo,total_pagado) VALUES (?,?,?,?,?,?,?,?)");//SE PREPARA LA QUERY
        $stmt->bind_param("ssssssis",$nombre,$apellido,$email,$fecha,$pedido,$registro,$regalo,$total_pedido);//SE INSERTAN LOS DATOS
        $stmt->execute();//SE EJECUTA LA QUERY YA COMPLETA
        $stmt->close();//SE CIERRA EL STATEMENT
        $conexion->close();//SE CIERRA LA CONEXION A LA BD
        header('location: validar_registro.php?exitoso=1');//REDIRECCIONAR ANTES DE QUE SE MANDE CUALQUIER COSA AL NEVEGADOR
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    endif; ?><!--FIN DE LA INSERCION DE ELEMENTOS-->

<?php include_once 'includes/templates/header.php' ?>

<section class="seccion contenedor">

        <h2>Resumen registro</h2>

        <?php if(isset($_GET['exitoso'])):?>
            <?php if($_GET['exitoso'] == "1"):?>
                <div class="registro_exitoso">
                    <p><?php echo "Registro exitoso"; ?></p>
                </div>
            <?php endif;?>
        <?php endif;?>

</section>

<?php include_once 'includes/templates/footer.php' ?>