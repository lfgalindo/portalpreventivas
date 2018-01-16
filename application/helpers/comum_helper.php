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
			case 0:
				$nome = "Janeiro";
				break;
			case 1:
				$nome = "Fevereiro";
				break;
			case 2:
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