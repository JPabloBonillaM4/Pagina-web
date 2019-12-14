  (function(){
      "use strict";
      document.addEventListener("DOMContentLoaded",function(){

          if(document.getElementById('calcular')){
            //DATOS USUARIO
            let nombre = document.getElementById("nombre"),
            apellido = document.getElementById("apellido"),
            mail = document.getElementById("email"),
            //PASES
            pase_dia = document.getElementById("pase_dia"),
            pase_completo = document.getElementById("pase_completo"),
            pase_2_dias = document.getElementById("pase_2_dias"),
            //BOTONES Y DIVS
            calcular = document.getElementById("calcular"),
            errorDiv = document.getElementById("error"),
            botonRegistro = document.getElementById("btn_registro"),
            lista_productos = document.getElementById("lista_productos"),
            //ETIQUETAS
            mostrarTotal = document.getElementById("suma_total"),  
            regalo = document.getElementById("regalo"),
            etiquetas = document.getElementById("etiquetas"),
            camisa_evento = document.getElementById("camisa_evento");
                
            //EVENTOS PARA FUNCIONES    
            calcular.addEventListener('click',calcularMontos);//EVENTO AL HACER CLICK SOBRE EL ELEMENTO
            pase_dia.addEventListener("blur",mostrarDatos);//EVENTO AL SALIR DEL ELEMENTO
            pase_2_dias.addEventListener("blur",mostrarDatos);
            pase_completo.addEventListener("blur",mostrarDatos);
            nombre.addEventListener("blur",validarCampos);
            apellido.addEventListener("blur",validarCampos);
            mail.addEventListener("blur",validarCampos);
            mail.addEventListener("blur",validarMail);

            botonRegistro.disabled = true;
            botonRegistro.style.transition = "all 1s ease";
            botonRegistro.style.backgroundColor = "grey";
            botonRegistro.style.border = "1px solid grey";

            // FUNCION(calcularMontos)
            function calcularMontos(event){
              event.preventDefault();

              if(regalo.value == ""){

                alert("No ha seleccionado un regalo");
                regalo.focus();

              }else{ 

                let boletosDia = Number(pase_dia.value,10) || 0,
                    boletosCompleto = Number(pase_completo.value,10) || 0,
                    boletos2Dias =Number(pase_2_dias.value,10) || 0,
                    cantidadCamisas = Number(camisa_evento.value,10) || 0,
                    cantidadEtiquetas = Number(etiquetas.value,10) || 0,
                    //TOTAL A PAGAR
                    totalPagar = (boletosDia * 30) + (boletos2Dias * 45) + (boletosCompleto * 50) + ((cantidadCamisas * 10) * 0.93) + (cantidadEtiquetas * 2);  
                
                let articulos = [];

                if(boletosDia >= 1){
                  articulos.push(`Pases por dia: ${boletosDia}`);
                }
                if(boletos2Dias >= 1){
                  articulos.push(`Pases por 2 dias: ${boletos2Dias}`);
                }
                if(boletosCompleto >= 1){
                  articulos.push(`Pases completos: ${boletosCompleto}`);
                }
                if(cantidadCamisas >= 1){
                  articulos.push(`Camisas: ${cantidadCamisas}`);
                }
                if(cantidadEtiquetas >= 1){
                  articulos.push(`Etiquetas: ${cantidadEtiquetas}`);
                }

                lista_productos.innerHTML = "";
                articulos.forEach(articulo => {
                  lista_productos.innerHTML += `
                        <li>-> ${articulo}</li>
                    `;
                });

                lista_productos.style.display = "block";

                mostrarTotal.innerText = `$${totalPagar.toFixed(2)}`;

                if(totalPagar > 0){
                  botonRegistro.disabled = false;
                  botonRegistro.style.backgroundColor = "#fe4918";
                  botonRegistro.style.border = "1px solid #fe4918";

                  document.getElementById("total_pedido").value = totalPagar;
                }
                
              }
            }

            // VALIDAR CLICK EN CALCULAR ANTES DE DAR CLICK EN PAGAR
            
            
            //FUNCION(mostrarDatos)
            function mostrarDatos(){
              let boletosDia = Number(pase_dia.value,10) || 0,
                  boletosCompleto = Number(pase_completo.value,10) || 0,
                  boletos2Dias =Number(pase_2_dias.value,10) || 0;

              let boletosSeleccionados = [];
              
              if(boletosDia >= 1){
                boletosSeleccionados.push("viernes");
              }else if(boletosDia <= 0 || boletosDia === ""){
                document.getElementById("viernes").style.display = "none";
              }

              if(boletos2Dias >= 1){
                boletosSeleccionados.push("viernes","sabado");
              }else if(boletos2Dias <= 0 || boletos2Dias === ""){
                document.getElementById("viernes").style.display = "none";
                document.getElementById("sabado").style.display = "none";
              }

              if(boletosCompleto >= 1){
                boletosSeleccionados.push("viernes","sabado","domingo");
              }else if(boletosCompleto <= 0 || boletosCompleto === ""){
                document.getElementById("viernes").style.display = "none";
                document.getElementById("sabado").style.display = "none";
                document.getElementById("domingo").style.display = "none";
              }

              console.log(boletosSeleccionados);
              for(var i=0;i<boletosSeleccionados.length;i++){
                document.getElementById(boletosSeleccionados[i]).style.display = "block";
              } 
            }

            //FUNCION(validarCampos)
            function validarCampos(){ 
              if(this.value == ""){
                errorDiv.style.display = "block";
                errorDiv.innerText = "Este campo es obligatorio";
                this.style.border = "1px solid red";
              }else{
                errorDiv.style.display = "none";
                this.style.border = "1px solid #cccccc";
              }
            }

            //FUNCION(validarMail)
            function validarMail(){
              if(this.value.indexOf("@") >-1){//INDEXOF BUSCA EN UN ARRAY O CADENA DE TEXTO UN VALOR ESPECIFICADO
                errorDiv.style.display = "none";
                this.style.border = "1px solid #cccccc";
              }else{
                errorDiv.style.display = "block";
                errorDiv.innerText = "Debe contener almenos un @";
                this.style.border = "1px solid red";
              }
            }
          }

          if(document.getElementById('mapa')){
            //MAPA
            let mapa = L.map('mapa').setView([18.379003, -97.264023], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(mapa);

            L.marker([18.379003, -97.264023]).addTo(mapa)
                .bindPopup('Ubicacion del local :3')
                .openPopup()
                .bindTooltip("Un tooltip")
                .openTooltip(); 

          }

          //JQUERY
          $(function(){

            //LETTERING
            $('.nombre-sitio').lettering();

            //AGREGAR CLASE A MENU
            $('body.conferencia .navegacion-barra a:contains("Conferencia")').addClass('activo');
            $('body.calendario .navegacion-barra a:contains("Calendario")').addClass('activo');
            $('body.invitados .navegacion-barra a:contains("Invitados")').addClass('activo'); 
            $('body.registro .navegacion-barra a:contains("Reservaciones")').addClass('activo');

            //MENU PEGAJOSO
            let alturaVentana = $(window).height();
            let alturaBarra = $('.barra').innerHeight();//innerHeight o height-Obtener altura de objetos=> con (true) se obtienen mas opciones del elemento

            $(window).scroll(()=>{
              let scroll = $(window).scrollTop();
              if(scroll > alturaVentana){
                $('.barra').addClass('fixed');
              }else{
                $('.barra').removeClass('fixed');
              }
            });

            //MENU-MOVIL
            $('.menu-movil').click(()=>{
              $('.navegacion-barra').slideToggle();
            });


            //PROGRAMA DE CONFERENCIAS
            $('div.ocultar').hide();
            $('div.programa-evento div:first').show();
            $('.menu-programa a:first').addClass('activo');

            $('.menu-programa a').on({ 
              click:function(){
                $('.menu-programa a').removeClass();
                $(this).addClass('activo');
                $('div.programa-evento div.ocultar').hide();
                let enlace = $(this).attr("href");
                $(enlace).fadeIn(1000);
                return false;
              }

            });//Fin del programa de conferencias

            //ANIMACIONES PARA LOS NUMEROS
            //Primera seccion
            $('#mostrar_contador').click(function(){
                $('.resumen-evento li p').slideDown();
                $(`.resumen-evento li:nth-child(1) p`).animateNumber({number:6},1200);
                $(`.resumen-evento li:nth-child(2) p`).animateNumber({number:15},1200);
                $(`.resumen-evento li:nth-child(3) p`).animateNumber({number:3},1200);
                $(`.resumen-evento li:nth-child(4) p`).animateNumber({number:9},1200);
                document.getElementById('ocultar-contador').style.display = "inline-block";
                $(this).hide();

                return false
            });
 
            $('#ocultar-contador').click(function(){
                $('.resumen-evento li p').slideUp(1000);
                $(this).hide();
                $('#mostrar_contador').show();

                return false;
            });

            let resumen_lista = $('.resumen-evento');
            if(resumen_lista.length > 0){
              $('.resumen-evento').waypoint(function(){
                $(`.resumen-evento li:nth-child(1) p`).animateNumber({number:6},1200);
                $(`.resumen-evento li:nth-child(2) p`).animateNumber({number:15},1200);
                $(`.resumen-evento li:nth-child(3) p`).animateNumber({number:3},1200);
                $(`.resumen-evento li:nth-child(4) p`).animateNumber({number:9},1200);
              },{
                offset:'60%'
              });
            }
            
            //Segunda seccion

            if($('.cuenta-regresiva').length > 0){

              $('.cuenta-regresiva').countdown(`${new Date().getFullYear()}/12/27 00:00:00`,function(event){
                $('#dias').html(event.strftime('%D'));
                $('#horas').html(event.strftime('%H'));
                $('#minutos').html(event.strftime('%M'));
                $('#segundos').html(event.strftime('%S'));
              });

            }

            //COLORBOX
            if($('.invitados').length > 0){
              $('.invitado-info').colorbox({inline:true,width:"50%"});
            }

            if($('.boton_newsletter').length > 0){
              $('.boton_newsletter').colorbox({inline:true,width:"50%"});
            }

          });

      });

  })();
