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
		$this->configuracao_model->setTable('configuracoes');

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

		$config = new Configuracao_Class();

		$configuracoes = $this->configuracao_model->listar( 100, 0, "", null, null, $config);

		$dados['configuracoes'] = $configuracoes;

		$this->template->load('template.php', 'configuracoes/index-view.php', $dados);

	}//Fim do método index

	//Método para editar as configuracoes do sistema
	public function editar(){

		check_permission('alterar_configuracoes', 'configuracoes');

		$config = new Configuracao_Class();

		$configuracoes = $this->configuracao_model->listar( 100, 0, "", null, null, $config);

		$dados['configuracoes'] = $configuracoes;

		// Verificar validações.
		if( ! $this->form_validation->run() ) {

			// Se ocorreu o submit exibir os erros
			if( ! empty( $this->form_validation->error_array() ) ):
				foreach( $this->form_validation->error_array() as $errors ):
					$this->flashmessages->error( $errors );
				endforeach;
			endif;

			$this->template->load('template.php', 'configuracoes/editar-view.php', $dados);

		} else {
			
			$this->flashmessages->success('Configurações alteradas com sucesso!');
			redirect("configuracoes");
		}		

	}//Fim do método editar

}//Fim da classe Configuração