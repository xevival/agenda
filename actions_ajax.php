<?php

include_once 'session.php';
include_once 'config.php';

$action = $_REQUEST['action'];

switch ($action){

	case 'cerca_contactos':

		$cadena = $_REQUEST['cadena'];

		$sql = 'SELECT
					CONCAT_WS(" ",v_nombre,v_apellido1,v_apellido2) as value,
					id_contacto as id
				FROM
					contactos
				WHERE
					v_nombre LIKE "%'.$cadena.'%"';
		

		$contactos = GestorBD::tirarSQL($sql);
		$total     = GestorBD::totalSQL($contactos);

		$data = array();

		for ($i = 0; $i <= $total; $i++) {
			$json = array();
			$json['value'] = utf8_encode($contactos[$i]['value']);
			$json['id'] = $contactos[$i]['id'];
			$data[] = $json;
		}

		$data['results'] = $data;
		header("Content-type: application/json");
		echo json_encode($data);

		break;
		
	case 'cercar_email':
		
		$cadena = $_REQUEST['cadena'];
		
		$sql = 'SELECT
					v_email as value,
					id_contacto as id
				FROM
					contactos
				WHERE
					v_email LIKE "%'.$cadena.'%"';
		
		
		$contactos = GestorBD::tirarSQL($sql);
		$total     = GestorBD::totalSQL($contactos);
		
		$data = array();
		
		for ($i = 0; $i <= $total; $i++) {
			$json = array();
			$json['value'] = utf8_encode($contactos[$i]['value']);
			$json['id'] = $contactos[$i]['id'];
			$data[] = $json;
		}
		
		$data['results'] = $data;
		header("Content-type: application/json");
		echo json_encode($data);
		
		break;



}



?>