<?php
@require_once("banco/DatabaseOperations.class.php");
$db = new DatabaseOperations();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<!-- Created by Artisteer v4.0.0.58475 -->
<meta charset="utf-8">
<title>cadastro de fornecedor</title>
<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">


<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" 
href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" 
src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" 
src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
var $a = jQuery.noConflict()

$a(document).ready(function() {
    // Setup - add a text input to each footer cell
    $a('#minhaTabela tfoot th').each( function () {
        var title = $a(this).text();
        $a(this).html( '<input type="text" placeholder="Pesquisar '+title+'" />' );
    } );
 
    // DataTable
    var table = $a('#minhaTabela').DataTable({
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    }
                },
            });
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $a( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
	
	
} );
</script>

 <style>
            /****** Rating Starts *****/
            @import url(http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

        
            .rating { 
                border: none;
                float: left;
            }

            .rating > input { display: none; } 
            .rating > label:before { 
                margin: 5px;
                font-size: 1.25em;
                font-family: FontAwesome;
                display: inline-block;
                content: "\f005";
            }

            .rating > .half:before { 
                content: "\f089";
                position: absolute;
            }

            .rating > label { 
                color: #ddd; 
                float: right; 
            }

            .rating > input:checked ~ label, 
            .rating:not(:checked) > label:hover,  
            .rating:not(:checked) > label:hover ~ label { color: #FFD700;  }

            .rating > input:checked + label:hover, 
            .rating > input:checked ~ label:hover,
            .rating > label:hover ~ input:checked ~ label, 
            .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }     


            


            /* Downloaded from http://devzone.co.in/ */
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <script src="index_files/ca-pub-2074772727795809.js" type="text/javascript" async=""></script><script src="index_files/analytics.js" async=""></script>



<style type="text/css">
body {background:#eee;}
.i2Style{
font:bold 18px Tahoma, Geneva, sans-serif;
font-style:normal;
color:#ffffff;
background:#13374E;
border:0px solid #ffffff;
text-shadow:0px -1px 1px #222222;
box-shadow:2px 2px 5px #000000;
-moz-box-shadow:2px 2px 5px #000000;
-webkit-box-shadow:2px 2px 5px #000000;
border-radius:10px 10px 10px 10px;
-moz-border-radius:10px 10px 10px 10px;
-webkit-border-radius:10px 10px 10px 10px;
width:15px%;
padding:20px 43px;
cursor:pointer;
margin:0 auto;
}
.i2Style:active{
cursor:pointer;
position:relative;
top:2px;
}

</style>


</head>
<body>
<div id="art-main">
  <div class="art-sheet clearfix">
    <div class="art-layout-wrapper clearfix">
      <div class="art-content-layout">
        <div class="art-content-layout-row">

          <div class="art-layout-cell art-content clearfix">
            <article class="art-post art-article">
            
              <div class="art-postcontent art-postcontent-0 clearfix">
                <div class="art-content-layout">
                  <div class="art-content-layout-row">
                    <div class="art-layout-cell" style="padding:10px; padding-left:10px; padding-right:10px;">

                    <div class="table-responsive">

<table id="minhaTabela" class="display table" width="100%">
        <thead>  
          <tr>
            <th>Avaliação</th>   
            <th>Cidade</th> 
            <th>Estabelecimento</th> 
          </tr>  
        </thead>
        <tfoot>  
          <tr>
            <th></th>   
            <th>Cidade</th> 
            <th>Estabelecimento</th>  
          </tr>  
        </tfoot>    
        <tbody>  
          <?php        
         $sql = mysql_query("select count(e.Id) as qtd, sum(pontuacao) as total,e.*, c.cidade, c.uf, a.pontuacao from estabelecimento e, cidades c, avaliacoes a
where e.id_cidade=c.Id and e.Id=a.id_estabelecimento group by e.Id
") or die ("Erro ao Consultar Estabelecimento");

if(mysql_num_rows($sql) != 0){
	while($res = mysql_fetch_array($sql)){
		
			
			$id = $res['Id'];
		$cidade = utf8_encode($res['cidade']." - ".$res['uf']);
		$nome = utf8_encode($res['nome']);
		
		echo"<tr><td>";


                                     $t = $res['total'];
                                     $q = $res['qtd'];

                                     $p = round($t / $q);

                                     if($p > 5){

                                         $p = 5;

                                     }
         

                                     for($contador = 1; $contador <= $p; $contador++) {
                                    ?>
                            
                    <img src="img/estrela.png" width="20" />
                                    <?php
                                     }
                               
                  


        echo" </td> 
			<td align='center'>$cidade</td> 
            <td>$nome</td>  
            </tr>";
	}
}
	?>  
          
        </tbody>  
</table>

</div>

                    </div>
                  </div>
                </div>
      
              </div>
</article>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
<?php

$db->Desconecta();
	?>
</html>
