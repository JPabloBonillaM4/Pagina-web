<?php

    //FUNCION PARA PRODUCTOS COMPRADOS
    function productos_json(&$boletos,&$camisas = 0,&$etiquetas = 0){//& => significa que la variable mantendra sus valores originales(Paso por referencia)
        $dias = array("pase_un_dia","pase_completo", "pase_dos_dias");
        $total_boletos = array_combine($dias,$boletos);
        $json = array();

        foreach($total_boletos as $key => $boleto){
            if((int) $boleto > 0){
                $json[$key] = (int) $boleto;
            }
        }
        
        if((int) $camisas > 0){
            $json['camisas'] = (int) $camisas;
        }

        if((int) $etiquetas > 0){
            $json['etiquetas'] = (int) $etiquetas;
        }
        
        return json_encode($json);
    }

    // FUNCION PARA EVENTOS SELECCIONADOS
    function eventos_json(&$eventos){

        $eventos_json = array();

        foreach($eventos as $evento){
            $eventos_json['eventos'][] = $evento;
        }

        return json_encode($eventos_json);
    }
