<?php

class Utils {

    public static function preArray($array) {

        echo "<pre>";
            print_r($array);
        echo "</pre>";
    }
    
    public static function listadoPaises(){

    	$sql_paises = "SELECT id,nombre FROM paises";
    	$paises     = GestorBD::tirarSQL($sql_paises);
    	
    	return $paises;
    }
    
    public static function filtraString($cadena){
    	return $cadena = filter_var($cadena,FILTER_SANITIZE_STRING);
    }
    
    public static function filtraEntero($entero){
    	return  $entero = filter_var($entero,FILTER_SANITIZE_NUMBER_INT);
    }
    
    public static function girarFecha($fecha,$accion){
    	
    	switch ($accion){
    		
    		case 'guardar':
    			$fecha = explode("/", $fecha);
    			$fecha = $fecha[2]."/".$fecha[1]."/".$fecha[0];
    			break;
    		
    		case 'ver':
    			$fecha = explode("/", $fecha);
    			$fecha = $fecha[0]."/".$fecha[1]."/".$fecha[2];
    			break;

    		default:
    			break;
    		
    	}

    	return $fecha;
    	
    }
    
    public static function enviarMail($para,$asunto,$texto){
    	
    }
    
    public static function getRealIP() {

    	return $_SERVER['REMOTE_ADDR'];
    }
    

}
