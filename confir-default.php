<?php
session_start();
if( !$_SESSION["LOGADOMEDSUL"] ){ header("Location:logaraf.php"); }

@require("banco/DatabaseOperations.class.php");
$db = new DatabaseOperations();


$LOGIN = $_SESSION["LOGIN"];
$senha1 = $_POST['senha1'];
$senha2 = $_POST['senha2'];


if($senha1 == $senha2){
	$sql = "UPDATE usuarios SET intra_senha='$senha1' WHERE Usua_Senh='$LOGIN'";
	$resultado = mysql_query($sql);	
	?>                     
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
	alert ("Senha alterada com sucesso!")
	</SCRIPT>
	<?
	if($_SESSION ["NIVEL"] == 1){
	echo "<script>location.replace('index_medico.php');</script>";            
	}else{
		echo "<script>location.replace('index.php');</script>";
		}
}else{
	
	?>                     
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
	alert ("Senha incorreta, por favor digite duas senhas iguais!")
	</SCRIPT>
	<?
	echo "<script>location.replace('default-senha.php');</script>";  
		
}
	
	
?>