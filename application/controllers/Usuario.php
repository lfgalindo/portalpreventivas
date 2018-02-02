<?php

/**
 * Controller para usuarios.
 * @category Controller
 * @author Luiz Felipe Magalhães Galindo <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	/**
	 * Método construtor.
	 */
	public function __construct() {
		
		parent::__construct();	

		//Models
		$this->load->model('usuario_model');
		$this->usuario_model->setTable('usuarios');

		//Classes
		$this->load->library('usuario_class');
		$this->load->library('form_validation');

		//Helpers
		//$this->load->helper('paginacao_helper');

		$this->template->set('title', 'Usuários');

	}

	/**
	 * Página inicial.
	 */
	public function index() {

		check_permission('visualizar_usuarios', 'inicio');

		$fields = array( 'nome', 'cpf', 'login', 'matricula', 'telefone' );
		$orders = array("nome" => "ASC");

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
		$config['base_url'] 			= base_url('usuarios');	 
		$config['total_rows'] 			= $this->usuario_model->contar_registros( $search_string, $fields );

		$this->pagination->initialize( $config );

		$dados["paginacao"] = $this->pagination->create_links();

		$usuarios = $this->usuario_model->listar( $maximo, $inicio, $search_string, $fields, $orders );

		$dados['usuarios'] = $usuarios;

		$this->template->load('template.php', 'usuarios/index-view.php', $dados);

	}//Fim do método index

	//Método para visualizar todos os dados de um usuário
	public function visualizar( $id ){

		check_permission('visualizar_usuarios', 'inicio');

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("usuarios");
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("usuarios");
		}

		$usuario = new Usuario_Class();
		$usuario->setID( $id );

		$usuario = $this->usuario_model->selecionar( $usuario );

		$data['usuario'] = $usuario;

		$permissoes_usuario = array();

		if ( ! is_null(unserialize($usuario->getPermissoes())) && unserialize($usuario->getPermissoes()) != false )
			$permissoes_usuario = unserialize( $usuario->getPermissoes() );

		// Carregar variável com todas as permissões para enviar para a tela
		$data['permissoes'] = todas_permissoes();
		$data['permissoes_usuario_array'] = $permissoes_usuario;

		$this->template->load('template.php', 'usuarios/visualizar-view.php', $data);

	}

	//Método para inserir um novo registro no banco de dados
	public function cadastrar(){

		check_permission('cadastrar_usuarios', 'usuarios');

		// Carregar variável com todas as permissões para enviar para a tela
		$data['permissoes'] = todas_permissoes();

		$this->form_validation->set_rules('nome', 'Nome do usuário', 'required');
		$this->form_validation->set_rules('matricula',  'Matrícula do usuário',  'required');
		
		if( strlen( $this->input->post('senha') ) > 0 || strlen( $this->input->post('confirmar_senha') ) > 0 ) {
			$this->form_validation->set_rules('senha', 'Senha', 'required|matches[confirmar_senha]|min_length[8]');
			$this->form_validation->set_rules('confirmar_senha', 'Confirmar Senha', 'required');
		}

		// Se ser matricula ja foi cadastrada
		$existe_matricula = $this->usuario_model->existe_cadastro( 'matricula', $this->input->post('matricula') );

		// Se foi informado CPF valida-lo
		$valida_cpf = true;
		$existe_cpf = false;

		if ( strlen( $this->input->post('cpf') ) > 0 ){

			$valida_cpf = validaCPF( $this->input->post('cpf') );
			
			// Verificar se CPF já foi cadastrado
			if ( $this->input->post('cpf') )
				$existe_cpf = $this->usuario_model->existe_cadastro( 'cpf', apenas_numeros( $this->input->post('cpf') ) );

		}

		// Verificar se Login ja foi cadastrado
		$existe_login = false;

		if ( $this->input->post('login') )
			$existe_login = $this->usuario_model->existe_cadastro( 'login', $this->input->post('login') );

		//var_dump( serialize( $this->input->post("permissoes") ) ); die();

		$data['select_permissoes'] = array();

		if( $this->input->post("permissoes") )
			$data['select_permissoes'] = $this->input->post("permissoes");

		// Verificar validações.
		if( ! $this->form_validation->run() || $valida_cpf == false || $existe_cpf == true || $existe_login == true || $existe_matricula == true ) {

			// Se ocorreu o submit exibir os erros
			if( ! empty( $this->form_validation->error_array() ) ):
				foreach( $this->form_validation->error_array() as $errors ):
					$this->flashmessages->error( $errors );
				endforeach;
			endif;

			if ( $valida_cpf == false )
				$this->flashmessages->error( "O CPF informado é inválido." );

			if ( $existe_cpf == true )
				$this->flashmessages->error( "O CPF informado já existe no sistema." );

			if ( $existe_login == true )
				$this->flashmessages->error( "O login informado já existe no sistema." );

			if ( $existe_matricula == true )
				$this->flashmessages->error( "A matrícula informada já existe no sistema." );

			$this->template->load('template.php', 'usuarios/cadastrar-view.php', $data);

		} else {

			// Criamos objeto para cadastro
			$usuario = new Usuario_Class();

			$usuario->setNome( 			$this->input->post('nome'));
			$usuario->setCPF(			apenas_numeros( $this->input->post('cpf') ) );
			$usuario->setLogin(			$this->input->post('login'));
			$usuario->setSenha(			hash('sha512', $this->input->post("senha") ) );
			$usuario->setMatricula(		$this->input->post('matricula'));
			$usuario->setTelefone(		$this->input->post('telefone'));
			$usuario->setPermissoes(	serialize( $this->input->post("permissoes") ) );


			$this->usuario_model->inserir( $usuario );

			// Excluimos o objeto após sua utilização.
			unset( $usuario );

			$this->flashmessages->success('Usuário cadastrado com sucesso!');
			redirect("usuarios");
		}

	}//Fim do método cadastrar

	//Método para editar um registro do banco
	public function editar( $id ){

		check_permission('editar_usuarios', 'usuarios');

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("usuarios");
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("usuarios");
		}

		$usuario = new Usuario_Class();
		$usuario->setID( $id );

		$usuario = $this->usuario_model->selecionar( $usuario );

		$data['usuario'] = $usuario;

		// Carregar variável com todas as permissões para enviar para a tela
		$data['permissoes'] = todas_permissoes();

		$this->form_validation->set_rules('nome', 'Nome do usuário', 'required');
		$this->form_validation->set_rules('matricula',  'Matrícula do usuário',  'required');
		
		if( strlen( $this->input->post('senha') ) > 0 || strlen( $this->input->post('confirmar_senha') ) > 0 ) {
			$this->form_validation->set_rules('senha', 'Senha', 'required|matches[confirmar_senha]|min_length[8]');
			$this->form_validation->set_rules('confirmar_senha', 'Confirmar Senha', 'required');
		}

		// Se ser matricula ja foi cadastrada
		$existe_matricula = $this->usuario_model->existe_cadastro( 'matricula', $this->input->post('matricula'), $usuario->getID() );

		// Se foi informado CPF valida-lo
		$valida_cpf = true;
		$existe_cpf = false;

		if ( strlen( $this->input->post('cpf') ) > 0 ){

			$valida_cpf = validaCPF( $this->input->post('cpf') );
			
			// Verificar se CPF já foi cadastrado
			if ( $this->input->post('cpf') )
				$existe_cpf = $this->usuario_model->existe_cadastro( 'cpf', apenas_numeros( $this->input->post('cpf') ), $usuario->getID() );

		}

		// Verificar se Login ja foi cadastrado
		$existe_login = false;

		if ( $this->input->post('login') )
			$existe_login = $this->usuario_model->existe_cadastro('login', $this->input->post('login'), $usuario->getID());

		//var_dump( serialize( $this->input->post("permissoes") ) ); die();

		$data['select_permissoes'] = array();

		if( $this->input->post("permissoes") ) {

			$data['select_permissoes'] = $this->input->post("permissoes");

		}
		else{

			if ( $usuario->getPermissoes() == null )
				$usuario->setPermissoes("");

			$data['select_permissoes'] = unserialize( $usuario->getPermissoes() ) == false ? array() : unserialize( $usuario->getPermissoes() );

		}

		// Verificar validações.
		if( ! $this->form_validation->run() || $valida_cpf == false || $existe_cpf == true || $existe_login == true ) {

			// Se ocorreu o submit exibir os erros
			if( ! empty( $this->form_validation->error_array() ) ):
				foreach( $this->form_validation->error_array() as $errors ):
					$this->flashmessages->error( $errors );
				endforeach;
			endif;

			if ( $valida_cpf == false )
				$this->flashmessages->error( "O CPF informado é inválido." );

			if ( $existe_cpf == true )
				$this->flashmessages->error( "O CPF informado já existe no sistema." );

			if ( $existe_login == true )
				$this->flashmessages->error( "O login informado já existe no sistema." );

			$this->template->load('template.php', 'usuarios/editar-view.php', $data);

		} else {

			// Alteramos o objeto para cadastro no banco

			$usuario->setNome( 			$this->input->post('nome'));
			$usuario->setCPF(			apenas_numeros( $this->input->post('cpf') ) );
			$usuario->setLogin(			$this->input->post('login'));
			$usuario->setMatricula(		$this->input->post('matricula'));
			$usuario->setTelefone(		$this->input->post('telefone'));
			$usuario->setPermissoes(	serialize( $this->input->post("permissoes") ) );

			if( strlen( $this->input->post('senha') ) > 0 )
				$usuario->setSenha(			hash('sha512', $this->input->post("senha") ) );

			$this->usuario_model->atualizar( $usuario );

			// Excluimos o objeto após sua utilização.
			unset( $usuario );

			$this->flashmessages->success('Usuário alterado com sucesso!');
			redirect("usuarios");
		}		

	}//Fim do método editar

	//Método para remover um registro do banco
	public function remover( $id ){
		
		check_permission('remover_usuarios', 'usuarios');

		if ( is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("usuarios");
		}

		$id = decrypt( $id );

		if ( ! is_numeric( $id ) ){
			$this->flashmessages->success('Ocorreu um erro!');
			redirect("usuarios");
		}

		$usuario = new Usuario_Class();
		$usuario->setID( $id );

		$usuario = $this->usuario_model->selecionar( $usuario );

		$usuario->setRemovido('1');

		$this->usuario_model->atualizar( $usuario );

		// Excluimos o objeto após sua utilização.
		unset( $usuario );

		$this->flashmessages->success('Usuário removido com sucesso!');
		redirect("usuarios");


	}//Fim do método remover

}//Fim da classe Servicos