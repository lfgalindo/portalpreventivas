<?php

/**
 * Classe que define os campos e seus métodos get e set para um objeto Perfil.
 *
 * @category Perfil
 * @author Luiz Felipe <lfgalindo@live.com>
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Site_Class {

	private $id;
	private $localidade;
	private $sigla_site;
	private $cidade;
	private $restricao;
	private $concessionaria;
	private $codigo_energia;

	/**
	 * Método que define os campos da tabela de perfis no banco de dados.
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
              'localidade' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'sigla_site' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'cidade' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'restricao' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'concessionaria' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'codigo_energia' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
           );

	} /** Fim do método schema*/


	/**
	 * Método para retornar o objeto em um array.
	 * @access public
	 * @param object $site
	 */
	public function to_array( $site ) {

		return array(
			'id'		 	 => $site->getID(),
			'localidade'	 => $site->getLocalidade(),
			'sigla_site'	 => $site->getSiglaSite(),
			'cidade'		 => $site->getCidade(),
			'restricao'		 => $site->getRestricao(),
			'concessionaria' => $site->getConcessionaria(),
			'codigo_energia' => $site->getCodigoEntrada(),
		);

	}

	/**
	 * Método para retornar um array em um objeto.
	 * @access public
	 * @param array $site
	 */
	public function to_object( $array, $site ) {

		$site->setID( 				$array['id'] );
		$site->setLocalidade(		$array['localidade']);
		$site->setSiglaSite(		$array['sigla_site']);
		$site->setCidade(			$array['cidade']);
		$site->setRestricao(		$array['restricao']);
		$site->setConcessionaria(	$array['concessionaria']);
		$site->setCodigoEntrada(	$array['codigo_energia']);

		return $site;

	}

	/** Gets e Sets dos atributos */
	public function getID(){
		return $this->id;
	}

	public function setID($id){
		$this->id = $id;
	}

	public function getLocalidade(){
		return $this->localidade;
	}

	public function setLocalidade($localidade){
		$this->localidade = $localidade;
	}

	public function getSiglaSite(){
		return $this->sigla_site;
	}

	public function setSiglaSite($sigla_site){
		$this->sigla_site = $sigla_site;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getRestricao(){
		return $this->restricao;
	}

	public function setRestricao($restricao){
		$this->restricao = $restricao;
	}

	public function getConcessionaria(){
		return $this->concessionaria;
	}

	public function setConcessionaria($concessionaria){
		$this->concessionaria = $concessionaria;
	}

	public function getCodigoEnergia(){
		return $this->codigo_energia;
	}

	public function setCodigoEnergia($codigo_energia){
		$this->codigo_energia = $codigo_energia;
	}

	/** Fim do Sets e Gets */
}

?>