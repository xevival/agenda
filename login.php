<?php


include_once './config.php';
include_once './class/Login.php';


$do = $_REQUEST['do'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Acceso a la Plataforma</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
            switch ($do) {

                case 'doLogin':
                	
                	$user = Utils::filtraString($_REQUEST['user']);
                	$pass = Utils::filtraString($_REQUEST['pass']);
                	
                	$user    = Login::iniciarSession($user, $pass);
                	$user_ok = GestorBD::totalSQL($user);
                	
                	if ( $user_ok > -1 ) {
                		
                		session_start();
						$_SESSION['USERID'] = $user[0]['id_usuario'];
						Login::guardarAcceso($_SESSION['USERID']);
						echo "<script type=\"text/javascript\">location.href=\"contactos.php\";</script>";
						
					} else {
						echo "<script type=\"text/javascript\">location.href=\"login.php?error=1\";</script>";
					}
                	
                    break;
                default :
                	
                	$error = ($_REQUEST['error']) ? 1 : '';
                    Login::mostrarFormulario($error);
                   
                    break;
            }
            ?>
        </div>
    </body>