<?php
session_start();
if( !$_SESSION["LOGADOPAGBEM"] ){ header("Location:logar.php"); }
include "intra-functions.php";

$usuario = $_SESSION["LOGIN"];


if($_SESSION["SENHA"] != "pagbem123" && $_SESSION ["NIVEL"] >= 2){
	

	echo "<script>
window.location.href = 'index.php';
</script>";
}else{
	
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <!--
    Created by Artisteer v2.5.0.31067
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Alterar Senha</title>

    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->

    <script type="text/javascript" src="script.js"></script>
</head>
<body>

                            <div class="art-post-inner art-article">
                                            <div class="art-postmetadataheader">
                                                <h2 class="art-postheader">
                                                    Alteração da Senha
                                                </h2>
                                            </div>
                                            <div class="art-postcontent">
                                                <!-- article-content -->
                                                <p>
                                                Para que o Usuário logue sempre com a senha que deseja, e mais confiável, é necessário que ele insira uma nova senha.
                                                </p>
                                                <p>
                                                <h4>Informe uma senha de acesso.</h4>
                                                </p>
                                                <form id="form1" name="form1" method="post" action="confir-default.php">
                                                <table width="250">
                                                  <tr>
                                                    <td width="116"><label for="senha1">Informa a Senha:</label></td>
                                                    <td width="118"><input type="password" name="senha1" id="senha1" /></td>
                                                  </tr>
                                                  <tr>
                                                    <td><label for="senha2">Confirma a senha:</label></td>
                                                    <td><input type="password" name="senha2" id="senha2" /></td>
                                                  </tr>
                                                  <tr>
                                                    <td><input type="submit" name="envia" id="envia" value="Enviar" /></td>
                                                    <td><input type="reset" name="reset" id="reset" value="Limpar Dados" /></td>
                                                  </tr>
                                              </table>
                                              </form>
                                              
												</p>
                                                
                                                    
                             
                
</body>
</html>                                             
    
<?php
}
?>