<?php

/**
 * Classe que define os campos e seus métodos get e set para um objeto Inventario.
 *
 * @category Usuário
 * @author Luiz Felipe <lfgalindo@live.com>
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_Class {

	private $id;
	private $entrada;
	private $cadeado_entrada;
	private $cercamento;
	private $vandalismo;
	private $material_sobra;
	private $modelo_gmg;
	private $capacidade_gmg;
	private $quadro_energia_protecao;
	private $quadro_energia_tamanho;
	private $disjuntor_geral;
	private $disjuntores_consumidores;
	private $tomada_gmg;
	private $caixa_passagem_cabos;
	private $protetores_surto;
	private $qtd_gabinetes;
	private $modelo_gabinetes;
	private $cadeado_gabinetes;
	private $seguranca;
	private $tipo_protecao;
	private $infiltracao;
	private $ventiladores;
	private $ar_condicionado;
	private $extintor;
	private $vedacao_cabos;
	private $qcab;
	private $lampadas;
	private $aterramento;
	private $para_raio;
	private $egb_tgb;
	private $fonte;
	private $retificadores;
	private $bateria;
	private $protecao_baterias;
	private $radio_fabricante;
	private $radio_modelo;
	private $frequencia;
	private $protecao_idu;
	private $config_odu;
	private $qtd_odu;
	private $qtd_protecao_odu;
	private $pendencia;
	private $data;
	private $usuario;
	private $passo;
	private $id_site;

	/**
	 * Método que define os campos da tabela de inventarios no banco de dados.
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
	            'entrada' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'cadeado_entrada' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'cercamento' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'vandalismo' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'material_sobra' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'modelo_gmg' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'capacidade_gmg' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'quadro_energia_protecao' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'quadro_energia_tamanho' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'disjuntor_geral' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'disjuntores_consumidores' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'tomada_gmg' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'caixa_passagem_cabos' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'protetores_surto' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'qtd_gabinetes' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'modelo_gabinetes' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'cadeado_gabinetes' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'seguranca' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'tipo_protecao' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'infiltracao' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'ventiladores' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'ar_condicionado' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'extintor' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'vedacao_cabos' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'qcab' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'lampadas' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'aterramento' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'para_raio' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'egb_tgb' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'fonte' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'retificadores' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'bateria' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'protecao_baterias' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'radio_fabricante' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'radio_modelo' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'frequencia' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'protecao_idu' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'config_odu' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'qtd_odu' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'qtd_protecao_odu' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'pendencia' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'data' => array(
				    'type' => 'DATETIME',
				    'null' => TRUE,
				),
				'usuario' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'passo' => array(
				    'type' => 'VARCHAR',
				    'null' => TRUE,
				    'constraint' => '255',
				),
				'id_site' => array(
				    'type' => 'INT',
				    'null' => TRUE,
				    'constraint' => '5',
				)
           );

	} /** Fim do método schema*/


	/**
	 * Método para retornar o objeto em um array.
	 * @access public
	 * @param object $inventario
	 */
	public function to_array( $inventario ) {

		return array(
			'id' 							=> $inventario->getID(),
			'entrada'                       => $inventario->getEntrada(),
			'cadeado_entrada'               => $inventario->getCadeadoEntrada(),
			'cercamento'                    => $inventario->getCercamento(),
			'vandalismo'                    => $inventario->getVandalismo(),
			'material_sobra'                => $inventario->getMaterialSobra(),
			'modelo_gmg'                    => $inventario->getModeloGMG(),
			'capacidade_gmg'                => $inventario->getCapacidadeGMG(),
			'quadro_energia_protecao'       => $inventario->getQuadroEnergiaProtecao(),
			'quadro_energia_tamanho'        => $inventario->getQuadroEnergiaTamanho(),
			'disjuntor_geral'               => $inventario->getDisjuntorGeral(),
			'disjuntores_consumidores'      => $inventario->getDisjuntoresConsumidores(),
			'tomada_gmg'                    => $inventario->getTomadaGMG(),
			'caixa_passagem_cabos'          => $inventario->getCaixaPassagemCabos(),
			'protetores_surto'              => $inventario->getProtetoresSurto(),
			'qtd_gabinetes'                 => $inventario->getQtdGabinetes(),
			'modelo_gabinetes'              => $inventario->getModeloGabinetes(),
			'cadeado_gabinetes'             => $inventario->getCadeadoGabinetes(),
			'seguranca'                     => $inventario->getSeguranca(),
			'tipo_protecao'                 => $inventario->getTipoProtecao(),
			'infiltracao'                   => $inventario->getInfiltracao(),
			'ventiladores'                  => $inventario->getVentiladores(),
			'ar_condicionado'               => $inventario->getArCondicionado(),
			'extintor'                      => $inventario->getExtintor(),
			'vedacao_cabos'                 => $inventario->getVedacaoCabos(),
			'qcab'                  		=> $inventario->getQCAB(),
			'lampadas'                      => $inventario->getLampadas(),
			'aterramento'                   => $inventario->getAterramento(),
			'para_raio'                     => $inventario->getParaRaio(),
			'egb_tgb'                       => $inventario->getEgbTgb(),
			'fonte'                         => $inventario->getFonte(),
			'retificadores'                 => $inventario->getRetificadores(),
			'bateria'                       => $inventario->getBateria(),
			'protecao_baterias'             => $inventario->getProtecaoBaterias(),
			'radio_fabricante'              => $inventario->getRadioFabricante(),
			'radio_modelo'                  => $inventario->getRadioModelo(),
			'frequencia'                    => $inventario->getFrequencia(),
			'protecao_idu'                  => $inventario->getProtecaoIdu(),
			'config_odu'                    => $inventario->getConfigOdu(),
			'qtd_odu'                       => $inventario->getQtdOdu(),
			'qtd_protecao_odu'              => $inventario->getQtdProtecaoOdu(),
			'pendencia'                     => $inventario->getPendencia(),
			'data'                  		=> $inventario->getData(),
			'usuario'                       => $inventario->getUsuario(),
			'passo'                         => $inventario->getPasso(),
			'id_site'                       => $inventario->getIDSite()
		);

	}

	/**
	 * Método para retornar um array em um objeto.
	 * @access public
	 * @param array $inventario
	 */
	public function to_object( $array, $inventario ) {

		$inventario->setID( 		$array['id'] );
		$inventario->setentrada( $array['entrada'] );
		$inventario->setCadeadoEntrada( $array['cadeado_entrada'] );
		$inventario->setCercamento( $array['cercamento'] );
		$inventario->setVandalismo( $array['vandalismo'] );
		$inventario->setMaterialSobra( $array['material_sobra'] );
		$inventario->setModeloGMG( $array['modelo_gmg'] );
		$inventario->setCapacidadeGMG( $array['capacidade_gmg'] );
		$inventario->setQuadroEnergiaProtecao( $array['quadro_energia_protecao'] );
		$inventario->setQuadroEnergiaTamanho( $array['quadro_energia_tamanho'] );
		$inventario->setDisjuntorGeral( $array['disjuntor_geral'] );
		$inventario->setDisjuntoresConsumidores( $array['disjuntores_consumidores'] );
		$inventario->setTomadaGMG( $array['tomada_gmg'] );
		$inventario->setCaixaPassagemCabos( $array['caixa_passagem_cabos'] );
		$inventario->setProtetoresSurto( $array['protetores_surto'] );
		$inventario->setQtdGabinetes( $array['qtd_gabinetes'] );
		$inventario->setModeloGabinetes( $array['modelo_gabinetes'] );
		$inventario->setCadeadoGabinetes( $array['cadeado_gabinetes'] );
		$inventario->setSeguranca( $array['seguranca'] );
		$inventario->setTipoProtecao( $array['tipo_protecao'] );
		$inventario->setInfiltracao( $array['infiltracao'] );
		$inventario->setVentiladores( $array['ventiladores'] );
		$inventario->setArCondicionado( $array['ar_condicionado'] );
		$inventario->setExtintor( $array['extintor'] );
		$inventario->setVedacaoCabos( $array['vedacao_cabos'] );
		$inventario->setQCAB( $array['qcab'] );
		$inventario->setLampadas( $array['lampadas'] );
		$inventario->setAterramento( $array['aterramento'] );
		$inventario->setParaRaio( $array['para_raio'] );
		$inventario->setEgbTgb( $array['egb_tgb'] );
		$inventario->setFonte( $array['fonte'] );
		$inventario->setRetificadores( $array['retificadores'] );
		$inventario->setBateria( $array['bateria'] );
		$inventario->setProtecaoBaterias( $array['protecao_baterias'] );
		$inventario->setRadioFabricante( $array['radio_fabricante'] );
		$inventario->setRadioModelo( $array['radio_modelo'] );
		$inventario->setFrequencia( $array['frequencia'] );
		$inventario->setProtecaoIdu( $array['protecao_idu'] );
		$inventario->setConfigOdu( $array['config_odu'] );
		$inventario->setQtdOdu( $array['qtd_odu'] );
		$inventario->setQtdProtecaoOdu( $array['qtd_protecao_odu'] );
		$inventario->setPendencia( $array['pendencia'] );
		$inventario->setData( $array['data'] );
		$inventario->setUsuario( $array['usuario'] );
		$inventario->setPasso( $array['passo'] );
		$inventario->setIDSite( $array['id_site'] );

		return $inventario;

	}

	/** Gets e Sets dos atributos */
	public function getID(){
		return $this->id;
	}

	public function setID($id){
		$this->id = $id;
	}

		public function getEntrada(){
		return $this->entrada;
	}

	public function setEntrada($entrada){
		$this->entrada = $entrada;
	}

	public function getCadeadoEntrada(){
		return $this->cadeado_entrada;
	}

	public function setCadeadoEntrada($cadeado_entrada){
		$this->cadeado_entrada = $cadeado_entrada;
	}

	public function getCercamento(){
		return $this->cercamento;
	}

	public function setCercamento($cercamento){
		$this->cercamento = $cercamento;
	}

	public function getVandalismo(){
		return $this->vandalismo;
	}

	public function setVandalismo($vandalismo){
		$this->vandalismo = $vandalismo;
	}

	public function getMaterialSobra(){
		return $this->material_sobra;
	}

	public function setMaterialSobra($material_sobra){
		$this->material_sobra = $material_sobra;
	}

	public function getModeloGMG(){
		return $this->modelo_gmg;
	}

	public function setModeloGMG($modelo_gmg){
		$this->modelo_gmg = $modelo_gmg;
	}

	public function getCapacidadeGMG(){
		return $this->capacidade_gmg;
	}

	public function setCapacidadeGMG($capacidade_gmg){
		$this->capacidade_gmg = $capacidade_gmg;
	}

	public function getQuadroEnergiaProtecao(){
		return $this->quadro_energia_protecao;
	}

	public function setQuadroEnergiaProtecao($quadro_energia_protecao){
		$this->quadro_energia_protecao = $quadro_energia_protecao;
	}

	public function getQuadroEnergiaTamanho(){
		return $this->quadro_energia_tamanho;
	}

	public function setQuadroEnergiaTamanho($quadro_energia_tamanho){
		$this->quadro_energia_tamanho = $quadro_energia_tamanho;
	}

	public function getDisjuntorGeral(){
		return $this->disjuntor_geral;
	}

	public function setDisjuntorGeral($disjuntor_geral){
		$this->disjuntor_geral = $disjuntor_geral;
	}

	public function getDisjuntoresConsumidores(){
		return $this->disjuntores_consumidores;
	}

	public function setDisjuntoresConsumidores($disjuntores_consumidores){
		$this->disjuntores_consumidores = $disjuntores_consumidores;
	}

	public function getTomadaGMG(){
		return $this->tomada_gmg;
	}

	public function setTomadaGMG($tomada_gmg){
		$this->tomada_gmg = $tomada_gmg;
	}

	public function getCaixaPassagemCabos(){
		return $this->caixa_passagem_cabos;
	}

	public function setCaixaPassagemCabos($caixa_passagem_cabos){
		$this->caixa_passagem_cabos = $caixa_passagem_cabos;
	}

	public function getProtetoresSurto(){
		return $this->protetores_surto;
	}

	public function setProtetoresSurto($protetores_surto){
		$this->protetores_surto = $protetores_surto;
	}

	public function getQtdGabinetes(){
		return $this->qtd_gabinetes;
	}

	public function setQtdGabinetes($qtd_gabinetes){
		$this->qtd_gabinetes = $qtd_gabinetes;
	}

	public function getModeloGabinetes(){
		return $this->modelo_gabinetes;
	}

	public function setModeloGabinetes($modelo_gabinetes){
		$this->modelo_gabinetes = $modelo_gabinetes;
	}

	public function getCadeadoGabinetes(){
		return $this->cadeado_gabinetes;
	}

	public function setCadeadoGabinetes($cadeado_gabinetes){
		$this->cadeado_gabinetes = $cadeado_gabinetes;
	}

	public function getSeguranca(){
		return $this->seguranca;
	}

	public function setSeguranca($seguranca){
		$this->seguranca = $seguranca;
	}

	public function getTipoProtecao(){
		return $this->tipo_protecao;
	}

	public function setTipoProtecao($tipo_protecao){
		$this->tipo_protecao = $tipo_protecao;
	}

	public function getInfiltracao(){
		return $this->infiltracao;
	}

	public function setInfiltracao($infiltracao){
		$this->infiltracao = $infiltracao;
	}

	public function getVentiladores(){
		return $this->ventiladores;
	}

	public function setVentiladores($ventiladores){
		$this->ventiladores = $ventiladores;
	}

	public function getArCondicionado(){
		return $this->ar_condicionado;
	}

	public function setArCondicionado($ar_condicionado){
		$this->ar_condicionado = $ar_condicionado;
	}

	public function getExtintor(){
		return $this->extintor;
	}

	public function setExtintor($extintor){
		$this->extintor = $extintor;
	}

	public function getVedacaoCabos(){
		return $this->vedacao_cabos;
	}

	public function setVedacaoCabos($vedacao_cabos){
		$this->vedacao_cabos = $vedacao_cabos;
	}

	public function getQCAB(){
		return $this->qcab;
	}

	public function setQCAB($qcab){
		$this->qcab = $qcab;
	}

	public function getLampadas(){
		return $this->lampadas;
	}

	public function setLampadas($lampadas){
		$this->lampadas = $lampadas;
	}

	public function getAterramento(){
		return $this->aterramento;
	}

	public function setAterramento($aterramento){
		$this->aterramento = $aterramento;
	}

	public function getParaRaio(){
		return $this->para_raio;
	}

	public function setParaRaio($para_raio){
		$this->para_raio = $para_raio;
	}

	public function getEgbTgb(){
		return $this->egb_tgb;
	}

	public function setEgbTgb($egb_tgb){
		$this->egb_tgb = $egb_tgb;
	}

	public function getFonte(){
		return $this->fonte;
	}

	public function setFonte($fonte){
		$this->fonte = $fonte;
	}

	public function getRetificadores(){
		return $this->retificadores;
	}

	public function setRetificadores($retificadores){
		$this->retificadores = $retificadores;
	}

	public function getBateria(){
		return $this->bateria;
	}

	public function setBateria($bateria){
		$this->bateria = $bateria;
	}

	public function getProtecaoBaterias(){
		return $this->protecao_baterias;
	}

	public function setProtecaoBaterias($protecao_baterias){
		$this->protecao_baterias = $protecao_baterias;
	}

	public function getRadioFabricante(){
		return $this->radio_fabricante;
	}

	public function setRadioFabricante($radio_fabricante){
		$this->radio_fabricante = $radio_fabricante;
	}

	public function getRadioModelo(){
		return $this->radio_modelo;
	}

	public function setRadioModelo($radio_modelo){
		$this->radio_modelo = $radio_modelo;
	}

	public function getFrequencia(){
		return $this->frequencia;
	}

	public function setFrequencia($frequencia){
		$this->frequencia = $frequencia;
	}

	public function getProtecaoIdu(){
		return $this->protecao_idu;
	}

	public function setProtecaoIdu($protecao_idu){
		$this->protecao_idu = $protecao_idu;
	}

	public function getConfigOdu(){
		return $this->config_odu;
	}

	public function setConfigOdu($config_odu){
		$this->config_odu = $config_odu;
	}

	public function getQtdOdu(){
		return $this->qtd_odu;
	}

	public function setQtdOdu($qtd_odu){
		$this->qtd_odu = $qtd_odu;
	}

	public function getQtdProtecaoOdu(){
		return $this->qtd_protecao_odu;
	}

	public function setQtdProtecaoOdu($qtd_protecao_odu){
		$this->qtd_protecao_odu = $qtd_protecao_odu;
	}

	public function getPendencia(){
		return $this->pendencia;
	}

	public function setPendencia($pendencia){
		$this->pendencia = $pendencia;
	}

	public function getData(){
		return $this->data;
	}

	public function setData($data){
		$this->data = $data;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getPasso(){
		return $this->passo;
	}

	public function setPasso($passo){
		$this->passo = $passo;
	}

	public function getIDSite(){
		return $this->id_site;
	}

	public function setIDSite($id_site){
		$this->id_site = $id_site;
	}
	/** Fim do Sets e Gets */
}

?>