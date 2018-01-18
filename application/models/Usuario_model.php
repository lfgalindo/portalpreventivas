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
		$this->db->from( $table );
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
	public function listar( $table, $maximo, $inicio, $search = "", $fields = null ) {

		$this->db->select();

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
		
		$this->db->order_by('nome', 'ASC');
		$query = $this->db->get( $table, $maximo, $inicio );
		return $query->result_array();
		
	}

	/**
	 * Conta os registros existentes no banco.
	 * @return int
	 */
	public function contar_registros( $table, $search = "", $fields = null ) {

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

		$this->db->from( $table );

		return $this->db->count_all_results();

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

	/**
	 * Retorna se existe um registro de um determinado valor de um campo.
	 * @return int
	 */
	public function existe_cadastro($table, $nome_campo, $valor_campo, $id_registro = null ){
		
		$this->db->where( $nome_campo, $valor_campo );

		if ( $id_registro != null )
			$this->db->where( 'id !=', $id_registro );

		$query = $this->db->get( $table );

		if( $query->num_rows() >= 1 ) {
			
			return true;
		}

		return false;

	}

} 

?>
