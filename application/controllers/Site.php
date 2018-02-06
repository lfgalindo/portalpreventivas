<?php

/**
 * Controller para sites.
 * @category Controller
 * @author Luiz Felipe Magalhães Galindo <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	/**
	 * Método construtor.
	 */
	public function __construct() {
		
		parent::__construct();	

		//Models
		$this->load->model('configuracao_model');
		$this->configuracao_model->setTable('configuracoes');
		
		$this->load->model('site_model');
		$this->site_model->setTable('sites');

		//Classes
		$this->load->library('site_class');
		$this->load->library('form_validation');

		//Helpers
		//$this->load->helper('paginacao_helper');

		$this->template->set('title', 'Sites');

	}

	/**
	 * Página inicial.
	 */
	public function index() {

		check_permission('visualizar_sites', 'inicio');

		$fields = array( 'id_tim', 'operadora', 'rede', 'tipo_ne', 'fornecedor', 'ne_id', 'observacoes', 'cidade', 'estado', 'endereco', 'bairro', 'cm' );
		$orders = array("ne_id" => "ASC");

		$search_string = $this->input->get('search') ? $this->input->get('search') : "";
		$dados['search_string'] = $search_string;

		// Montar paginação
		$maximo = $this->configuracao_model->selecionar_valor('qtd_pagina');
		$inicio = $this->input->get('inicio') ? $this->input->get('inicio') : 0;

		$config['enable_query_strings'] = true;
		$config['page_query_string'] 	= true;
		$config['reuse_query_string']	= true;
		$config['per_page'] 			= $maximo;
		$config['query_string_segment'] = 'inicio';
		$config['last_link'] 			= "Última";
		$config['first_link'] 			= "Primeira";
		$config['base_url'] 			= base_url('sites');	 
		$config['total_rows'] 			= $this->site_model->contar_registros( $search_string, $fields );

		$this->pagination->initialize( $config );

		$dados["paginacao"] = $this->pagination->create_links();

		$sites = $this->site_model->listar( $maximo, $inicio, $search_string, $fields, $orders );

		$dados['sites'] = $sites;

		$this->template->load('template.php', 'sites/index-view.php', $dados);

	}//Fim do método index

	//Método para visualizar todos os dados de um site
	public function visualizar( $id ){

		check_permission('visualizar_sites', 'inicio');

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("sites");
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("sites");
		}

		$site = new Site_Class();
		$site->setID( $id );

		$site = $this->site_model->selecionar( $site );

		$data['site'] = $site;

		$this->template->load('template.php', 'sites/visualizar-view.php', $data);

	}

	//Método para inserir um novo registro no banco de dados
	public function cadastrar(){

		check_permission('cadastrar_sites', 'sites');

		$this->form_validation->set_rules('ne_id', 'NE ID', 'required');
		
		// Verificar validações.
		if( ! $this->form_validation->run() ) {

			// Se ocorreu o submit exibir os erros
			if( ! empty( $this->form_validation->error_array() ) ):
				foreach( $this->form_validation->error_array() as $errors ):
					$this->flashmessages->error( $errors );
				endforeach;
			endif;

			$this->template->load('template.php', 'sites/cadastrar-view.php');

		} else {

			// Criamos objeto para cadastro
			$site = new Site_Class();

			$site->setIDTim(			$this->input->post('id_tim') );
			$site->setOperadora(		$this->input->post('operadora') );
			$site->setRede(				$this->input->post('rede') );
			$site->setTipoNe(			$this->input->post('tipo_ne') );
			$site->setFornecedor(		$this->input->post('fornecedor') );
			$site->setOperMscBsc(		$this->input->post('oper_msc_bsc') );
	    	$site->setNeId(				$this->input->post('ne_id') );
			$site->setRestricaoAcesso(	$this->input->post('restricao_acesso') );
			$site->setObservacoes(		$this->input->post('observacoes') );
			$site->setEstado(			$this->input->post('estado') );
			$site->setCidade(			$this->input->post('cidade') );
			$site->setDDD(				$this->input->post('ddd') );
			$site->setEndereco(			$this->input->post('endereco') );
			$site->setBairro(			$this->input->post('bairro') );
			$site->setCm(				$this->input->post('cm') );
			$site->setRemovido(			$this->input->post('removido') );


			$this->site_model->inserir( $site );

			// Excluimos o objeto após sua utilização.
			unset( $site );

			$this->flashmessages->success('Site cadastrado com sucesso!');
			redirect("sites");
		}

	}//Fim do método cadastrar

	//Método para editar um registro do banco
	public function editar( $id ){

		check_permission('editar_sites', 'sites');

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("sites");
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("sites");
		}

		$site = new Site_Class();
		$site->setID( $id );

		$site = $this->site_model->selecionar( $site );

		$data['site'] = $site;

		$this->form_validation->set_rules('ne_id', 'NE ID', 'required');

		// Verificar validações.
		if( ! $this->form_validation->run() ) {

			// Se ocorreu o submit exibir os erros
			if( ! empty( $this->form_validation->error_array() ) ):
				foreach( $this->form_validation->error_array() as $errors ):
					$this->flashmessages->error( $errors );
				endforeach;
			endif;

			$this->template->load('template.php', 'sites/editar-view.php', $data);

		} else {

			// Alteramos o objeto para cadastro no banco
			$site->setIDTim(			$this->input->post('id_tim') );
			$site->setOperadora(		$this->input->post('operadora') );
			$site->setRede(				$this->input->post('rede') );
			$site->setTipoNe(			$this->input->post('tipo_ne') );
			$site->setFornecedor(		$this->input->post('fornecedor') );
			$site->setOperMscBsc(		$this->input->post('oper_msc_bsc') );
	    	$site->setNeId(				$this->input->post('ne_id') );
			$site->setRestricaoAcesso(	$this->input->post('restricao_acesso') );
			$site->setObservacoes(		$this->input->post('observacoes') );
			$site->setEstado(			$this->input->post('estado') );
			$site->setCidade(			$this->input->post('cidade') );
			$site->setDDD(				$this->input->post('ddd') );
			$site->setEndereco(			$this->input->post('endereco') );
			$site->setBairro(			$this->input->post('bairro') );
			$site->setCm(				$this->input->post('cm') );
			$site->setRemovido(			$this->input->post('removido') );

			$this->site_model->atualizar( $site );

			// Excluimos o objeto após sua utilização.
			unset( $site );

			$this->flashmessages->success('Site alterado com sucesso!');
			redirect("sites");
		}		

	}//Fim do método editar

	//Método para remover um registro do banco
	public function remover( $id ){
		
		check_permission('remover_sites', 'sites');

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("sites");
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("sites");
		}

		$site = new Site_Class();
		$site->setID( $id );

		$site = $this->site_model->selecionar( $site );

		$site->setRemovido('1');

		$this->site_model->atualizar( $site );

		// Excluimos o objeto após sua utilização.
		unset( $site );

		$this->flashmessages->success('Site removido com sucesso!');
		redirect("sites");


	}//Fim do método remover


	//Método para listar os registros via Ajax
	public function ajax_listar_sites() {

		// Headers.
		header('Content-Type: application/json');

		try {

			if( ! $this->input->is_ajax_request() )
				throw new Exception("A requisição não pode ser realizada dessa forma.");

			if( $this->input->server('REQUEST_METHOD') != 'GET' )
				throw new Exception("As informações devem chegar via GET.");


			$search_string = $this->input->get('q');

			$fields = array( 'id_tim', 'operadora', 'rede', 'tipo_ne', 'fornecedor', 'ne_id', 'observacoes', 'cidade', 'estado', 'endereco', 'bairro', 'cm' );
			$orders = array("ne_id" => "ASC");

			$sites = $this->site_model->listar_dropdown( $search_string, $fields, $orders );

			$result = array(
						"results" => $sites,
						"count_filtered" => count( $sites )
						);

			echo json_encode( $result );

		} catch( Exception $e ) {
			echo json_encode(
				array(
					'message'	=> $e->getMessage()
				)
			);
		}

		return;

	}//Fim do método listar - Ajax

	//Método para selecionar dados do site via Ajax
	public function ajax_selecionar_site() {

		// Headers.
		header('Content-Type: application/json');

		try {

			if( ! $this->input->is_ajax_request() )
				throw new Exception("A requisição não pode ser realizada dessa forma.");

			if( $this->input->server('REQUEST_METHOD') != 'POST' )
				throw new Exception("As informações devem chegar via POST.");


			$id = $this->input->post('id');

			$site = new Site_CLass();
			$site->setID( $id );

			$site = $this->site_model->selecionar( $site );
			$site_array = $site->to_array( $site );

			echo json_encode( $site_array );

		} catch( Exception $e ) {
			echo json_encode(
				array(
					'message'	=> $e->getMessage()
				)
			);
		}

		return;

	}//Fim do método selecionar - Ajax

}//Fim da classe Servicos