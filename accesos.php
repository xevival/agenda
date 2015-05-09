<?php

include_once './session.php';
include_once 'config.php';
include_once './class/Login.php';


$listado = Login::obtenerListadoAcceso();


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
        
        <style>
            body{
                margin-top: 15px;
                margin-left: 15px;
                margin-right: 15px;
            }
        </style>
        
        <script type="text/javascript">


		$(document).ready(function(){

		    $('[data-toggle="tooltip"]').tooltip();  
		    
		    $('#link').click(function(){

				if ( $('#actions').css('display') == 'none' ){
					$('#actions').show("slow");
					$('#link').html('Esconder acciones');
				} else {
					$('#actions').hide("slow");
					$('#link').html('Ver acciones');
				}
			});
		});

        </script>
    </head>
    <body>

        <div class="row">
            <div class="col-md-12">
                <?php Menu::mostrarMenu() ?> 
            </div>
        </div>
        

        <div class="row">
            <div class="col-md-12">
                <h3>Acceso Usuarios</h3><hr />
            </div>
        </div>

        <?php
        

        $html .= '<div class="row">
                                <div class="col-md-2">
                                </div>
                				 <div class="col-md-4">';
        if( count($listado) > 0 ){
        	$html .='<table class="table table-striped">
                                        <thead>
                                            <tr><th>Usuario</th><th>IP</th><th>Fecha</th></tr>
                                        </thead>
                                        <tbody>';
        	foreach ( $listado as $l ) {
        		$html.='<tr>                                       
	                    <td>'.$l['v_username'].'</td>
						<td>'.$l['ip_acceso'].'</td>
						<td>'.$l['fecha_acceso'].'</td>
                    </tr>';
        	}
        	$html .= '</tbody></table>';
        	$html .= '<span>Total accesos: </span><span class="badge">'.count($listado).'</span>';
        }else{
        	$html .='<div class="alert alert-info" role="alert">No hay registros</div>';
        }
        
        $html.='  </div>
            		<div class="col-md-2">
            			<a class="btn btn-link" id="link">Ver Acciones</a>
            			<div id="actions" style="display:none">
            				<div class="panel panel-info">
								<div class="panel-heading">
							        <h3 class="panel-title" id="panel-title">Acciones<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
							      </div>
									<div class="panel-body">
										<ul>
			            					<li>Exportar a Excel</li>
			            					<li>Exportar a PDF</li>
		            					<ul>
									</div>
							</div>	
            			</div>
                     </div>
                   </div>
		    		</div>';
        
        echo $html;

        ?>

    </body>
</html>



