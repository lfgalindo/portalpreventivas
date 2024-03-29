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
	public function listar_preventivas( $maximo, $inicio, $search = "", $search_tipo, $search_situacao, $search_cm, $data_inicio, $data_fim, $fields = null, $orders = null ) {

		$this->db->select( 'preventivas.*, sites.ne_id, sites.tipo_top, sites.end_id, sites.cm, supervisores.nome AS supervisor');

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

		if ( $search_cm != '0' )
			$this->db->where( 'sites.cm', $search_cm );

       	$this->db->where('programada >= ', $data_inicio);
        $this->db->where('programada <= ', $data_fim);

        $this->db->where( 'tipo !=', 'bts' ); // REMOVER
        
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
	public function contar_registros_preventivas( $search = "", $search_tipo, $search_situacao, $search_cm, $data_inicio, $data_fim, $fields = null ) {

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

		if ( $search_cm != '0' )
			$this->db->where( 'sites.cm', $search_cm );

       	$this->db->where('programada >= ', $data_inicio);
        $this->db->where('programada <= ', $data_fim);

		$this->db->from( $this->table );

		return $this->db->count_all_results();

	}

	public function listar_supervisores_graficos( $data_inicio, $data_fim, $tipo = null ) {

		$this->db->select( 'id_supervisor, supervisores.nome AS supervisor');

		$this->db->join('usuarios AS supervisores', 'preventivas.id_supervisor = supervisores.id', 'left');

       	$this->db->where('programada >= ', $data_inicio);
        $this->db->where('programada <= ', $data_fim);

        if ( ! is_null( $tipo ) )
        	$this->db->where( 'tipo', $tipo );
				
		$this->db->group_by( 'supervisor' );

		$query = $this->db->get( $this->table );

		return $query->result_array();
		
	}

	public function qtd_preventivas_por_supervisor( $id_supervisor, $data_inicio, $data_fim, $tipo = null ){

		$this->db->select( 'COUNT(id) AS qtd, status');

		$this->db->where('id_supervisor', $id_supervisor);

       	$this->db->where('programada >= ', $data_inicio);
        $this->db->where('programada <= ', $data_fim);

        if ( ! is_null( $tipo ) )
        	$this->db->where( 'tipo', $tipo );

        $this->db->group_by('status');

		$query = $this->db->get( $this->table );

		return $query->result_array();

	}

	public function listar_tecnicos_graficos( $supervisor, $data_inicio, $data_fim, $tipo = null ) {

		$this->db->select( 'id_tecnico, tecnicos.nome AS tecnico');

		$this->db->join('usuarios AS tecnicos', 'preventivas.id_tecnico = tecnicos.id', 'left');

        $this->db->where('id_supervisor', $supervisor);

       	$this->db->where('programada >= ', $data_inicio);
        $this->db->where('programada <= ', $data_fim);

        if ( ! is_null( $tipo ) )
        	$this->db->where( 'tipo', $tipo );
				
		$this->db->group_by( 'tecnico' );

		$query = $this->db->get( $this->table );

		return $query->result_array();
		
	}

	public function qtd_preventivas_por_tecnico( $id_supervisor, $id_tecnico, $data_inicio, $data_fim, $tipo = null ){

		$this->db->select( 'COUNT(id) AS qtd, status');

		$this->db->where('id_supervisor', $id_supervisor);
		$this->db->where('id_tecnico', $id_tecnico);

       	$this->db->where('programada >= ', $data_inicio);
        $this->db->where('programada <= ', $data_fim);

        if ( ! is_null( $tipo ) )
        	$this->db->where( 'tipo', $tipo );

        $this->db->group_by('status');

		$query = $this->db->get( $this->table );

		return $query->result_array();

	}


	/**
	 * Seleciona um registro selecionando varios campos para ver se ja exite a preventiva
	 * @return object
	 */
	public function existe_preventiva( $tipo, $data_programada, $id_site, $id_preventiva = null ) {

		$this->db->where( 'tipo', 			$tipo );
		$this->db->where( 'programada', 	$data_programada );
		$this->db->where( 'id_site',	 	$id_site );

		if ( ! is_null( $id_preventiva ) )
			$this->db->where( 'id !=', $id_preventiva );

		$query = $this->db->get( $this->table );

		if( $query->num_rows() >= 1 ) {
			
			return true;
		}

		return false;

	}


	/**
	 * Seleciona um registro selecionando varios campos para testar importação.
	 * @return object
	 */
	public function existe_import( $objeto ) {

		$this->db->where( 'tipo', 			$objeto->getTipo() );
		$this->db->where( 'programada', 	$objeto->getProgramada() );
		$this->db->where( 'id_site',	 	$objeto->getIDSite() );
		$this->db->where( 'id_supervisor', 	$objeto->getIDSupervisor() );

		$query = $this->db->get( $this->table );

		if( $query->num_rows() >= 1 ) {
			
			return true;
		}

		return false;

	}

	public function listar_preventivas_por_tipo( $tipo ) {

		$this->db->where( 'tipo', $tipo );

		$query = $this->db->get( $this->table );
		
		return $query->result_array();
		
	}

} 

?>
