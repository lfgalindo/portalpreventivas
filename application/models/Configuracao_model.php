<?php

/**
 * Classe responsável pela tabela de Configurações no banco de dados.
 *
 * @category Configurações
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracao_Model extends MY_Model {

	/**
	* @var array 	$array 		Dados do objeto
	*/

	/** Método construtor. */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Seleciona uma configuração pelo seu nome.
	 * @return object
	 */
	public function selecionar_valor( $nome ) {

		$this->db->select();
		$this->db->from( $this->table );
		$this->db->where('nome', $nome );
		$query = $this->db->get();

		/** Array com os resultados. */
		$array = $query->row_array();
		
		return $array['valor'];		

	}

} 

?>
