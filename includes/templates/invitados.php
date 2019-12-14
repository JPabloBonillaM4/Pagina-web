<?php
    try{ 
        require_once('includes/funciones/bd_conexion.php');//Mandar a llamar el archivo de conexion a la BD para poder realizar consultas, etc...

        $consulta_invitados = "SELECT * FROM invitados";

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
                    <a class="invitado-info" href="#invitado<?php echo $invitados['invitado_id']; ?>">
                        <img src="img/<?php echo $invitados['url_imagen']; ?>" alt="invitado #6">
                        <p><?php echo $invitados['nombre_invitado'].' '.$invitados['apellido_invitado']; ?></p>
                    </a>
                </div>
            </li>

            <div style="display: none">
                <div class="invitado-info" id="invitado<?php echo $invitados['invitado_id']; ?>">
                    <h2><?php echo $invitados['nombre_invitado'].' '.$invitados['apellido_invitado']; ?></h2>
                    <img src="img/<?php echo $invitados['url_imagen']; ?>" alt="invitado #6">
                    <p><?php echo $invitados['descripcion']; ?></p>
                </div>
            </div>

        <?php endwhile; ?>
    </ul>
</section>

<?php
    $conexion->close();//Cierra la conexion con la BD
?>