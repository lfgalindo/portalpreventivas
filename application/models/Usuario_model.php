<?php

/**
 * Classe responsável pela tabela de Usuario no banco de dados.
 *
 * @category Usuario
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Model extends MY_Model {

	/**
	* @var array 	$array 		Dados do objeto
	*/

	/** Método construtor. */
	public function __construct() {
		parent::__construct();
	}

	/**
	* Valida Login de um usuario
	*/
	public function verificar_login( $pessoa ) {

		$this->db->where("login", $pessoa->getLogin() );
		$this->db->where("senha", $pessoa->getSenha() );

		$query = $this->db->get( $this->table );

		if( $query->num_rows() == 1 ) {
			
			$pessoa = $query->result_array();

			return $pessoa[0]['id'];
		}

		return false;
	}

} 

?>
