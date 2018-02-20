<?php

/**
 * Controller para arquivos.
 * @category Controller
 * @author Luiz Felipe Magalhães Galindo <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Arquivo extends CI_Controller {

	/**
	 * Método construtor.
	 */
	public function __construct() {
		
		parent::__construct();

		//Models
		$this->load->model('configuracao_model');
		$this->configuracao_model->setTable('configuracoes');

		$this->load->model('arquivo_model');
		$this->arquivo_model->setTable('arquivos');

		$this->load->model('preventiva_model');
		$this->preventiva_model->setTable('preventivas');

		//Classes
		$this->load->library('arquivo_class');
		$this->load->library('preventiva_class');
		$this->load->library('form_validation');

		$this->template->set('title', 'Arquivos');

	}

	/**
	 * Página inicial.
	 */
	public function listar( $tabela, $id_reg_tabela_encrypt ) {

		if ( is_numeric( $id_reg_tabela_encrypt ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("preventivas");
		}

		$id_reg_tabela = decrypt( $id_reg_tabela_encrypt );

		if ( ! is_numeric( $id_reg_tabela ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("preventivas");
		}

		if ( $tabela == "preventivas" )
			check_permission('visualizar_relatorios_preventivas', 'preventivas');

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
		$config['base_url'] 			= base_url('arquivos/' . $tabela . '/' . $id_reg_tabela_encrypt );	 
		$config['total_rows'] 			= $this->arquivo_model->contar_registros_arquivos( $tabela, $id_reg_tabela );

		$this->pagination->initialize( $config );

		$dados["paginacao"] = $this->pagination->create_links();

		$arquivos = $this->arquivo_model->listar_arquivos( $maximo, $inicio, $tabela, $id_reg_tabela );

		$dados['arquivos'] = $arquivos;
		$dados['id_reg_tabela_encrypt'] = $id_reg_tabela_encrypt;

		$preventiva = new Preventiva_Class();
		$preventiva->setID( $id_reg_tabela );
		$preventiva = $this->preventiva_model->selecionar( $preventiva );
		
		$dados['preventiva'] = $preventiva;

		$this->template->load('template.php', 'preventivas/listar-arquivos-view.php', $dados);

	}//Fim do método index	

	//Método para visualizar todos os dados de um relatorio
	public function visualizar( $id_preventiva, $id ){

		check_permission('visualizar_relatorios_preventivas', 'arquivos/preventivas/' . $id_preventiva);

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect('arquivos/preventivas/' . $id_preventiva);
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect('arquivos/preventivas/' . $id_preventiva);
		}

		$arquivo = new Arquivo_Class();
		$arquivo->setID( $id );

		$arquivo = $this->arquivo_model->selecionar( $arquivo );

		$data['arquivo'] = $arquivo;

		$usuario_enviou = new Usuario_Class();
		$usuario_enviou->setID( $arquivo->getIDUsuario() );
		$usuario_enviou = $this->usuario_model->selecionar( $usuario_enviou );

		$data['usuario_enviou'] = $usuario_enviou;

		$usuario_aprovou = new Usuario_Class();
		$usuario_aprovou->setID( $arquivo->getIDUsuarioRecusadoAprovado() );
		$usuario_aprovou = $this->usuario_model->selecionar( $usuario_aprovou );

		$data['usuario_aprovou'] = $usuario_aprovou;

		$data['id_preventiva'] = $id_preventiva;

		$this->template->load('template.php', 'preventivas/visualizar-arquivos-view.php', $data);

	}

	//Método para enviar um arquivo ao servidor e inserir um novo registro no banco de dados
	public function enviar( $tabela, $id_encrypt ) {

		check_permission('enviar_relatorios_preventivas', '/arquivos/preventivas/' . $id_encrypt);

		if( is_null( $id_encrypt ) || is_numeric( $id_encrypt ) ){

			$this->flashmessages->success('Ocorreu um erro!');
			redirect('arquivos/preventivas/' . $id_encrypt);

		}

		$id = decrypt( $id_encrypt );

		if( ! is_numeric( $id ) ){

			$this->flashmessages->success('Ocorreu um erro!');
			redirect('arquivos/preventivas/' . $id_encrypt);

		}

		$config['upload_path']          = './uploads/';	
		$config['allowed_types']        = 'bmp|jpeg|jpg|png|gif|pdf|doc|docx|rtf|txt|xls|xlsx|ppt|pptx|zip|rar';
		$config['max_size']             = 10000000000; 
		$config['encrypt_name'] 		= TRUE;

		$this->load->library('upload', $config );

		if ( ! $this->upload->do_upload('arquivo') ) {

				$error = array('error' => $this->upload->display_errors() );

				foreach( $error as $e ):
					$this->flashmessages->error( $e );
				endforeach;

		} else {

			$dados_upload = array('upload_data' => $this->upload->data() );

			$arquivo = new Arquivo_Class();

			$arquivo->setNome( 			$dados_upload['upload_data']['orig_name'] );
			$arquivo->setTamanho( 		$dados_upload['upload_data']['file_size'] );
			$arquivo->setFormato( 		$dados_upload['upload_data']['file_ext'] );
			$arquivo->setRaw( 			$dados_upload['upload_data']['raw_name'] );
			$arquivo->setDataEnvio( 	date('Y-m-d H:i:s') );
			$arquivo->setAprovado( 		0 );
			$arquivo->setRecusado( 		0 );
			$arquivo->setTabela( 		$tabela );
			$arquivo->setIDRegTabela( 	$id );
			$arquivo->setIDUsuario( 	$this->session->id_usuario );

			$this->arquivo_model->inserir( $arquivo );

			$preventiva = new Preventiva_Class();
			$preventiva->setID( $id );
			$preventiva = $this->preventiva_model->selecionar( $preventiva );

			$preventiva->setStatus( 3 );
			$preventiva->setRelatorio( date("Y-m-d", strtotime( $arquivo->getDataEnvio() ) ) );

			$this->preventiva_model->atualizar( $preventiva );

			$this->flashmessages->success( "Envio realizado com sucesso!" );

		}

		redirect('arquivos/preventivas/' . $id_encrypt);

	}

	//Método para aprovar um relatório enviado
	public function aprovar( $id_preventiva, $id ){

		check_permission('aprovar_relatorios_preventivas', 'arquivos/preventivas/' . $id_preventiva);


		if ( is_numeric( $id_preventiva ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect('arquivos/preventivas/');
		}

		$id_preventiva = decrypt( $id_preventiva );

		if ( ! is_numeric( $id_preventiva ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect('arquivos/preventivas/');
		}

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect('arquivos/preventivas/' . $id_preventiva);
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect('arquivos/preventivas/' . $id_preventiva);
		}

		$arquivo = new Arquivo_Class();
		$arquivo->setID( $id );

		$arquivo = $this->arquivo_model->selecionar( $arquivo );

		$arquivo->setAprovado( 1 );
		$arquivo->setDataRecusadoAprovado( date("Y-m-d H:i:s") );
		$arquivo->setIDUsuarioRecusadoAprovado( $this->session->id_usuario );

		$this->arquivo_model->atualizar( $arquivo );

		$preventiva = new Preventiva_Class();
		$preventiva->setID( $id_preventiva );
		$preventiva = $this->preventiva_model->selecionar( $preventiva );

		$preventiva->setStatus( 5 );

		$this->preventiva_model->atualizar( $preventiva );

		// Excluimos o objeto após sua utilização.
		unset( $preventiva );
		unset( $arquivo );

		$this->flashmessages->success('Relatório aprovado com sucesso!');
		redirect('arquivos/preventivas/' . encrypt($id_preventiva) );	

	}//Fim do método aprovar

	//Método para recusar um relatório enviado
	public function recusar( $id_preventiva, $id ){

		check_permission('recusar_relatorios_preventivas', 'arquivos/preventivas/' . $id_preventiva);


		if ( is_numeric( $id_preventiva ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect('arquivos/preventivas/');
		}

		$id_preventiva = decrypt( $id_preventiva );

		if ( ! is_numeric( $id_preventiva ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect('arquivos/preventivas/');
		}

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect('arquivos/preventivas/' . $id_preventiva);
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect('arquivos/preventivas/' . $id_preventiva);
		}

		$arquivo = new Arquivo_Class();
		$arquivo->setID( $id );

		if ( ! $this->input->post('motivo') ){
			$this->flashmessages->success('Por favor, informe o motivo da recusa!');
			redirect('arquivos/preventivas/' . encrypt($id_preventiva) );
		}

		$arquivo = $this->arquivo_model->selecionar( $arquivo );

		$arquivo->setRecusado( 1 );
		$arquivo->setMotivoRecusado( $this->input->post('motivo') );
		$arquivo->setDataRecusadoAprovado( date("Y-m-d H:i:s") );
		$arquivo->setIDUsuarioRecusadoAprovado( $this->session->id_usuario );

		$this->arquivo_model->atualizar( $arquivo );

		$preventiva = new Preventiva_Class();
		$preventiva->setID( $id_preventiva );
		$preventiva = $this->preventiva_model->selecionar( $preventiva );

		$preventiva->setStatus( 4 );

		$this->preventiva_model->atualizar( $preventiva );

		// Excluimos o objeto após sua utilização.
		unset( $preventiva );
		unset( $arquivo );

		$this->flashmessages->success('Relatório recusado com sucesso!');
		redirect('arquivos/preventivas/' . encrypt($id_preventiva) );	

	}//Fim do método recusar

	//Método para remover um upload feito e seu registro no banco
	public function remover( $id_preventiva, $id_arquivo ){
		
		check_permission('remover_relatorios_preventivas', '/arquivos/preventivas/' . $id_preventiva);

		if ( is_numeric( $id_arquivo ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect('/arquivos/preventivas/' . $id_preventiva);
		}

		$id = decrypt( $id_arquivo );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect('/arquivos/preventivas/' . $id_preventiva);
		}

		$arquivo = new Arquivo_Class();
		$arquivo->setID( $id );

		$arquivo = $this->arquivo_model->selecionar( $arquivo );

		$file = './uploads/' . $arquivo->getRaw() . $arquivo->getFormato();

        unlink($file);

		$this->arquivo_model->remover( $arquivo );

		// Excluimos o objeto após sua utilização.
		unset( $arquivo );

		$this->flashmessages->success('Arquivo removido com sucesso!');
		redirect('/arquivos/preventivas/' . $id_preventiva);


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

}//Fim da classe Servicos