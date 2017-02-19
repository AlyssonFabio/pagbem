<?php
@require_once("banco/DatabaseOperations.class.php");
$db = new DatabaseOperations();

$cidade = $_POST['cidade'];
$e = $_POST['estabelecimento'];
$r = $_POST['rating'];
$forma = $_POST['forma'];
$c = utf8_decode($_POST['coment']);
$id_user = $_POST['id_user'];

if ($_GET['funcao'] == "gravar" && $e !="") {

    $sql = mysql_query("select * from estabelecimento where nome='$e'") or die ("Erro ao Consultar estabelecimento");

                            if(mysql_num_rows($sql) != 0){
                                while($res = mysql_fetch_array($sql)){
                                    $ide = $res['Id'];
                                }
                                }else{
                    $sql1 = mysql_query("select max(Id) as Id from estabelecimento") or die ("Erro ao Consultar estabelecimento");

                            if(mysql_num_rows($sql1) != 0){
                                while($res = mysql_fetch_array($sql1)){
                                    $ide = $res['Id']+1;
                                }
                            }


                mysql_query("insert into estabelecimento
                (nome, id_cidade)
                values ('$e', '$cidade')") or die ("Deu erro ao inserir estabelecimento").mysql_error();

                                }

	
mysql_query("insert into avaliacoes
(id_usuario, id_estabelecimento, id_forma_pgto, pontuacao, comentario)
values ('$id_user', '$ide', '$forma', '$r', '$c')") or die ("Deu erro ao inserir Avaliacao").mysql_error();
?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
				alert ("Cadastro realizado com sucesso!")
				location.replace('index.php?content=novaavaliacao')
				</SCRIPT>		

<?php		

}else{
	echo "<br /><p align='center'>Não foi preenchido nenhum Médico</p>";
	
}


$db->Desconecta();

?>
