<?php 
    function fecha_diff_function( $data1, $data2 ){ 
        // 86400 seg = 60 [seg/1_minuto] * 60 [1_minuto / 1_hora]* 24 [1_hora] 
        $segundos  = strtotime($data2)-strtotime($data1); 
        $dias      = intval($segundos/86400); 
        $segundos -= $dias*86400; 
        $hora      = 'Aqui quiero que me muestre la hora exacta de la base de datos'; 
        $horas     = intval($segundos/3600); 
        $segundos -= $horas*3600; 
        $minutos   = intval($segundos/60); 
        $segundos -= $minutos*60; 
        if($dias > 0 | $dias < 1){ 
            $sl_retorna = 'Ayer a las '.$hora; 
        }elseif($dias == 0){ 
            $sl_retorna = 'Hace '.$minutos.' minutos aproximadamente'; 
        } 
        return $sl_retorna; 
    } 
?> 

Solucion-------------

<?php 
        function fecha_diff_function( $data1, $data2 ){ 
        $choose = mysql_query("SELECT * FROM comentarios"); 
        mysql_data_seek($choose,0); 
        $dates = mysql_fetch_array($choose); 
        $fecha1 = $dates['commentdate']; 
        // 86400 seg = 60 [seg/1_minuto] * 60 [1_minuto / 1_hora]* 24 [1_hora] 
        $segundos  = strtotime($data2)-strtotime($data1); 
        $dias      = intval($segundos/86400); 
        $segundos -= $dias*86400; 
        $horas     = intval($segundos/3600); 
        $segundos -= $horas*3600; 
        $minutos   = intval($segundos/60); 
        $segundos -= $minutos*60; 
        // Para el Ayer 
        $segundo  = strtotime($data1); 
        $dia      = intval($segundo/86400); 
        $segundo -= $dia*86400; 
        $hora     = intval($segundo/3600); 
        $segundo -= $hora*3600; 
        $minuto   = intval($segundo/60); 
        $segundo -= $minutos*60; 
        // Hora exacta 
        $hora_exacta      = $hora.':'.$minuto; 
        if($dias > 1){ 
            $sl_retorna = 'El '.$fecha1.' a las '.$hora_exacta; 
        }elseif($dias > 0 | $dias < 1){ 
            $sl_retorna = 'Ayer a las '.$hora_exacta; 
        }elseif($dias == 0){ 
            $sl_retorna = 'Hace '.$minutos.' minutos aproximadamente'; 
        } 
        return $sl_retorna; 
    } 
?> 