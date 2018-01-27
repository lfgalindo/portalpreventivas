<?php

/**
 * Classe responsável pela tabela de Sites no banco de dados.
 *
 * @category Sites
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Site_Model extends MY_Model {

	/**
	* @var array 	$array 		Dados do objeto
	*/

	/** Método construtor. */
	public function __construct() {
		parent::__construct();
	}

	public function listar_dropdown( $search = "", $fields = null, $orders = null ) {

		$this->db->select('id, ne_id');

		if ( $search != "" || $fields != null ){

			$i = 0;
			$this->db->group_start();

			foreach ($fields as $field) {
				 
				$i == 0 ? $this->db->like( $field, $search ) : $this->db->or_like( $field, $search );

				$i++;

			}

			$this->db->group_end();

		}
				
		$this->db->group_start();
		$this->db->where( 'removido !=', "1" );
		$this->db->or_where( 'removido IS NULL' );
		$this->db->group_end();

		if ( ! is_null( $orders ) ){

			foreach ($orders as $order => $asc_desc ) {
				
				$this->db->order_by( $order, $asc_desc );

			}

		}

		$query = $this->db->get( $this->table );
		
		$sites = array();
		$result = $query->result_array();

		foreach ( $result as $site ) {

			array_push( $sites, array(
									"id" 	=> $site['id'],
									"text" 	=> $site['ne_id'] ) );
		
		}

		return $sites;
		
	}

} 

?>
