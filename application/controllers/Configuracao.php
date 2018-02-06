<?php

/**
 * Controller para configurações do sistema.
 * @category Controller
 * @author Luiz Felipe Magalhães Galindo <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracao extends CI_Controller {

	/**
	 * Método construtor.
	 */
	public function __construct() {
		
		parent::__construct();	

		//Models
		$this->load->model('configuracao_model');
		$this->site_model->setTable('configuracoes');

		//Classes
		$this->load->library('configuracao_class');
		$this->load->library('form_validation');

		//Helpers
		//$this->load->helper('paginacao_helper');

		$this->template->set('title', 'Configurações');

	}

	/**
	 * Página inicial.
	 */
	public function index() {

		check_permission('visualizar_configuracoes', 'inicio');

		$configuracoes = $this->configuracao_model->listar();

		$dados['configuracoes'] = $configuracoes;

		$this->template->load('template.php', 'configuracoes/index-view.php', $dados);

	}//Fim do método index

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

}//Fim da classe Servicos