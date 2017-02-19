<?php

//Função que retira os acentos das letras
function retirar_acentos($string){
      
	  $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr';
      $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
      $string = utf8_decode($string);
      $string = strtr($string, utf8_decode($a), $b); // Retira os Acentos das Letras.
	  $string = str_replace("."," ",$string); // Retira os Espaços.
      return utf8_encode($string); // Retorna a String transformada
	  
}

//Função que retira os pontos e troca por espaços
function retirar_pontos($string){
	  
	  $a = '-';
      $b = '';
      $string = utf8_decode($string);
      $string = strtr($string, utf8_decode($a), $b); // Retira os Digitos.
	  $string = str_replace(".","",$string); // Retira os Pontos.
      return utf8_encode($string); // Retorna a String transformada
	
}


// Função que valida o CPF
function validar_cpf($cpf)
{	// Verifiva se o número digitado contém todos os digitos
    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
	
	// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
	{
	return false;
    }
	else
	{   // Calcula os números para verificar se o CPF é verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }
}

//Como usar a função de validar CPF
/*
// Verifica se o botão de validação foi acionado
if(isset($_POST['btvalidar']))
	{// Adiciona o numero enviado na variavel $cpf_enviado, poderia ser outro nome, e executa a função acima
	$cpf_enviado = validaCPF($_POST['cpf']);
	// Verifica a resposta da função e exibe na tela
	if($cpf_enviado == true)
		echo "CPF VERDADEIRO";
	elseif($cpf_enviado == false)
		echo "CPF FALSO";
	}*/

?>