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

		$this->form_validation->set_rules('qtd_pagina', 'Quantidade por página', 'required|numeric|integer|greater_than[0]');
		$this->form_validation->set_rules('tamanho_arquivos', 'Tamanho máximo para envio', 'required|numeric|integer|greater_than_equal_to[0]');
		$this->form_validation->set_rules('ext_permitidas[]', 'extensões permitidas para envio', 'required');

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

			foreach( $this->input->post() as $nome => $valor ){

				$config = new Configuracao_Class();

				$config->setNome( $nome );

				$config = $this->configuracao_model->selecionar_por_campo( $config, 'nome', 'getNome' );

				if ( $config->getNome() == 'ext_permitidas' )
					$valor = serialize( $valor );

				$config->setValor( $valor );

				$this->configuracao_model->atualizar( $config );

				unset( $config );
			}

			$this->flashmessages->success('Configurações alteradas com sucesso!');
			redirect("configuracoes");
		}		

	}//Fim do método editar

}//Fim da classe Configuração
