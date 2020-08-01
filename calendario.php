<?php include_once 'includes/templates/header.php'; ?>

    <section class="seccion contenedor"> 

        <h2>Calendario de eventos</h2>

        <?php
            try{ 
                require_once('includes/funciones/bd_conexion.php');//Mandar a llamar el archivo de conexion a la BD para poder realizar consultas, etc...

                $consulta_eventos = "SELECT eventos.id as evento_id, eventos.nombre as nombre_evento, eventos.fecha as fecha_evento, eventos.hora as hora_evento, cat_evento, icono, invitados.nombre as nombre_invitado, invitados.apellido as apellido_invitado ";
                $consulta_eventos .= " FROM eventos ";//consulta completa

                //PRIMER JOIN
                $consulta_eventos .= " INNER JOIN categoria_evento ";//Agregado del JOIN a la consulta
                $consulta_eventos .= " ON eventos.id_categoria = categoria_evento.id_categoria ";

                // SEGUNDO JOIN
                $consulta_eventos .= " INNER JOIN invitados ";
                $consulta_eventos .= " ON eventos.id_invitado = invitados.id_invitado ";

                $consulta_eventos .= " ORDER BY eventos.id ASC";

                $resultado_consulta = $conexion->query($consulta_eventos);//Variable que realiza la consulta a la BD

            }catch(\Exception $e){
                echo $e->getMessage();//Imprimir un mensaje al tener algun error
            }
        ?>  
 
        <div class="calendario">
            <?php  

                $calendario = array();

                while($eventos = $resultado_consulta->fetch_assoc())://fetch_assoc() => realiza la obtencion de datos de la consulta

                    $fecha = $eventos['fecha_evento'];

                    $evento = array(
                        'titulo' => $eventos['nombre_evento'],
                        'hora'  => $eventos['hora_evento'],
                        'categoria' => $eventos['cat_evento'],
                        'invitado' => $eventos['nombre_invitado'].' '.$eventos['apellido_invitado'],
                        'icono' => $eventos['icono']
                    );

                    $calendario[$fecha][] = $evento;
                ?>

            <?php endwhile; ?>

            <?php

                //IMPRIMIR TODOS LOS EVENTOS

                foreach($calendario as $dia => $lista_eventos):?>
                    
                    <h3>
                        <i class="fa fa-calendar"></i>
                        <?php 
                            setlocale(LC_TIME,'spanish');//Convierte la hora local a español
                            echo utf8_encode(strftime("%A, %d de %B del %Y",strtotime($dia)));//Formato de fecha
                        ?>
                    </h3>
                    
                    <?php foreach($lista_eventos as $evento): ?>


                        <div class="dia">

                            <!-- Titulo del evento -->
                            <p class="titulo">
                                <?php echo utf8_encode($evento['titulo']); ?>
                            </p>
                            <!-- Hora del evento -->
                            <p class="hora">
                                <i class="fa fa-clock"></i>
                                <?php echo utf8_encode($evento['hora']); ?>
                            </p>
                            <!-- Categoria del evento -->
                            <p>
                                <i class="fa <?php echo $evento['icono']; ?>"></i>
                                <?php echo utf8_encode($evento['categoria']); ?>
                            </p>
                            <!-- Invitado del evento -->
                            <p>
                                <i class="fa fa-user"></i>
                                <?php echo utf8_encode($evento['invitado']); ?>
                            </p>
                            
                        </div>

                    <?php endforeach;//Cierre del recorrido de todos los eventos por fecha ?>

            <?php  endforeach;//Cierre del recorrido de arreglo ?>


        </div>

        <?php
            $conexion->close();//Cierra la conexion con la BD
        ?>

    </section>

<?php include_once 'includes/templates/footer.php'; ?>