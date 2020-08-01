<div class="programa-evento">
    <h2>Programa del evento</h2> 

    <?php 
        try{ 
            require_once('includes/funciones/bd_conexion.php');
            
            $consulta = "SELECT * FROM categoria_evento";
            $result = $conexion->query($consulta);

        }catch(Exception $e){
            $error = $e->getMessage();
        }
    ?> 
    <nav class="menu-programa"> 
 
        <?php while($categoria = $result->fetch_assoc()): ?>
            <a href="#<?php echo strtolower($categoria['cat_evento']);?>">
                <i class="fas <?php echo $categoria['icono'] ?>"></i>
                <?php echo $categoria['cat_evento'] ?>
            </a>
        <?php endwhile; ?>

    </nav>

    <?php 
        try{ 
            require_once('includes/funciones/bd_conexion.php');//Mandar a llamar el archivo de conexion a la BD para poder realizar consultas, etc...

            // PRIMER QUERY  
            $consulta_eventos = "SELECT eventos.id, eventos.nombre as nombre_evento, eventos.fecha as fecha_evento, eventos.hora as hora_evento, cat_evento, icono, invitados.nombre as nombre_invitado, invitados.apellido as apellido_invitado ";
            $consulta_eventos .= " FROM eventos ";//consulta completa

            $consulta_eventos .= " INNER JOIN categoria_evento ";//Agregado del JOIN a la consulta
            $consulta_eventos .= " ON eventos.id_categoria = categoria_evento.id_categoria ";

            $consulta_eventos .= " INNER JOIN invitados ";
            $consulta_eventos .= " ON eventos.id_invitado = invitados.id_invitado ";
            $consulta_eventos .= " AND eventos.id_categoria = 1";
            $consulta_eventos .= " ORDER BY eventos.id LIMIT 2;";

            // SEGUNDO QUERY
            $consulta_eventos .= "SELECT eventos.id, eventos.nombre as nombre_evento, eventos.fecha as fecha_evento, eventos.hora as hora_evento, cat_evento, icono, invitados.nombre as nombre_invitado, invitados.apellido as apellido_invitado ";
            $consulta_eventos .= " FROM eventos ";//consulta completa

            $consulta_eventos .= " INNER JOIN categoria_evento ";//Agregado del JOIN a la consulta
            $consulta_eventos .= " ON eventos.id_categoria = categoria_evento.id_categoria ";

            $consulta_eventos .= " INNER JOIN invitados ";
            $consulta_eventos .= " ON eventos.id_invitado = invitados.id_invitado ";
            $consulta_eventos .= " AND eventos.id_categoria = 2";
            $consulta_eventos .= " ORDER BY eventos.id LIMIT 2;";

            // TERCER QUERY

            $consulta_eventos .= "SELECT eventos.id, eventos.nombre as nombre_evento, eventos.fecha as fecha_evento, eventos.hora as hora_evento, cat_evento, icono, invitados.nombre as nombre_invitado, invitados.apellido as apellido_invitado ";
            $consulta_eventos .= " FROM eventos ";//consulta completa

            $consulta_eventos .= " INNER JOIN categoria_evento ";//Agregado del JOIN a la consulta
            $consulta_eventos .= " ON eventos.id_categoria = categoria_evento.id_categoria ";

            $consulta_eventos .= " INNER JOIN invitados ";
            $consulta_eventos .= " ON eventos.id_invitado = invitados.id_invitado ";
            $consulta_eventos .= " AND eventos.id_categoria = 3";
            $consulta_eventos .= " ORDER BY eventos.id LIMIT 2";

        }catch(\Exception $e){
            echo $e->getMessage();//Imprimir un mensaje al tener algun error
        }

    ?>

    <?php 

        $conexion->multi_query($consulta_eventos);

        do {
            $resultado = $conexion->store_result();
            $row = $resultado->fetch_all(MYSQLI_ASSOC); ?> 

            <?php 
                $i = 1; 
                foreach($row as $evento):      
            ?>

                <?php if(($i % 2) == 1): ?>
                    <div id="<?php echo strtolower($evento['cat_evento']); ?>" class="info-curso ocultar clearfix">
                <?php endif; ?>

                    <div class="detalle-evento">
                        <h3><?php echo utf8_encode($evento['nombre_evento']); ?></h3>
                        <p><i class="fas fa-clock"></i><?php echo $evento['hora_evento'];?></p>
                        <p><i class="fas fa-calendar-alt"></i><?php echo $evento['fecha_evento'];?></p>
                        <p><i class="fas fa-user-alt"></i><?php echo $evento['nombre_invitado'].' '.$evento['apellido_invitado'];?></p>
                    </div>

                <?php if(($i % 2) == 0): ?>
                        <a href="calendario.php" class="boton float-right">Ver todos</a>
                    </div>
                <?php endif; ?>
               
                <?php $i++; ?>
            <?php 
                endforeach; 
                $resultado->free();
            ?>

            
        <?php } while ($conexion->more_results() && $conexion->next_result()); ?>

</div>