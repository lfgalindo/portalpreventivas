<?php

/**
 * Controller para preventivas.
 * @category Controller
 * @author Luiz Felipe Magalhães Galindo <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Preventiva extends CI_Controller {

	/**
	 * Método construtor.
	 */
	public function __construct() {
		
		parent::__construct();	

		//Models
		$this->load->model('site_model');
		$this->site_model->setTable('sites');

		$this->load->model('preventiva_model');
		$this->preventiva_model->setTable('preventivas');

		//Classes
		$this->load->library('preventiva_class');
		$this->load->library('form_validation');

		$this->template->set('title', 'Preventivas');

	}

	/**
	 * Página inicial.
	 */
	public function index() {

		check_permission('visualizar_preventivas', 'inicio');

		$fields = array( 'tipo' );
		$orders = array("programada" => "ASC");

		$search_string = $this->input->get('search') ? $this->input->get('search') : "";
		$dados['search_string'] = $search_string;

		// Montar paginação
		$maximo = "7";
		$inicio = $this->input->get('inicio') ? $this->input->get('inicio') : 0;

		$config['enable_query_strings'] = true;
		$config['page_query_string'] 	= true;
		$config['reuse_query_string']	= true;
		$config['per_page'] 			= $maximo;
		$config['query_string_segment'] = 'inicio';
		$config['last_link'] 			= "Última";
		$config['first_link'] 			= "Primeira";
		$config['base_url'] 			= base_url('preventivas');	 
		$config['total_rows'] 			= $this->preventiva_model->contar_registros( $search_string, $fields );

		$this->pagination->initialize( $config );

		$dados["paginacao"] = $this->pagination->create_links();

		$preventivas = $this->preventiva_model->listar( $maximo, $inicio, $search_string, $fields, $orders );

		$dados['preventivas'] = $preventivas;

		$this->template->load('template.php', 'preventivas/index-view.php', $dados);

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

		check_permission('cadastrar_preventivas', 'preventivas');

		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('site', 'Site', 'required');
		
		// Verificar validações.
		if( ! $this->form_validation->run() ) {

			// Se ocorreu o submit exibir os erros
			if( ! empty( $this->form_validation->error_array() ) ):
				foreach( $this->form_validation->error_array() as $errors ):
					$this->flashmessages->error( $errors );
				endforeach;
			endif;


			$data['sites'] = $this->site_model->listar_dropdown();

			// echo "<pre>";

			// var_dump($data['sites']);


			// die();

			$this->template->load('template.php', 'preventivas/cadastrar-view.php', $data);

		} else {

			// Criamos objeto para cadastro
			$preventiva = new Preventiva_Class();

			$preventiva->setTipo(				$this->input->post('tipo') );
			$preventiva->setDataCadastro(		date('Y-m-d') );
			$preventiva->setMicroAreas(			$this->input->post('micro_areas') );
			$preventiva->setArea(				$this->input->post('area') );
			$preventiva->setProgramada(			$this->input->post('programada') );
			$preventiva->setStatus(				1 ); // Pendente
			$preventiva->setIDSite(				$this->input->post('site') );
			$preventiva->setIDTecnico(			$this->input->post('tecnico') );
			$preventiva->setIDSupervisor(		$this->input->post('supervisor') );
			$preventiva->setIDUsuario(			$this->session->id_usuario );


			$this->preventiva_model->inserir( $preventiva );

			// Excluimos o objeto após sua utilização.
			unset( $preventiva );

			$this->flashmessages->success('Preventiva cadastrada com sucesso!');
			redirect("preventivas");
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

}//Fim da classe Servicos