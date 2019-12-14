<!-- LLAMAR AL TEMPLATE DEL HEADER -->
<?php include_once 'includes/templates/header.php'; ?>

  <!-- MAIN PRINCIPAL -->

  <!-- SEGUNDA SECCCION -->
  <section class="seccion contenedor">
    <h2>La mejor conferencia de diseño web en español</h2>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. A quisquam placeat voluptatibus sint neque, autem laborum facilis, dignissimos, reprehenderit itaque ab? Quia, blanditiis ad. Dolorem necessitatibus non repudiandae expedita voluptates.</p>
  </section>
 
  <!-- TERCERA SECCION -->
  <section class="programa"> 
    <div class="contenedor-video">
      <video autoplay loop poster="img/bg-talleres.jpg">
        <source src="video/video.mp4" type="video/mp4">
        <source src="video/video.webm" type="video/webm">
        <source src="video/video.ogv" type="video/ogv"> 
      </video>
    </div>

    <div class="contenido-programa"> 
    
      <div class="contenedor">
        
          <?php include_once 'includes/templates/programa_evento.php'; ?>
  
      </div>
  
    </div>

  </section>

  <!-- CUARTA SECCION -->
  <?php include_once 'includes/templates/invitados.php'; ?>

  <!-- QUINTA SECCION -->
  <div class="contador parallax seccion">
    <div class="contenedor">
      <ul class="resumen-evento clearfix">
        <li><p class="numero">0</p> Invitados</li>
        <li><p class="numero">0</p> Talleres</li>
        <li><p class="numero">0</p> Dias</li>
        <li><p class="numero">0</p> Conferencias</li>
      </ul>
    </div>
  </div>
  <div class="botones-contador">
      <a href="#" id="mostrar_contador" class="boton">Mostrar eventos</a>
      <a href="#" id="ocultar-contador" class="boton">Ocultar eventos</a>
  </div>
  
  

  <!-- LISTA DE PRECIOS -->
  <section class="precios seccion">
    <h2>Precios</h2>
    <div class="contenedor">
      <ul class="lista-precios">

        <li>
          <div class="tabla-precio">
            <h3>Pase por dia</h3>
            <p class="numero">$30</p>
            <ul>
              <li><i class="far fa-check-square"></i> Bocadillos gratis</li>
              <li><i class="far fa-check-square"></i> Todas las conferencias</li>
              <li><i class="far fa-check-square"></i> Todos los talleres</li>
            </ul>
            <a href="#" class="boton hollow">Comprar</a>
          </div>
        </li>

        <li>
          <div class="tabla-precio">
            <h3>Todos los dias</h3>
            <p class="numero">$50</p>
            <ul>
              <li><i class="far fa-check-square"></i> Bocadillos gratis</li>
              <li><i class="far fa-check-square"></i> Todas las conferencias</li>
              <li><i class="far fa-check-square"></i> Todos los talleres</li>
            </ul>
            <a href="#" class="boton">Comprar</a>
          </div>
        </li>

        <li>
          <div class="tabla-precio">
            <h3>Pase por 2 dias</h3>
            <p class="numero">$45</p>
            <ul>
              <li><i class="far fa-check-square"></i> Bocadillos gratis</li>
              <li><i class="far fa-check-square"></i> Todas las conferencias</li>
              <li><i class="far fa-check-square"></i> Todos los talleres</li>
            </ul>
            <a href="#" class="boton hollow">Comprar</a>
          </div>
        </li>

      </ul>
    </div>
  </section>

  <!-- MAPA DE GOOGLE MAPS -->
  <div id="mapa" class="mapa"></div>

  <!-- TESTIMONIALES -->
  <section class="seccion testi">
    <h2>Testimoniales</h2>
    <div class="testimoniales contenedor">
      <div class="testimonial">
        <blockquote>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos cumque in labore, amet ipsum expedita. Quidem facere nulla error natus laboriosam asperiores facilis, iusto saepe expedita, iste labore vitae esse?</p>
          <footer class="info-testimonial clearfix">
            <img src="img/testimonial.jpg" alt="imagen testimonial">
            <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
          </footer>
        </blockquote>  
      </div>

      <div class="testimonial">
        <blockquote>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos cumque in labore, amet ipsum expedita. Quidem facere nulla error natus laboriosam asperiores facilis, iusto saepe expedita, iste labore vitae esse?</p>
          <footer class="info-testimonial clearfix">
            <img src="img/testimonial.jpg" alt="imagen testimonial">
            <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
          </footer>
        </blockquote>
      </div>

      <div class="testimonial">
        <blockquote> 
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos cumque in labore, amet ipsum expedita. Quidem facere nulla error natus laboriosam asperiores facilis, iusto saepe expedita, iste labore vitae esse?</p>
          <footer class="info-testimonial clearfix">
            <img src="img/testimonial.jpg" alt="imagen testimonial">
            <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
          </footer>
        </blockquote>
      </div>
    </div>

  </section>

  <!-- NEWSLETTER -->
  <div class="newsletter parallax">
    <div class="contenido contenedor">
      <p>Registrate al newsletter:</p>
      <h3>Gdlwebcam</h3>
      <a href="#mc_embed_signup" class="boton_newsletter boton transparente">Registro</a>
    </div>
  </div>

  <!-- FALTAN -->
  <section class="seccion regresiva">
    <h2>Faltan</h2>
    <div class="cuenta-regresiva contenedor">
      <ul class="clearfix">
        <li><p id="dias" class="numero"></p> Dias</li>
        <li><p id="horas" class="numero"></p> Horas</li>
        <li><p id="minutos" class="numero"></p> Minutos</li>
        <li><p id="segundos" class="numero"></p> Segundos</li>
      </ul>
    </div>
  </section>

<!-- LLAMAR AL TEMPLATE DEL FOOTER  -->
<?php include_once 'includes/templates/footer.php' ?>
