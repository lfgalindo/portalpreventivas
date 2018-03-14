<?php

/**
 * Classe responsável pela tabela de Arquivos no banco de dados.
 *
 * @category Arquivos
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Arquivo_Model extends MY_Model {

	/**
	* @var array 	$array 		Dados do objeto
	*/

	/** Método construtor. */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Lista os registros do banco
	 * @return array
	 */
	public function listar_arquivos( $maximo, $inicio, $tabela, $id_reg_tabela ) {

		$this->db->select();

		$this->db->where( 'tabela', $tabela );
		$this->db->where( 'id_reg_tabela', $id_reg_tabela );

		$this->db->order_by( 'data_envio', "DESC" );
		
		$query = $this->db->get( $this->table, $maximo, $inicio );

		return $query->result_array();
		
	}

	/**
	 * Conta os registros existentes no banco.
	 * @return int
	 */
	public function contar_registros_arquivos( $tabela, $id_reg_tabela, $data_minima = null ) {

		$this->db->where( 'tabela', $tabela );
		$this->db->where( 'id_reg_tabela', $id_reg_tabela );

		if ( ! is_null( $data_minima ) )
			$this->db->where( 'data_envio >', $data_minima );

		$this->db->from( $this->table );

		return $this->db->count_all_results();

	}

	/**
	 * Ultimo relatório enviado
	 * @return array
	 */
	public function buscar_ultimo_arquivo( $tabela, $id_reg_tabela ) {

		$this->db->select();

		$this->db->where( 'tabela', $tabela );
		$this->db->where( 'id_reg_tabela', $id_reg_tabela );

		$this->db->order_by( 'data_envio', "DESC" );
		
		$query = $this->db->get( $this->table, 1, 1 );

		return $query->result_array();
		
	}

} 

?>
