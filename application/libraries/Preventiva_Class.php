<?php

/**
 * Classe que define os campos e seus métodos get e set para um objeto Preventiva.
 *
 * @category Preventiva
 * @author Luiz Felipe <lfgalindo@live.com>
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Preventiva_Class {

	private $id;
	private $tipo; 				// BTS-TX, Infra, FMT, Estrutural Torre, CCCs
	private $data_cadastro;
	private $micro_areas;
	private $area;
	private $programada; 		// (mes/ano)
	private $executada; 		// (data)
	private $relatorio; 		// (data)
	private $status;			// pendente, aguardando relatório, relatório em aprovação, aguardando novo relatório, finalizada
	private $id_site; 			// Site: exibir cidade, ddd )
	private $id_arquivo;
	private $id_tecnico;
	private $id_supervisor;
	private $id_usuario; 		// que realizou o cadastro


	/**
	 * Método que define os campos da tabela de preventivas no banco de dados.
	 * @return array
	*/
	public function schema(){

		return array(
              'id' => array(
                'type' => 'BIGINT',
				'unique' => true,
                'unsigned' => true,
                'auto_increment' => true
              ),
              'tipo' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
              ),
              'data_cadastro' => array(
                'type' => 'DATE',
                'null' => true
              ),
              'micro_areas' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
              ),
              'area' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
              ),
              'programada' => array(
                'type' => 'DATE',
                'null' => true
              ),
              'executada' => array(
                'type' => 'DATE',
                'null' => true
              ),
              'relatorio' => array(
                'type' => 'DATE',
                'null' => true
              ),
              'status' => array(
                'type' => 'INT',
                'null' => true
              ),
              'id_site' => array(
                'type' => 'BIGINT',
                'null' => true
              ),
              'id_arquivo' => array(
                'type' => 'BIGINT',
                'null' => true
              ),
              'id_tecnico' => array(
                'type' => 'BIGINT',
                'null' => true
              ),
              'id_supervisor' => array(
                'type' => 'BIGINT',
                'null' => true
              ),
              'id_usuario' => array(
                'type' => 'BIGINT',
                'null' => true
              )
           );

	} /** Fim do método schema*/


	/**
	 * Método para retornar o objeto em um array.
	 * @access public
	 * @param object $preventiva
	 */
	public function to_array( $preventiva ) {

		return array(
			'id' 			=> $preventiva->getID(),
			'tipo' 			=> $preventiva->getTipo(),
			'data_cadastro' => $preventiva->getDataCadastro(),
			'micro_areas' 	=> $preventiva->getMicroAreas(),
			'area' 			=> $preventiva->getArea(),
			'programada' 	=> $preventiva->getProgramada(),
			'executada' 	=> $preventiva->getExecutada(),
			'relatorio' 	=> $preventiva->getRelatorio(),
			'status' 		=> $preventiva->getStatus(),
			'id_site' 		=> $preventiva->getIDSite(),
			'id_arquivo' 	=> $preventiva->getIDArquivo(),
			'id_tecnico' 	=> $preventiva->getIDTecnico(),
			'id_supervisor' => $preventiva->getIDSupervisor(),
			'id_usuario' 	=> $preventiva->getIDUsuario()
		);

	}

	/**
	 * Método para retornar um array em um objeto.
	 * @access public
	 * @param array $preventiva
	 */
	public function to_object( $array, $preventiva ) {

		$preventiva->setID( 			$array['id'] );
		$preventiva->setTipo( 			$array['tipo'] );
		$preventiva->setDataCadastro( 	$array['data_cadastro'] );
		$preventiva->setMicroAreas( 	$array['micro_areas'] );
		$preventiva->setArea( 			$array['area'] );
		$preventiva->setProgramada( 	$array['programada'] );
		$preventiva->setExecutada( 		$array['executada'] );
		$preventiva->setRelatorio( 		$array['relatorio'] );
		$preventiva->setStatus( 		$array['status'] );
		$preventiva->setIDSite( 		$array['id_site'] );
		$preventiva->setIDArquivo( 		$array['id_arquivo'] );
		$preventiva->setIDTecnico( 		$array['id_tecnico'] );
		$preventiva->setIDSupervisor( 	$array['id_supervisor'] );
		$preventiva->setIDUsuario( 		$array['id_usuario'] );

		return $preventiva;

	}

	/** Gets e Sets dos atributos */
	public function getID(){
		return $this->id;
	}

	public function setID($id){
		$this->id = $id;
	}

	public function getTipo(){
		return $this->tipo;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}

	public function getDataCadastro(){
		return $this->data_cadastro;
	}

	public function setDataCadastro($data_cadastro){
		$this->data_cadastro = $data_cadastro;
	}

	public function getMicroAreas(){
		return $this->micro_areas;
	}

	public function setMicroAreas($micro_areas){
		$this->micro_areas = $micro_areas;
	}

	public function getArea(){
		return $this->area;
	}

	public function setArea($area){
		$this->area = $area;
	}

	public function getProgramada(){
		return $this->programada;
	}

	public function setProgramada($programada){
		$this->programada = $programada;
	}

	public function getExecutada(){
		return $this->executada;
	}

	public function setExecutada($executada){
		$this->executada = $executada;
	}

	public function getRelatorio(){
		return $this->relatorio;
	}

	public function setRelatorio($relatorio){
		$this->relatorio = $relatorio;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getIDSite(){
		return $this->id_site;
	}

	public function setIDSite($id_site){
		$this->id_site = $id_site;
	}

	public function getIDArquivo(){
		return $this->id_arquivo;
	}

	public function setIDArquivo($id_arquivo){
		$this->id_arquivo = $id_arquivo;
	}

	public function getIDTecnico(){
		return $this->id_tecnico;
	}

	public function setIDTecnico($id_tecnico){
		$this->id_tecnico = $id_tecnico;
	}

	public function getIDSupervisor(){
		return $this->id_supervisor;
	}

	public function setIDSupervisor($id_supervisor){
		$this->id_supervisor = $id_supervisor;
	}

	public function getIDUsuario(){
		return $this->id_usuario;
	}

	public function setIDUsuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}
	/** Fim do Sets e Gets */
}

?>