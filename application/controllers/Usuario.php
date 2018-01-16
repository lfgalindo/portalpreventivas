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

		$usuarios = $this->usuario_model->listar('usuarios');

		$dados['usuarios'] = $usuarios;

		$this->template->load('template.php', 'usuarios/index-view.php', $dados);

	}//Fim do método index

	//Método para inserir um novo registro no banco de dados
	public function cadastrar(){

		$this->form_validation->set_rules('nome', 'Nome do usúario', 'required');
		$this->form_validation->set_rules('cpf',  'CPF do usúario',  'required');
		
		if( strlen( $this->input->post('senha') ) > 0 || strlen( $this->input->post('confirmar_senha') ) > 0 ) {
			$this->form_validation->set_rules('senha', 'Senha', 'required|matches[confirmar_senha]|min_length[8]');
			$this->form_validation->set_rules('confirmar_senha', 'Confirmar Senha', 'required');
		}

		$valida_cpf = validaCPF( $this->input->post('cpf') );

		// Verificar se CPF já foi cadastrado
		$existe_cpf = false;

		if ( $this->input->post('cpf') )
			$existe_cpf = $this->usuario_model->existe_cadastro('usuarios', 'cpf', apenas_numeros( $this->input->post('cpf') ) );

		// Verificar se Login ja foi cadastrado
		$existe_login = false;

		if ( $this->input->post('login') )
			$existe_login = $this->usuario_model->existe_cadastro('usuarios', 'login', $this->input->post('login') );


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

			$this->template->load('template.php', 'usuarios/cadastrar-view.php');

		} else {

			// Criamos objeto para cadastro
			$usuario = new Usuario_Class();

			$usuario->setNome( 			$this->input->post('nome'));
			$usuario->setCPF(			apenas_numeros( $this->input->post('cpf') ) );
			$usuario->setLogin(			$this->input->post('login'));
			$usuario->setSenha(			hash('sha512', $this->input->post("senha") ) );
			$usuario->setMatricula(		$this->input->post('matricula'));
			$usuario->setTelefone(		$this->input->post('telefone'));
			$usuario->setPermissoes(	apenas_numeros( $this->input->post('cpf') ) );


			$this->usuario_model->inserir( "usuarios", $usuario );

			// Excluimos o objeto após sua utilização.
			unset( $usuario );

			$this->flashmessages->success('Usuário cadastrado com sucesso!');
			redirect("usuarios");
		}

	}//Fim do método cadastrar

	//Método para editar um registro do banco
	public function editar( $id ){

		

	}//Fim do método editar

	//Método para remover um registro do banco
	public function remover( $id ){

	}//Fim do método remover

}//Fim da classe Servicos