<?php

/**
 * Classe que define os campos e seus métodos get e set para um objeto Site.
 *
 * @category Site
 * @author Luiz Felipe <lfgalindo@live.com>
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Site_Class {

	private $id;
	private $id_tim;
	private $operadora;
	private $rede;
	private $tipo_ne;
	private $fornecedor;
	private $oper_msc_bsc;
    private $ne_id;
    private $tipo_top;
    private $end_id;
	private $restricao_acesso;
    private $observacoes;
    private $co_site;
    private $co_site_empresa;
    private $co_site_umts;
    private $tipo_bts;
    private $latitude;
    private $longitude;
    private $estado;
    private $cidade;
    private $ddd;
    private $endereco;
    private $bairro;
    private $cm;
    private $removido;

	/**
	 * Método que define os campos da tabela de sites no banco de dados.
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
              'id_tim' => array(
                'type' => 'BIGINT',
                'unsigned' => true
              ),
              'operadora' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'rede' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'tipo_ne' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'fornecedor' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'oper_msc_bsc' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'ne_id' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'tipo_top' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'end_id' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'restricao_acesso' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'observacoes' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'co_site' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'co_site_empresa' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'co_site_umts' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'tipo_bts' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'latitude' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'longitude' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'estado' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'cidade' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'ddd' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'endereco' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'bairro' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'cm' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'removido' => array(
                'type' => 'int',
                'null'	=> TRUE
              )
           );

	} /** Fim do método schema*/


	/**
	 * Método para retornar o objeto em um array.
	 * @access public
	 * @param object $site
	 */
	public function to_array( $site ) {

		return array(
			'id'		 		=> $site->getID(),
			'id_tim' 			=> $site->getIDTim(),
			'operadora'			=> $site->getOperadora(),
			'rede'				=> $site->getRede(),	
			'tipo_ne'			=> $site->getTipoNe(),
			'fornecedor'		=> $site->getFornecedor(),
			'oper_msc_bsc'		=> $site->getOperMscBsc(),
    		'ne_id'				=> $site->getNeId(),
    		'tipo_top'			=> $site->getTipoTop(),
    		'end_id'			=> $site->getEndId(),
			'restricao_acesso'	=> $site->getRestricaoAcesso(),
		    'observacoes'		=> $site->getObservacoes(),
		    'co_site'			=> $site->getCoSite(),
		    'co_site_empresa'	=> $site->getCoSiteEmpresa(),
		    'co_site_umts'		=> $site->getCoSiteUmts(),
		    'tipo_bts'			=> $site->getTipoBts(),
		    'latitude'			=> $site->getLatitude(),
		    'longitude'			=> $site->getLongitude(),
			'estado'			=> $site->getEstado(),
		    'cidade'			=> $site->getCidade(),
		    'ddd'				=> $site->getDDD(),
		    'endereco'			=> $site->getEndereco(),
		    'bairro'			=> $site->getBairro(),
		    'cm'				=> $site->getCm(),
		    'removido'			=> $site->getRemovido(),
		);

	}

	/**
	 * Método para retornar um array em um objeto.
	 * @access public
	 * @param array $site
	 */
	public function to_object( $array, $site ) {

		$site->setID( 				$array['id'] );
		$site->setIDTim(			$array['id_tim']);
		$site->setOperadora(		$array['operadora']);
		$site->setRede(				$array['rede']);
		$site->setTipoNe(			$array['tipo_ne']);
		$site->setFornecedor(		$array['fornecedor']);
		$site->setOperMscBsc(		$array['oper_msc_bsc']);
    	$site->setNeId(				$array['ne_id']);
    	$site->setTipoTop(			$array['tipo_top']);
    	$site->setEndId(			$array['end_id']);
		$site->setRestricaoAcesso(	$array['restricao_acesso']);
		$site->setObservacoes(		$array['observacoes']);
		$site->setCoSite( 			$array['co_site']);
		$site->setCoSiteEmpresa( 	$array['co_site_empresa']);
		$site->setCoSiteUmts( 		$array['co_site_umts']);
		$site->setTipoBts(			$array['tipo_bts']);
		$site->setLatitude(			$array['latitude']);
		$site->setLongitude( 		$array['longitude']);
		$site->setEstado(			$array['estado']);
		$site->setCidade(			$array['cidade']);
		$site->setDDD(				$array['ddd']);
		$site->setEndereco(			$array['endereco']);
		$site->setBairro(			$array['bairro']);
		$site->setCm(				$array['cm']);
		$site->setRemovido(			$array['removido']);

		return $site;

	}

	/** Gets e Sets dos atributos */
	public function getID(){
		return $this->id;
	}

	public function setID($id){
		$this->id = $id;
	}

	public function getIDTim(){
		return $this->id_tim;
	}

	public function setIDTim($id_tim){
		$this->id_tim = $id_tim;
	}

	public function getOperadora(){
		return $this->operadora;
	}

	public function setOperadora($operadora){
		$this->operadora = $operadora;
	}

	public function getRede(){
		return $this->rede;
	}

	public function setRede($rede){
		$this->rede = $rede;
	}

	public function getTipoNe(){
		return $this->tipo_ne;
	}

	public function setTipoNe($tipo_ne){
		$this->tipo_ne = $tipo_ne;
	}

	public function getFornecedor(){
		return $this->fornecedor;
	}

	public function setFornecedor($fornecedor){
		$this->fornecedor = $fornecedor;
	}

	public function getOperMscBsc(){
		return $this->oper_msc_bsc;
	}

	public function setOperMscBsc($oper_msc_bsc){
		$this->oper_msc_bsc = $oper_msc_bsc;
	}

	public function getNeId(){
		return $this->ne_id;
	}

	public function setNeId($ne_id){
		$this->ne_id = $ne_id;
	}

	public function getTipoTop(){
		return $this->tipo_top;
	}

	public function setTipoTop($tipo_top){
		$this->tipo_top = $tipo_top;
	}

	public function getEndId(){
		return $this->end_id;
	}

	public function setEndId($end_id){
		$this->end_id = $end_id;
	}

	public function getRestricaoAcesso(){
		return $this->restricao_acesso;
	}

	public function setRestricaoAcesso($restricao_acesso){
		$this->restricao_acesso = $restricao_acesso;
	}

	public function getObservacoes(){
		return $this->observacoes;
	}

	public function setObservacoes($observacoes){
		$this->observacoes = $observacoes;
	}

	public function getCoSite(){
		return $this->co_site;
	}

	public function setCoSite($co_site){
		$this->co_site = $co_site;
	}

	public function getCoSiteEmpresa(){
		return $this->co_site_empresa;
	}

	public function setCoSiteEmpresa($co_site_empresa){
		$this->co_site_empresa = $co_site_empresa;
	}

	public function getCoSiteUmts(){
		return $this->co_site_umts;
	}

	public function setCoSiteUmts($co_site_umts){
		$this->co_site_umts = $co_site_umts;
	}

	public function getTipoBts(){
		return $this->tipo_bts;
	}

	public function setTipoBts($tipo_bts){
		$this->tipo_bts = $tipo_bts;
	}

	public function getLatitude(){
		return $this->latitude;
	}

	public function setLatitude($latitude){
		$this->latitude = $latitude;
	}

	public function getLongitude(){
		return $this->longitude;
	}

	public function setLongitude($longitude){
		$this->longitude = $longitude;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getDDD(){
		return $this->ddd;
	}

	public function setDDD($ddd){
		$this->ddd = $ddd;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}

	public function getBairro(){
		return $this->bairro;
	}

	public function setBairro($bairro){
		$this->bairro = $bairro;
	}

	public function getCm(){
		return $this->cm;
	}

	public function setCm($cm){
		$this->cm = $cm;
	}

	public function getRemovido(){
		return $this->removido;
	}

	public function setRemovido($removido){
		$this->removido = $removido;
	}

	/** Fim do Sets e Gets */
}

?>