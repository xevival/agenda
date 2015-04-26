<?php

include_once './session.php';
include_once 'config.php';
include_once './class/Contacto.php';



$do = $_REQUEST['do'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agenda</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/autosuggest_inquisitor.css">
        <link rel="stylesheet" href="css/estilos.css">
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bsn.AutoSuggest_2.1.3.js"></script>
        <script type="text/javascript">
		        var options = {
		    			script: "actions_ajax.php?action=cerca_contactos&",
		    			varname: "cadena",
		    			json: true,
		    			shownoresults: false,
		    			maxentries: 10,
		    			callback: function (obj) { document.getElementById('id_contacto').value = obj.id; }
		    		};
		    		$(document).ready(function(){
		    			var as = new bsn.AutoSuggest('cercador_nom', options);			
		    		});						 

    </script>
    <script type="text/javascript">
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();   
		});
	</script>
        <style>
            
        </style>
    </head>
    <body>

        <div class="row">
            <div class="col-md-12">
                <?php Menu::mostrarMenu() ?> 
            </div>
        </div>
        

        <div class="row">
            <div class="col-md-12">
                <h3>Administracion Contactos</h3><hr />
            </div>
        </div>

        <?php
        switch ($do) {

			case 'add':
				
				
				$html = '<form action="contactos.php?do=save" method="POST">';
				
				$html .= '<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6">
        		
        						
		
								<div class="panel panel-info">
							      <div class="panel-heading">
							        <h3 class="panel-title" id="panel-title">Informacion Basica<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
							      </div>
							      <div class="panel-body">
									<div class="col-xs-4">
										<label>Nombre: </label>
    									<input type="text" class="form-control input-sm" placeholder="Nombre" name="nombre">
 									 </div>

									<div class="col-xs-4">
										<label>Primer Apellido: </label>
    									<input type="text" class="form-control input-sm" placeholder="Apellido 1" name="apellido1">
 									 </div>
		
									<div class="col-xs-4">
										<label>Segundo Apellido: </label>
    									<input type="text" class="form-control input-sm" placeholder="Apellido 2" name="apellido2">
 									 </div>
									</div>
							      </div>
							    </div>
							</div>
		
        					<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
	        		
	        								
									<div class="panel panel-info">
								      <div class="panel-heading">
								        <h3 class="panel-title" id="panel-title">Datos Cumpleaños<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
								      </div>
								      <div class="panel-body">
										<div class="col-xs-4"></div>
	
										<div class="col-xs-4">
											<label>Fecha nacimiento: </label><em>(dd/mm/aaaa)</em>
	    									<input type="text" class="form-control input-sm" placeholder="Fecha Nacimiento" name="fecha_nacimiento">
	 									 </div>
			
										<div class="col-xs-4"></div>
										</div>
								      </div>
								    </div>
								</div>
	        					<input type="submit" value="Guardar" class="btn btn-primary">
								<div class="col-md-3"></div>
						</div>';
		
					$html .='</form>';
					echo $html;
					
				break; 
				
				
			case 'save':
				
				$datos = array();
				
				$datos[1] = Utils::filtraString($_REQUEST['nombre']);
				$datos[2] = Utils::filtraString($_REQUEST['apellido1']);
				$datos[3] = Utils::filtraString($_REQUEST['apellido2']);
				
				$fecha_nacimiento = Utils::filtraString($_REQUEST['fecha_nacimiento']);
				$fecha_nacimiento = Utils::girarFecha($fecha_nacimiento,'guardar');
				
				$datos[4] = $fecha_nacimiento;
								
				Contacto::insertarContacto($datos);
				
				echo "<script type=\"text/javascript\">alert(\"Contacto añadido correctamente\");</script>";
				echo "<script type=\"text/javascript\">location.href=\"contactos.php\";</script>";
				
				
				break;
				
			case 'del':
				
				$id = Utils::filtraEntero($_REQUEST['id']);
				Contacto::eliminarContacto($id);
				
				echo "<script type=\"text/javascript\">alert(\"Contacto eliminado correctamente\");</script>";
				echo "<script type=\"text/javascript\">location.href=\"contactos.php\";</script>";
			
			break;
			
			case 'update':
				
				$datos = array();
				
				$datos[0] = Utils::filtraEntero($_REQUEST['id_contacto']);
				$datos[1] = Utils::filtraString($_REQUEST['nombre']);
				$datos[2] = Utils::filtraString($_REQUEST['apellido1']);
				$datos[3] = Utils::filtraString($_REQUEST['apellido2']);
				
				$fecha_nacimiento = Utils::filtraString($_REQUEST['fecha_nacimiento']);
				$fecha_nacimiento = Utils::girarFecha($fecha_nacimiento,'guardar');
				
				$datos[4] = $fecha_nacimiento;
				
				Contacto::modificarContacto($datos);
				
				echo "<script type=\"text/javascript\">alert(\"Contacto modificado correctamente\");</script>";
				echo "<script type=\"text/javascript\">location.href=\"contactos.php\";</script>";
				
				
				break;
				
				break;
				
			case 'mod';
			
				$id_contacto = Utils::filtraString($_REQUEST['id']);
				$contacto    = Contacto::obtenerContacto($id_contacto);
				
				$apellidos   = explode(" ", $contacto[0]['apellidos']);
				Utils::preArray($apellidos);
				$fecha       = Utils::girarFecha($contacto[0]['fecha_nacimiento'],'ver');
			
			
			$html = '<form action="contactos.php?do=update" method="POST">';
			
			$html .= '<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6">
			
			
			
								<div class="panel panel-info">
							      <div class="panel-heading">
							        <h3 class="panel-title" id="panel-title">Informacion Basica<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
							      </div>
							      <div class="panel-body">
									<div class="col-xs-4">
										<label>Nombre: </label>
    									<input type="text" class="form-control input-sm" placeholder="Nombre" name="nombre" value="'.$contacto[0]['v_nombre'].'">
 									 </div>
			
									<div class="col-xs-4">
										<label>Primer Apellido: </label>
    									<input type="text" class="form-control input-sm" placeholder="Apellido 1" name="apellido1" value="'.$apellidos[0].'">
 									 </div>
			
									<div class="col-xs-4">
										<label>Segundo Apellido: </label>
    									<input type="text" class="form-control input-sm" placeholder="Apellido 2" name="apellido2"  value="'.$apellidos[1].'">
 									 </div>
									</div>
							      </div>
							    </div>
							</div>
			
        					<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
	     
	        
									<div class="panel panel-info">
								      <div class="panel-heading">
								        <h3 class="panel-title" id="panel-title">Datos Cumpleaños<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
								      </div>
								      <div class="panel-body">
										<div class="col-xs-4"></div>
			
										<div class="col-xs-4">
											<label>Fecha nacimiento: </label><em>(dd/mm/aaaa)</em>
	    									<input type="text" class="form-control input-sm" placeholder="Fecha Nacimiento" name="fecha_nacimiento" value="'.$fecha.'">
	 									 </div>
		
										<div class="col-xs-4"></div>
										</div>
								      </div>
								    </div>
								</div>
			
		
								<input type="hidden" name="id_contacto" value="'.$id_contacto.'">	
	        					<input type="submit" value="Guardar" class="btn btn-primary">
								<div class="col-md-3"></div>
						</div>';
			
			$html .='</form>';
			
			echo $html;
			
			break;
				
			default:

				$html = '<div class="row">
                                <div class="col-md-12">
                                    <a href="contactos.php?do=add" class="btn btn-success">Añadir</a>
                                </div>
                            </div>';
				
				
				$html.='<div class="row">
                                 <div class="col-md-2">
                                 </div>
                                <div class="col-md-10">
                                   <nav>
									  <ul class="pagination">
                                        <li><a href="contactos.php?letra=all">Todos</a></li><span>&nbsp</span>';
				for ($i='A';$i!='AA';$i++){
					$activa = ($i == $_REQUEST['letra']) ? 'active' : '';
					$html .= '<li class="'.$activa.'"><a href="contactos.php?letra='.$i.'">'.$i.'</a></li><span>&nbsp</span>';
				}
				$html.='				</ul>
									</nav>
                                </div>
				
                            </div>';
				
				$html .= '<div class="row">
                                <div class="col-md-4">
                  
            					</div>
                				<div class="col-md-2">
            						<form action="" method="POST">
	                                    <label>Buscador: </label>
	                					<input name="cercador_nom" type="text" size="50" id="cercador_nom" autocomplete="off" class="form-control input-sm">
	            			 			<input type="hidden" class="form-control input-sm" placeholder="cliente" name="id_contacto" id="id_contacto" autocomplete="off"><br />
	            						<button type="submit" class="btn btn-primary btn-sm pull-right" value="Buscar">
            								<span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span><span>&nbsp</span>Buscar
            							</button>
            						</form>
            					</div>
                				<div class="col-md-4">
            					</div>
                            </div>';
				
				if ( $_REQUEST['id_contacto'] ){
					$contactos = Contacto::obtenerContacto(Utils::filtraEntero($_REQUEST['id_contacto']));
				}else{
					$letra     = (isset($_REQUEST['letra'])) ? $_REQUEST['letra'] : 'all';
					$contactos = Contacto::listadoContactos(Utils::filtraString($letra));
				}
				
				
				$html .= '<div class="row">
                                <div class="col-md-2">
                                </div>
                				 <div class="col-md-6">';
				if( count($contactos)>0 ){
					$html .='<table class="table table-striped">
                                        <thead>
                                            <tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Fecha Nacimiento</th><th>Operaciones</th></tr>
                                        </thead>
                                        <tbody>';
					foreach ( $contactos as $c ) {
						$html.='<tr>
                                                            <td class="info" width="10%">'.$c['id_contacto'].'</td>
                                                            <td>'.$c['v_nombre'].'</td>
									   						 <td>'.$c['apellidos'].'</td>
															<td>'.$c['fecha_nacimiento'].'</td>
                                                            <td width="10%">
                                                                <a href="contactos.php?do=del&id='.$c['id_contacto'].'" data-toggle="tooltip" data-placement="top" data-original-title="Borrar"><img src="img/ico/delete.gif"></a><span>&nbsp</span>
                                                                <a href="contactos.php?do=mod&id='.$c['id_contacto'].'" data-toggle="tooltip" data-placement="top" data-original-title="Modificar"><img src="img/ico/edit.gif"></a>
                                								<a href="email.php?id='.$c['id_contacto'].'"data-toggle="tooltip" data-placement="top" data-original-title="Enviar Email"><img src="img/ico/email.gif"><span>&nbsp</span>
                                                            </td>
                                                        </tr>';
					}
					$html .= '</tbody></table>';
				}else{
					$html .='<div class="alert alert-info" role="alert">No hay registros</div>';
				}
				
				$html.='  </div>
                         </div>';
				
	
				echo $html;
				
			break; 

               
        }
        ?>

    </body>
</html>



