<?php



class DatabaseOperations{

	var $sql;

	var $tabela;

	var $conecxao;

	

	var $confDB;

	var $db	  = "pagbem";

	var $host = "localhost";

	var $pass = "";

	var $user = "root";

	

	var $campo;

	var $valores;

	var $numPags;

	

	var $cond;

	var $field;

	var $newval;

	var $update;

	

	var $arrayDados;

	var $query;

	

	var $valsAtualiza;

	

	var $lastedId;

	

	function DatabaseOperations(){

		$this->getConnection();

	}



	 function setTabela($table){

		$this->tabela = $table;

	}

	

	 function setSql($sql){

		$this->sql = $sql;

	}

	

	 function setQuery($query){

		$this->query = $query;

	}



	// conecta a base

	 function getConnection(){

		

		$this->conecxao = mysql_connect($this->host, $this->user, $this->pass)

		or die("Erro nos par�metros de conex�o. ".mysql_error());

		mysql_select_db($this->db);

	}

	

	 function Desconecta(){

		if(mysql_close($this->conecxao)) { return true; }

	}

	

	// retorna os campos da tabela dada

	 function Fieldstabela($tabela){

		$this->tabela = $tabela;

		$arr = array();

		$res = mysql_query("SELECT * FROM ".$this->tabela);

		$i = 0;

		while ($i < mysql_num_fields($res)) {

			$meta = mysql_fetch_field($res, $i);

			if (!$meta) {

       			echo "Informa��o n�o disponivel<br />\n";

  			}else{

				$arr[$i] = $meta->name;

			}

			$i++;

		}

		mysql_free_result($res);

		// armazena o ID da tabela

		$this->lastedId = $arr[0];

		return $arr;

	}

		

	// armazena o nome dos campos da tabela

	  function Campos($tabela){

		$this->ClearValores($this->campo);

		$this->tabela = $tabela;

		$campos = $this->Fieldstabela($tabela);

		$this->campo = "(";

		for($i = 0;$i < sizeof($campos);$i++){

			if($i <> sizeof($campos)-1){

				$this->campo .= "`".$campos[$i]."`, ";

			}else{

				$this->campo .= "`".$campos[$i]."`";

			}

		}

		$this->campo .= ")";

	} // ex: Capos("nome da tabela");

	

	 function getCampo(){

		return $this->campo;

	}

	

	// converte o formato vindo do navegador em data

	function TODATE( $data, $formato ){

		return "STR_TO_DATE('".$data."', '".$formato."')";

	}	

	

	// armazena os valores a serem inseridos nos campos

	 function Values($valores){

		$this->ClearValores($this->valores);

		$this->valores = "(";

		$cont = 0;

		for($i = 0;$i < sizeof($valores);$i++){

			// testa se o valor � NULL

			if( ($valores[$i] == "NULL") && ($i == 0) ){ 

				$this->valores .= $valores[$i].", ";

				$cont++;

			// testa se vem alguma formata��o de data 

			}elseif( eregi( 'STR_TO_DATE', $valores[$i] ) ){

				$this->valores .= $valores[$i].", ";

			// demais valores

			}elseif($i <> sizeof($valores) - $cont){

				$this->valores .= "'".$valores[$i]."', ";

			}else{

				$this->valores .= "'".$valores[$i]."'";

			}

		}

		$this->valores .= ")";

	} // ex: Values("array com os valores");

	

	 function getValues(){

		return $this->valores;

	}

	

	// executa uma query aleat�ria

	function MysqlEXE(){

		$this->sql = mysql_query($this->query) or die ("Erro em MysqlEXE ".mysql_error());

		return $this->sql;

	}

	function getQuery(){

		return $this->query;

	}

	

	function getSQL(){

		return $this->sql;

	}

	

	// limpa valores de vari�veis para serem reutilizadas

	 function ClearValores($val){

		return $val = null;

	}

	

	// �ltimo registro inserido da tabela

	function lastedReg(){

		$sql = "SELECT ".$this->lastedId." FROM ".$this->tabela." ORDER BY ".$this->lastedId." DESC LIMIT 1";

		$this->setQuery( $sql );

		$this->MysqlEXE();

		return $this->RetornaUmValor($this->getSQL(), $this->lastedId);

	}

	

	// retorna o n�mero de registro de uma tabela

	 function NumReg($op){

		if($op == 0){

			$this->sql = mysql_query("SELECT * FROM ".$this->tabela);

			return mysql_num_rows($this->sql);

		}else{

			$this->sql = mysql_query($this->query);

			return mysql_num_rows($this->sql);

		}

		mysql_free_result($this->sql);

	}

	

	function listaPaginacao($query, $numPag, $max){

		$this->setQuery( $query );

		$this->MysqlEXE();

		

		$numResult 	= mysql_num_rows( $this->getSQL() );

		if( $numResult % 2 != 0 ) { $numResult--; }

		

		$numPags   	= ceil($numResult / $max);

		$this->numPags = $numPags;

		$inicio 	= $numPag * $max;

		$limit 		= " LIMIT ".$inicio.", ".$max; 

		

		$this->setQuery( $query.$limit );

		$this->MysqlEXE();



		return  $this->getSQL();

	}

	

	function Paginas($url){

		$j = 1;

		for($i = 0; $i < $this->numPags; $i++){

     		$uri = $url."&pag=$i";

     		if( $_GET['pag'] != $i ){

		    	$pags .= "&nbsp;<a href=\"$uri\">$j</a>&nbsp;";

     		}else{

     			$pags .= "&nbsp;$j&nbsp;";

     		}

			$j++;

 		}

		return $pags;

	}

	############### OPERA��ES #######################

	// insere

	 function Insert(){

		$query 	= "INSERT INTO ".$this->tabela." ".$this->campo." VALUES ".$this->valores;

		$this->sql	= mysql_query($query)or die("Erro na Query Insert()".mysql_error());

		if($this->sql) { return true; } 

	}

	

	// delete 

	 function Delete($condicao, $valor){

		$this->cond = $condicao;

		$query = "DELETE FROM ".$this->tabela." WHERE ".$this->cond.$valor;

		$this->setQuery($query);

		if($this->MysqlEXE()) return true;

	}// seta a tabela primeiro, depois usa Delete("condicao", "primarikey");

	



	################################################

	 function ReturnArray(){

		$this->sql = $this->MysqlEXE();

		for($i = 0;$i < mysql_num_rows($this->sql);$i++){

			$this->arrayDados[$i] = mysql_fetch_row($this->sql);

		}

		return $this->arrayDados;

	}

	

	 function ImprimeArrayDados(){

		$arr = $this->ReturnArray();

		for($i = 0;$i < sizeof($arr);$i++){

			for($j = 0;$j < sizeof($arr[0]);$j++){

				echo $arr[$i][$j]."<br>";

			}

			echo "<hr size=1>";

		}

	}

	

	 function FieldValor(){

		$num_args = func_num_args();

		if(func_get_arg($num_args - 1) != ""){ $this->cond = func_get_arg($num_args - 1); }

		$num_args--;

		$this->valsAtualiza = "";

		for($i = 0; $i < $num_args;$i++){

			if($i != $num_args-1){

				$this->valsAtualiza .= func_get_arg($i)."='".func_get_arg(++$i)."' ";

			}else{

				$this->valsAtualiza .= func_get_arg($i)."='".func_get_arg(++$i)."'";

			}

		}

	}// FieldValor(campo1, valor_do_1,[....] ["CONDI��O"]);

	

	 function Atualiza(){

		$query = "UPDATE ".$this->tabela." SET ".$this->valsAtualiza." WHERE ".$this->cond;

		$this->setQuery($query);

		if($this->MysqlEXE()) return true;

	}

	

	 function RetornaUmValor($sql, $row){

		$res = mysql_fetch_array($sql);

		$result = $res[$row];

		return $result;

	}

	

	

}// fim da classe

?>