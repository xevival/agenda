<?php

session_start();

if( !$_SESSION['USERID'] ){
	echo "<script type=\"text/javascript\">alert(\"No has iniciado session\");</script>";
	echo "<script type=\"text/javascript\">location.href=\"login.php\";</script>";
}

?>