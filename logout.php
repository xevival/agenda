<?php

session_start();
session_destroy();

echo "<script type=\"text/javascript\">alert(\"Has salido!\");</script>";
echo "<script type=\"text/javascript\">location.href=\"login.php\";</script>";

?>