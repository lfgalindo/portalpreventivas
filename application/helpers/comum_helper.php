<?php

/**
 * Helper funções gerais do sistema
 * @author Luís Guilherme Fernandes Ferreira <luisguilherme@cednet.com.br>
 */

defined('BASEPATH') OR exit('No direct script access allowed');



if( ! function_exists( 'validaCPF' ) ){

	function validaCPF( $cpf = null ) {

		// Se não foi enviado nada como paramentro retornar true
		if ( $cpf == null )
			return true;

		// Extrai somente os números
		$cpf = preg_replace( '/[^0-9]/is', '', $cpf );

		// Verifica se foi informado todos os digitos corretamente
		if (strlen($cpf) != 11) {
			return false;
		}

		// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
		if (preg_match('/(\d)\1{10}/', $cpf)) {
			return false;
		}

		// Faz o calculo para validar o CPF
		for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				return false;
			}
		}
		return $cpf;
   }
}

if ( ! function_exists('apenas_numeros')){

	function apenas_numeros($str) {
		return preg_replace("/[^0-9]/", "", $str);
	}

}

if ( ! function_exists('nome_mes')){
	
	function nome_mes( $mes ) {
		
		$nome = "";

		switch ( $mes ) {
			case 1:
				$nome = "Janeiro";
				break;
			case 2:
				$nome = "Fevereiro";
				break;
			case 3:
				$nome = "Março";
				break;
			case 4:
				$nome = "Abril";
				break;
			case 5:
				$nome = "Maio";
				break;
			case 6:
				$nome = "Junho";
				break;
			case 7:
				$nome = "Julho";
				break;
			case 8:
				$nome = "Agosto";
				break;
			case 9:
				$nome = "Setembro";
				break;
			case 10:
				$nome = "Outubro";
				break;
			case 11:
				$nome = "Novembro";
				break;
			case 12:
				$nome = "Dezembro";
				break;
		}

		return $nome;

	}

}

if ( ! function_exists('nomes_estados') ){

	function nomes_estados(){

		$estados = array(
					'AC'=>'Acre',
					'AL'=>'Alagoas',
					'AP'=>'Amapá',
					'AM'=>'Amazonas',
					'BA'=>'Bahia',
					'CE'=>'Ceará',
					'DF'=>'Distrito Federal',
					'ES'=>'Espírito Santo',
					'GO'=>'Goiás',
					'MA'=>'Maranhão',
					'MT'=>'Mato Grosso',
					'MS'=>'Mato Grosso do Sul',
					'MG'=>'Minas Gerais',
					'PA'=>'Pará',
					'PB'=>'Paraíba',
					'PR'=>'Paraná',
					'PE'=>'Pernambuco',
					'PI'=>'Piauí',
					'RJ'=>'Rio de Janeiro',
					'RN'=>'Rio Grande do Norte',
					'RS'=>'Rio Grande do Sul',
					'RO'=>'Rondônia',
					'RR'=>'Roraima',
					'SC'=>'Santa Catarina',
					'SP'=>'São Paulo',
					'SE'=>'Sergipe',
					'TO'=>'Tocantins'
					);

		return $estados;

	}

}

if ( ! function_exists( 'tipos_preventivas' ) ){

	function tipos_preventivas ( $nome_banco = null ){

		$tipos = array(
					"bts" 			=> "BTS-TX",
					"infra" 		=> "Infra",
					"fmt" 			=> "FMT",
					"estrutural" 	=> "Estrutural Torre",
					"ccc" 			=> "CCCs",
					"zeladoria"		=> "Zeladoria"
					);

		return is_null( $nome_banco ) ? $tipos : ( array_key_exists( $nome_banco, $tipos ) ? $tipos[ $nome_banco ] : null );

	}

}

if ( ! function_exists( 'situacoes_preventivas' ) ){

	function situacoes_preventivas ( $nome_banco = null ){

		$situacoes = array(
						"1"		=> "Pendente",
						"2" 	=> "Aguardando relatório",
						"3" 	=> "Relatório em aprovação",
						"4" 	=> "Aguardando novo relatório",
						"5" 	=> "Finalizada"
						);

		return is_null( $nome_banco ) ? $situacoes : ( array_key_exists( $nome_banco, $situacoes ) ? $situacoes[ $nome_banco ] : null );

	}

}

if ( ! function_exists( 'mask' ) ){

	function mask($val, $mask, $telefone = null) {

		if ( $val == "" || $val == null)
			return "";

		$val = str_replace(" ","",$val);
		$val = str_replace("-","",$val);
		$val = str_replace("(","",$val);
		$val = str_replace(")","",$val);

		if ( $telefone == 'telefone'){

			$tam = strlen( $val );

			if ( $tam == 8 ){
				$mask = "####-####";
			}
			else if( $tam == 9){
				$mask = "# ####-####";
			}
			else if ( $tam == 10){
				$mask = "(##) ####-####";
			}
			else if ($tam == 11){
				$mask = "(##) # ####-####";
			}

		}

		$maskared = '';
		$k = 0;

		for($i = 0; $i<=strlen($mask)-1; $i++) {

			if($mask[$i] == '#') {

				if(isset($val[$k]))
					$maskared .= $val[$k++];

			}
			else{

				if(isset($mask[$i]))
					$maskared .= $mask[$i];
			}
		}

		return $maskared;
	}

}