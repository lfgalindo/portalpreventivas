<?php

/**
 * Classe responsável pela tabela de Usuario no banco de dados.
 *
 * @category Usuario
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Model extends CI_Model {

	/**
	* @var array 	$array 		Dados do objeto
	*/

	/** Método construtor. */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Insere um novo registro na tabela.
	 * @return bool
	 */
	public function inserir( $table, $objeto ) {

		if( ! is_object( $objeto ) && empty( $objeto ) ) {
			return false;
		}

		var_dump( $objeto );

		$this->db->set( $objeto->to_array( $objeto) );
		return $this->db->insert( $table );

	}

	/**
	 * Deleta um registro no banco de dados.
	 * @return bool
	 */
	public function remover( $table, $objeto ) {

		if( ! is_object( $objeto )  ) {
			return false;
		}

		$this->db->where('id', $objeto->getID() );
		return $this->db->delete( $table );
	}

	/**
	 * Atualiza um registro no banco de dados.
	 * @return bool
	 */
	public function atualizar( $table, $objeto ) {

		if( ! is_object( $objeto )  ){
			return false;
		}
		
		$this->db->where('id', $objeto->getID() );
		return $this->db->update( $table, $objeto->to_array( $objeto ) );
	}

	/**
	 * Seleciona um registro pelo seu id.
	 * @return object
	 */
	public function selecionar( $table, $objeto ) {

		$this->db->select();
		$this->db->from( $this->table );
		$this->db->where('id', $objeto->getID() );
		$query = $this->db->get();

		/** Array com os resultados. */
		$array = $query->row_array();
		
		return $objeto->to_object( $array, $objeto );;		

	}

	/**
	 * Lista os registros do banco
	 * @return array
	 */
	public function listar($table, $params = null, $type = 'OR') {

		$i = 0;
		$this->db->select();

		if( is_array($params) && count($params) > 0):
		
			foreach( $params as $param ):

				if( $type == 'AND' ):
					$this->db->where( $param, 1 );
				else:
					if( $i == 0 ):
						$this->db->where( $param,  1 );	
					else:
						$this->db->or_where( $param, 1 );
					endif;	

					$i++;
				endif;

			endforeach;
		
		elseif( is_string( $params ) ):

			$this->db->where( $params, 1 );
		
		endif;
		
		$this->db->order_by('nome', 'ASC');
		$query = $this->db->get( $table );
		return $query->result_array();
	}

	/**
	 * Conta os registros existentes no banco.
	 * @return int
	 */
	public function contar_registros( $table ) {

		return $this->db->count_all( $table );

	}

	public function verificar_login( $table, $pessoa ) {

		$this->db->where("login", $pessoa->getLogin() );
		$this->db->where("senha", $pessoa->getSenha() );

		$query = $this->db->get( $table );

		if( $query->num_rows() == 1 ) {
			
			$pessoa = $query->result_array();

			return $pessoa[0]['id'];
		}

		return false;
	}

} 

?>