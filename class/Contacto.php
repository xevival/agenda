<?php

class Contacto {
    
    public static function insertarContacto($datos){
        GestorBD::insertarDatos('contactos', $datos); 
    }
    
    public static function listadoContactos($filtro){
        
       	$where = '';
    	
    	if ( $filtro == 'all' )$where = '';
    	else $where = ' WHERE c.v_nombre LIKE "'.$filtro.'%"';

        $sql        = '	SELECT 
        					id_contacto,v_nombre,CONCAT_WS(" ",v_apellido1,v_apellido2) as apellidos,fecha_nacimiento 
        				FROM 
        					contactos c '.$where;
        
        $contactos   = GestorBD::tirarSQL($sql);
        
        return $contactos;
    }
    
    public static function eliminarContacto($id){
        GestorBD::eliminarRegistro('contactos', 'id_contacto', $id);
    }
    
    public static function obtenerContacto($id){
        
        $sql       = 'SELECT
        				id_contacto,v_nombre,CONCAT_WS(" ",v_apellido1,v_apellido2) as apellidos,fecha_nacimiento 
        			  FROM 
        				contactos 
        			  WHERE 
        				id_contacto='.$id.' LIMIT 1';
        
        $contacto  = GestorBD::tirarSQL($sql);
        return $contacto; 
    }
    
    public static function modificarContacto($datos){
        $sql = "UPDATE 
        			contactos 
        		SET 
        			v_nombre ='$datos[1]',
        			v_apellido1 ='$datos[2]',
        			v_apellido2 ='$datos[3]',
        			fecha_nacimiento ='$datos[4]'
        		WHERE 
        			id_contacto ='$datos[0]'";
        
 
        		
        $GLOBALS['con']->query($sql);
    }
   
    public static function devuelveEmail($id){
    	
    	
    	$sql = 'SELECT
    				v_email
    			FROM
    				contactos
    			WHERE
    				id_contacto = '.$id;
    	
    
    	
    	$email = GestorBD::tirarSQL($sql);
    	return $email[0]['v_email'];
    	
    }
    
   
}

?>
