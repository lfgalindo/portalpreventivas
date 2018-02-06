<?php

/**
 * Classe responsável pela tabela de Preventivas no banco de dados.
 *
 * @category Preventivas
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Preventiva_Model extends MY_Model {

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
	 * @Override
	 */
	public function listar_preventivas( $maximo, $inicio, $search = "", $search_tipo, $search_situacao, $data_inicio, $data_fim, $fields = null, $orders = null ) {

		$this->db->select( 'preventivas.*, sites.ne_id, sites.cm, supervisores.nome AS supervisor');

		if ( $search != "" || $fields != null ){

			$i = 0;
			$this->db->group_start();

			foreach ($fields as $field) {
				 
				$i == 0 ? $this->db->like( $field, $search ) : $this->db->or_like( $field, $search );

				$i++;

			}

			$this->db->group_end();

		}

		$this->db->join('sites', 'preventivas.id_site = sites.id', 'left');
		$this->db->join('usuarios AS supervisores', 'preventivas.id_supervisor = supervisores.id', 'left');
		$this->db->join('usuarios AS tecnicos', 'preventivas.id_tecnico = tecnicos.id', 'left');

		if ( $search_tipo != "0" )
			$this->db->where( 'tipo', $search_tipo );

		if ( $search_situacao != "0" )
			$this->db->where( 'status', $search_situacao );

       	$this->db->where('programada >= ', $data_inicio);
        $this->db->where('programada <= ', $data_fim);
        
		if ( ! is_null( $orders ) ){

			foreach ($orders as $order => $asc_desc ) {
				
				$this->db->order_by( $order, $asc_desc );

			}

		}
		
		$query = $this->db->get( $this->table, $maximo, $inicio );
		return $query->result_array();
		
	}

	/**
	 * Conta os registros existentes no banco.
	 * @return int
	 * @Override
	 */
	public function contar_registros_preventivas( $search = "", $search_tipo, $search_situacao, $data_inicio, $data_fim, $fields = null ) {

		if ( $search != "" || $fields != null ){

			$i = 0;
			$this->db->group_start();

			foreach ($fields as $field) {
				 
				$i == 0 ? $this->db->like( $field, $search ) : $this->db->or_like( $field, $search );

				$i++;

			}

			$this->db->group_end();

		}

		$this->db->join('sites', 'preventivas.id_site = sites.id', 'left');
		$this->db->join('usuarios AS supervisores', 'preventivas.id_supervisor = supervisores.id', 'left');
		$this->db->join('usuarios AS tecnicos', 'preventivas.id_tecnico = tecnicos.id', 'left');


		if ( $search_tipo != "0" )
			$this->db->where( 'tipo', $search_tipo );

		if ( $search_situacao != "0" )
			$this->db->where( 'status', $search_situacao );

       	$this->db->where('programada >= ', $data_inicio);
        $this->db->where('programada <= ', $data_fim);

		$this->db->from( $this->table );

		return $this->db->count_all_results();

	}

} 

?>
