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

	public function listar_dropdown(){

		$this->db->select( 'id, ne_id');

		$this->db->group_start();
		$this->db->where( 'removido !=', "1" );
		$this->db->or_where( 'removido IS NULL' );
		$this->db->group_end();
		
		$query = $this->db->get( $this->table );

		$sites = array();
		$result = $query->result_array();

		foreach ( $result as $site ) {

			$sites[ $site['id'] ] = $site['ne_id'];
		
		}

		return $sites;

	}

} 

?>
