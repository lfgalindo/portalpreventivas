<?php

/**
 * Classe responsável pela tabela de Usuario no banco de dados.
 *
 * @category Usuario
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	/**
	* @var string 	$table 		Nome da tabela que a instancia de model fará a persistencia
	*/
	protected $table;

	/** Método construtor. */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Função para determinar qual a tabela que será usada por esse model
	 **/
	public function setTable( $table ){
		$this->table = $table;
	}

	/**
	 * Insere um novo registro na tabela.
	 * @return bool
	 */
	public function inserir( $objeto ) {

		if( ! is_object( $objeto ) && empty( $objeto ) ) {
			return false;
		}

		$this->db->set( $objeto->to_array( $objeto) );
		return $this->db->insert( $this->table );

	}

	/**
	 * Deleta um registro no banco de dados.
	 * @return bool
	 */
	public function remover( $objeto ) {

		if( ! is_object( $objeto )  ) {
			return false;
		}

		$this->db->where('id', $objeto->getID() );
		return $this->db->delete( $this->table );
	}

	/**
	 * Atualiza um registro no banco de dados.
	 * @return bool
	 */
	public function atualizar( $objeto ) {

		if( ! is_object( $objeto )  ){
			return false;
		}
		
		$this->db->where('id', $objeto->getID() );
		return $this->db->update( $this->table, $objeto->to_array( $objeto ) );
	}

	/**
	 * Seleciona um registro pelo seu id.
	 * @return object
	 */
	public function selecionar( $objeto ) {

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
	public function listar( $maximo, $inicio, $search = "", $fields = null, $orders = null ) {

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
	 */
	public function contar_registros( $search = "", $fields = null ) {

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

		$this->db->from( $this->table );

		return $this->db->count_all_results();

	}

	/**
	 * Retorna se existe um registro de um determinado valor de um campo.
	 * @return int
	 */
	public function existe_cadastro( $nome_campo, $valor_campo, $id_registro = null ){
		
		$this->db->where( $nome_campo, $valor_campo );

		if ( $id_registro != null )
			$this->db->where( 'id !=', $id_registro );

		$query = $this->db->get( $this->table );

		if( $query->num_rows() >= 1 ) {
			
			return true;
		}

		return false;

	}

	/**
	 * Seleciona um registro por algum campo que exista na tabela.
	 * @return object
	 */
	public function selecionar_por_campo( $objeto, $nome_campo ) {

		$this->db->select();
		$this->db->from( $this->table );
		$this->db->where( $nome_campo, $objeto->getID() );
		$query = $this->db->get();

		/** Array com os resultados. */
		$array = $query->row_array();
		
		return $objeto->to_object( $array, $objeto );;		

	}

} 

?>
