<?php

/**
 * Classe que define os campos e seus métodos get e set para um objeto Arquivo.
 *
 * @category Arquivo
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Arquivo_Class {

	private $id;
	private $nome;
	private $tamanho;
	private $formato;
	private $raw;
	private $data_envio;
	private $aprovado;
	private $recusado;
	private $motivo_recusado;
	private $data_recusado_aprovado;
	private $id_usuario_recusado_aprovado;
	private $tabela;
	private $id_reg_tabela;
	private $id_usuario;

	/**
	 * Método que define os campos da tabela de sites no banco de dados.
	 * @return array
	*/
	public function schema() {

		return array(
			'id' => array(
				'type' => 'BIGINT',
				'unsigned' => true,
				'unique' => true,
	        	'auto_increment' => true
			),
			'nome' => array(
				'type' => 'VARCHAR',
				'constraint' => 45,
				'null' => false
			),
			'tamanho' => array(
				'type' => 'DOUBLE',
				'null' => false
			),
			'formato' => array(
				'type' => 'VARCHAR',
				'constraint' => 10,
				'null' => false
			),
			'raw' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => false
			),
			'data_envio' => array(
				'type' => 'DATETIME',
				'null' => false
			),
			'aprovado' => array(
				'type' => 'INT',
				'constraint' => 1,
				'null' => true,
				'default' => 0
			),
			'recusado' => array(
				'type' => 'INT',
				'constraint' => 1,
				'null' => true,
				'default' => 0
			),
			'motivo_recusado' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true
			),
			'data_recusado_aprovado' => array(
				'type' => 'DATETIME',
				'null' => true
			),
			'id_usuario_recusado_aprovado' => array(
				'type' => 'BIGINT',
				'null' => true
			),
			'tabela' => array(
				'type' => 'VARCHAR',
				'constraint' => 45,
				'null' => false
			),
			'id_reg_tabela' => array(
				'type' => 'BIGINT'
			),
			'id_usuario' => array(
				'type' => 'BIGINT'
			)


		);
	}
	
	/**
	 * Método para retornar o objeto em um array.
	 * @access public
	 * @param object $site
	 */
	public function to_array( $arquivo ) {

		return array(
			'id'		 					=> $arquivo->getID(),
			'nome' 							=> $arquivo->getNome(),
			'tamanho' 						=> $arquivo->getTamanho(),
			'formato' 						=> $arquivo->getFormato(),
			'raw' 							=> $arquivo->getRaw(),
			'data_envio' 					=> $arquivo->getDataEnvio(),
			'aprovado' 						=> $arquivo->getAprovado(),
			'recusado' 						=> $arquivo->getRecusado(),
			'motivo_recusado' 				=> $arquivo->getMotivoRecusado(),
			'data_recusado_aprovado' 		=> $arquivo->getDataRecusadoAprovado(),
			'id_usuario_recusado_aprovado' 	=> $arquivo->getIDUsuarioRecusadoAprovado(),
			'tabela' 						=> $arquivo->getTabela(),
			'id_reg_tabela' 				=> $arquivo->getIDRegTabela(),
			'id_usuario' 					=> $arquivo->getIDUsuario()
			
		);
	
	}

	/**
	 * Método para retornar um array em um objeto.
	 * @access public
	 * @param array $arquivo
	 */
	public function to_object( $array, $arquivo ) {

		$arquivo->setID( 						$array['id'] );
		$arquivo->setNome(						$array['nome'] );
		$arquivo->setTamanho(					$array['tamanho'] );
		$arquivo->setFormato(					$array['formato'] );
		$arquivo->setRaw(						$array['raw'] );
		$arquivo->setDataEnvio(					$array['data_envio'] );
		$arquivo->setAprovado(					$array['aprovado'] );
		$arquivo->setRecusado(					$array['recusado'] );
		$arquivo->setMotivoRecusado(			$array['motivo_recusado'] );
		$arquivo->setDataRecusadoAprovado(		$array['data_recusado_aprovado'] );
		$arquivo->setIDUsuarioRecusadoAprovado(	$array['id_usuario_recusado_aprovado'] );
		$arquivo->setTabela(					$array['tabela'] );
		$arquivo->setIDRegTabela(				$array['id_reg_tabela'] );
		$arquivo->setIDUsuario(					$array['id_usuario'] );
		
		return $arquivo;

	}

	/**
	 * Gets e Sets.
	 */
	public function setID( $id ) {
		$this->id = $id;
	}

	public function getID() {
		return $this->id;
	}

	public function setNome( $nome ) {
		$this->nome = $nome;
	}
	
	public function getNome() {
		return $this->nome;
	}

	public function setTamanho( $tamanho ) {
		$this->tamanho = $tamanho;
	}

	public function getTamanho() {
		return $this->tamanho;
	}

	public function setFormato( $formato ) {
		$this->formato = $formato;
	}

	public function getFormato() {
		return $this->formato;
	}

	public function setRaw( $raw ) {
		$this->raw = $raw;
	}

	public function getRaw() {
		return $this->raw;
	}

	public function getDataEnvio(){
		return $this->data_envio;
	}

	public function setDataEnvio($data_envio){
		$this->data_envio = $data_envio;
	}

	public function getAprovado(){
		return $this->aprovado;
	}

	public function setAprovado($aprovado){
		$this->aprovado = $aprovado;
	}

	public function getRecusado(){
		return $this->recusado;
	}

	public function setRecusado($recusado){
		$this->recusado = $recusado;
	}

	public function getMotivoRecusado(){
		return $this->motivo_recusado;
	}

	public function setMotivoRecusado($motivo_recusado){
		$this->motivo_recusado = $motivo_recusado;
	}

	public function getDataRecusadoAprovado(){
		return $this->data_recusado_aprovado;
	}

	public function setDataRecusadoAprovado($data_recusado_aprovado){
		$this->data_recusado_aprovado = $data_recusado_aprovado;
	}

	public function getIDUsuarioRecusadoAprovado(){
		return $this->id_usuario_recusado_aprovado;
	}

	public function setIDUsuarioRecusadoAprovado($id_usuario_recusado_aprovado){
		$this->id_usuario_recusado_aprovado = $id_usuario_recusado_aprovado;
	}

	public function getTabela(){
		return $this->tabela;
	}

	public function setTabela($tabela){
		$this->tabela = $tabela;
	}


	public function getIDRegTabela(){
		return $this->id_reg_tabela;
	}

	public function setIDRegTabela($id_reg_tabela){
		$this->id_reg_tabela = $id_reg_tabela;
	}


	public function getIDUsuario(){
		return $this->id_usuario;
	}

	public function setIDUsuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}


}