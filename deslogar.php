<?php
	session_start();
	if( $_SESSION["LOGADOPAGBEM"] ){
	session_destroy();
	echo "<script>location.replace('logar.php');</script>";
}
?>