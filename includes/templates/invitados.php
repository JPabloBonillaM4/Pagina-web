<?php
    try{ 
        require_once('includes/funciones/bd_conexion.php');//Mandar a llamar el archivo de conexion a la BD para poder realizar consultas, etc...
        mysqli_set_charset($conexion, 'utf8');
        $consulta_invitados = "SELECT * FROM invitados WHERE status = 1";

        $resultado_de_consulta = $conexion->query($consulta_invitados);

    }catch(\Exception $e){ 
        echo $e->getMessage();//Imprimir un mensaje al tener algun error
    }
?>  

<section class="invitados contenedor seccion">
    <h2>Nuestros invitados</h2>
    <ul class="lista-invitados">
        <?php while($invitados = $resultado_de_consulta->fetch_assoc()):?>
            <li>
                <div class="invitado">
                    <a class="invitado-info" href="#invitado<?php echo $invitados['id_invitado']; ?>">
                        <img src="../admin/img/invitados/<?php echo $invitados['url_imagen']; ?>" alt="invitado #6">
                        <p><?php echo $invitados['nombre'].' '.$invitados['apellido']; ?></p>
                    </a>
                </div>
            </li>

            <div style="display: none">
                <div class="invitado-info" id="invitado<?php echo $invitados['invitado_id']; ?>">
                    <h2><?php echo $invitados['nombre'].' '.$invitados['apellido']; ?></h2>
                    <img src="../admin/img/invitados/<?php echo $invitados['url_imagen']; ?>" alt="invitado #6">
                    <p><?php echo $invitados['descripcion']; ?></p>
                </div>
            </div>

        <?php endwhile; ?>
    </ul>
</section>

<?php
    $conexion->close();//Cierra la conexion con la BD
?>