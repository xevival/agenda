<?php

require_once 'class/GestorBD.php';
require_once 'class/Utils.php';
require_once 'class/Menu.php';

//Activamos solo los "FATAL ERRORS"
error_reporting(E_ERROR);

define('SERVER', 'localhost');
define('USER', 'root');
define('PASS', 'xvalencia');
define('BBDD','agenda');


GestorBD::connectar(SERVER, USER, PASS, BBDD);

date_default_timezone_set('Europe/Madrid');




?>