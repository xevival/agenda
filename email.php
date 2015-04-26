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
        <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
        <script>tinymce.init({selector:'textarea'});</script>
        <script type="text/javascript">
		        var options = {
		    			script: "actions_ajax.php?action=cercar_email&",
		    			varname: "cadena",
		    			json: true,
		    			shownoresults: false,
		    			maxentries: 10
		    			
		    		};
		    		$(document).ready(function(){
		    			var as = new bsn.AutoSuggest('to', options);			
		    		});						 
    </script>
    <script type="text/javascript">

    
		$(document).ready(function(){

		    $('[data-toggle="tooltip"]').tooltip();  
		    
		    $('#add_dest').click(function(){
				$('#to').after('<input type="text" class="form-control input-sm" placeholder="para" name="to[]" id="to">');
			});

		     
		});

		
		
	</script>
        <style>
            body{
                margin-top: 15px;
                margin-left: 15px;
                margin-right: 15px;
            }
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
                <h3>Envio E-mails</h3><hr />
            </div>
        </div>

        <?php
        switch ($do) {


			case 'send':
				
				$to     = $_REQUEST['to'];
				$asunto = $_REQUEST['subject'];
				$text   = $_REQUEST['text'];
				
				
				
				
				break; 

			default:
			
				$id    = Utils::filtraEntero($_REQUEST['id']);
				$email = '';
				$email = ( $id ) ? Contacto::devuelveEmail($id) : '';
				
				$html = '<form action="email.php?do=send" method="POST">';
				
				$html .= '<div class="row">
									<div class="col-md-3"></div>
									<div class="col-md-6">
										<div class="panel panel-info">
											<div class="panel-heading">
												<h3 class="panel-title" id="panel-title">Nuevo E-mail<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
											</div>
										<div class="panel-body">
											<div class="col-xs-8" id="mails">
												<label>Para: </label>
												<input type="text" class="form-control input-sm" placeholder="para" name="to[]" value="'.$email.'" id="to">
	        									<input type="button" class="btn btn-default btn-xs" value="Mas destinatarios" id="add_dest">
										</div>	
	        							<div class="col-xs-12">
												<label>Asunto: </label>
												<input type="text" class="form-control input-sm" placeholder="asunto" name="subject">
										</div>
	        							<div class="col-xs-12">
												<label>Texto: </label>
												<textarea class="form-control" name="text"></textarea>
										</div>
	        							<div class="col-xs-12">
												<input type="submit" value="Enviar" class="btn btn-primary">
										</div>				
								</div>
							</div>
						</div>
					</div>';
				$html .= '</form">';
			
				echo $html;
				
				break;
 
        }
        ?>

    </body>
</html>



