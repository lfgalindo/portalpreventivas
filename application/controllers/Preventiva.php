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

		$this->load->model('usuario_model');
		$this->usuario_model->setTable('usuarios');

		$this->load->model('preventiva_model');
		$this->preventiva_model->setTable('preventivas');

		//Classes
		$this->load->library('site_class');
		$this->load->library('usuario_class');
		$this->load->library('preventiva_class');
		$this->load->library('form_validation');

		$this->template->set('title', 'Preventivas');

	}

	/**
	 * Página inicial.
	 */
	public function index() {

		check_permission('visualizar_preventivas', 'inicio');

		$fields = array( 'tipo', 'ne_id', 'supervisores.nome', 'tecnicos.nome' );
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

		check_permission('visualizar_preventivas', 'inicio');

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("preventivas");
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("preventivas");
		}

		$preventiva = new Preventiva_Class();
		$preventiva->setID( $id );

		$preventiva = $this->preventiva_model->selecionar( $preventiva );

		$site = new Site_Class();
		$site->setID( $preventiva->getIDSite() );
		$site = $this->site_model->selecionar( $site );

		$tecnico = new Usuario_Class();
		$tecnico->setID( $preventiva->getIDTecnico() );
		$tecnico = $this->usuario_model->selecionar( $tecnico );

		$supervisor = new Usuario_Class();
		$supervisor->setID( $preventiva->getIDSupervisor() );
		$supervisor = $this->usuario_model->selecionar( $supervisor );

		$usuario = new Usuario_Class();
		$usuario->setID( $preventiva->getIDUsuario() );
		$usuario = $this->usuario_model->selecionar( $usuario );

		$data['preventiva'] = $preventiva;
		$data['site'] 		= $site;
		$data['tecnico'] 	= $tecnico;
		$data['supervisor'] = $supervisor;
		$data['usuario'] 	= $usuario;

		$this->template->load('template.php', 'preventivas/visualizar-view.php', $data);

	}

	//Método para inserir um novo registro no banco de dados
	public function cadastrar(){

		check_permission('cadastrar_preventivas', 'preventivas');

		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('site', 'Site', 'required|greater_than[0]|integer');

		// Verificar validações.
		if( ! $this->form_validation->run() ) {

			// Se ocorreu o submit exibir os erros
			if( ! empty( $this->form_validation->error_array() ) ):
				foreach( $this->form_validation->error_array() as $errors ):
					$this->flashmessages->error( $errors );
				endforeach;
			endif;

			$data['usuarios'] = $this->usuario_model->listar_dropdown();

			$this->template->load('template.php', 'preventivas/cadastrar-view.php', $data);

		} else {

			// Criamos objeto para cadastro
			$preventiva = new Preventiva_Class();

			$preventiva->setTipo(				$this->input->post('tipo') );
			$preventiva->setDataCadastro(		date('Y-m-d H:i:s') );
			$preventiva->setProgramada(			$this->input->post('programada') . "-01" );
			$preventiva->setStatus(				1 ); // Pendente
			$preventiva->setIDSite(				$this->input->post('site') );
			$preventiva->setIDTecnico(			$this->input->post('tecnico') == 0 ? null : $this->input->post('tecnico'));
			$preventiva->setIDSupervisor(		$this->input->post('supervisor') == 0 ? null : $this->input->post('supervisor') );
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

		check_permission('editar_preventivas', 'preventivas');

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("preventivas");
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("preventivas");
		}

		$preventiva = new Preventiva_Class();
		$preventiva->setID( $id );
		$preventiva = $this->preventiva_model->selecionar( $preventiva );		

		$site = new Site_Class();
		$site->setID( $preventiva->getIDSite() );
		$site = $this->site_model->selecionar( $site );

		$data['selected_site'] = array( $site->getID() => $site->getNeID() );

		$data['preventiva'] = $preventiva;

		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('site', 'Site', 'required|greater_than[0]|integer');

		// Verificar validações.
		if( ! $this->form_validation->run() ) {

			// Se ocorreu o submit exibir os erros
			if( ! empty( $this->form_validation->error_array() ) ):
				foreach( $this->form_validation->error_array() as $errors ):
					$this->flashmessages->error( $errors );
				endforeach;
			endif;


			$data['site'] = $site;
			$data['usuarios'] = $this->usuario_model->listar_dropdown();

			$this->template->load('template.php', 'preventivas/editar-view.php', $data);

		} else {

			// Alteramos o objeto para cadastro no banco
			$preventiva->setTipo(				$this->input->post('tipo') );
			$preventiva->setProgramada(			$this->input->post('programada') . "-01" );
			$preventiva->setStatus(				1 ); // Pendente
			$preventiva->setIDSite(				$this->input->post('site') );
			$preventiva->setIDTecnico(			$this->input->post('tecnico') == 0 ? null : $this->input->post('tecnico'));
			$preventiva->setIDSupervisor(		$this->input->post('supervisor') == 0 ? null : $this->input->post('supervisor') );

			$this->preventiva_model->atualizar( $preventiva );

			// Excluimos o objeto após sua utilização.
			unset( $preventiva );

			$this->flashmessages->success('Preventiva alterada com sucesso!');
			redirect("preventivas");
		}		

	}//Fim do método editar

	//Método para executar ou cancelar a execução de uma preventiva
	public function executar( $id ){

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("preventivas");
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("preventivas");
		}
		
		$preventiva = new Preventiva_Class();
		$preventiva->setID( $id );
		$preventiva = $this->preventiva_model->selecionar( $preventiva );		

		// Verificar se a preventiva será executada ou cancelada a execução
		if ( $preventiva->getStatus() == "1" ){

			//Marcar como executada
			check_permission('executar_preventivas', 'preventivas');

			$this->form_validation->set_rules('data_execucao', 'Data de execução', 'required');

			// Verificar validações.
			if( ! $this->form_validation->run() ) {

				// Se ocorreu o submit exibir os erros
				if( ! empty( $this->form_validation->error_array() ) ):
					foreach( $this->form_validation->error_array() as $errors ):
						$this->flashmessages->error( $errors );
					endforeach;
				endif;

				redirect("preventivas");

			} 
			else {

				$preventiva->setStatus(		2 );
				$preventiva->setExecutada(	$this->input->post('data_execucao') );

			}

		}
		else if ( $preventiva->getStatus() == "2" ){

			//Cancelar execução
			check_permission('cancelar_exec_preventivas', 'preventivas');

			$preventiva->setStatus(		1 );
			$preventiva->setExecutada(	null );

		}
		else{
			
			$this->flashmessages->success('Essa preventiva não pode ter sua execução alterada!');
			redirect("preventivas");

		}

		$this->preventiva_model->atualizar( $preventiva );

		// Excluimos o objeto após sua utilização.
		unset( $preventiva );

		$this->flashmessages->success('Preventiva atualizada com sucesso!');
		redirect("preventivas");
	
	}//Fim do método executar

	//Método para remover um registro do banco
	public function remover( $id ){
		
		check_permission('remover_preventivas', 'preventivas');

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("preventivas");
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("preventivas");
		}

		$preventiva = new Preventiva_Class();
		$preventiva->setID( $id );

		$preventiva = $this->preventiva_model->selecionar( $preventiva );

		$this->preventiva_model->remover( $preventiva );

		// Excluimos o objeto após sua utilização.
		unset( $preventiva );

		$this->flashmessages->success('Preventiva removida com sucesso!');
		redirect("preventivas");


	}//Fim do método remover

}//Fim da classe Servicos