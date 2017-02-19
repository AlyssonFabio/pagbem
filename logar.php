<?php
session_start();
@require("banco/DatabaseOperations.class.php");
$db = new DatabaseOperations();
include "intra-functions.php";

?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>PagBem | Login</title>

    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Nunito:400,300,700'>

        <link rel="stylesheet" href="csslogin/style.css">

    
    
    
  </head>

  <body>

 <div class="container">
    
  <div class="form-container flip" align="center">
    <form class="login-form" method="post" id="aut">
      <h3 class="title">Login</h3>
      <div class="form-group" id="username">
        <input class="form-input" tooltip-class="username-tooltip" placeholder="Usuário" id="login" name="login" required="true"></input>
        <span id="username-tool"class="tooltip username-tooltip">Digite seu Usuário</span>
      </div>
      <div class="form-group" id="password">
        <input name="senha" id="senha" type="password" class="form-input" tooltip-class="password-tooltip" placeholder="Senha"></input>
        <span class="tooltip password-tooltip">Digite sua Senha</span>
      </div>
      <div class="form-group">
        <button type="submit" onclick="clickListener();" class="login-button">Login</button>

    </form>


   <?php
	if (isset ( $_POST ["login"] ) && isset ( $_POST ["senha"] )) {
		
		$senha = $_POST ["senha"];
		
		$sql = mysql_query("SELECT id_usuario, email, nome, senha, nivel FROM usuarios WHERE email = '" . $_POST ["login"] . "'");
		
		while($res = mysql_fetch_array($sql)){
				$_SESSION ["NOME"] = $res ["nome"];
				$_SESSION ["LOGIN"] = $res ["email"];
				$_SESSION ["SENHA"] = $res ["senha"];
				$_SESSION ["NIVEL"] = $res ["nivel"];
				$_SESSION ["ID"] = $res ["id_usuario"];
        $_SESSION ["cidade"] = $res ["id_cidade"];
				$_SESSION["COD"] = $_POST ["cod"];
			
		}
		
		if($_SESSION ["LOGIN"] == $_POST ["login"] and $_SESSION ["SENHA"] == $senha){
			$_SESSION ["LOGADOPAGBEM"] = "ON";
			echo "<script>location.replace('default-senha.php');</script>";
			} else {
			echo "<script>alert('Usuário ou Senha Inválidoss');</script>";
	}
}

	
	?>

<?php $db->Desconecta(); ?>
      
  
  </div>


    </div>
    
  </body>
</html>
