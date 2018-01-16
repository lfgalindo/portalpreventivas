<?php

/**
 * Classe responsável pela autentiação de um usuario.
 *
 * @category Usuario
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Libraries
		$this->load->library("form_validation");
		$this->load->library('usuario_class');

		$this->load->model("usuario_model");
	}

	/**
	 * Página de com o formulário de login.
	 */
	public function index() {

		// Verificamos se já não existe uma sessão aberta.
		if( $this->verificar_sessao() === true ) {
			redirect('inicio');
		}

		// Carregamos a view login com o formulário.
		$this->load->view('login-view');
	}

	/**
	 * Método para validar as informações de login.
	 */
	public function auth() {

		$this->form_validation->set_rules('login', 'Login', 'required|trim');
		$this->form_validation->set_rules('senha', 'Senha', 'required|trim');

		if( $this->form_validation->run() ) {

			$usuario = new Usuario_Class();

			$usuario->setLogin( $this->input->post("login") );
			//$usuario->setSenha( $this->input->post("senha") );
			$usuario->setSenha( hash('sha512', $this->input->post("senha") ) );

			$id_usuario = $this->usuario_model->verificar_login( "usuarios", $usuario );

			if( $id_usuario != false ) {

				$usuario->setID( $id_usuario );
				$usuario = $this->usuario_model->selecionar('usuarios', $usuario);

				var_dump($usuario); die();

				// Armazenamos os dados do usuário.
				$data = array(
						'auth'	 		=> true,
						'id_usuario'	=> $id_usuario
					);

				// Criamos a sessão.
				$this->session->set_userdata( $data );

				
				$this->flashmessages->success( get_messages('sucesso_login') );
				redirect('inicio');

			} else {

				$this->flashmessages->error( get_messages('erro_login') );
				redirect('login');
			}

		} else {

			$this->flashmessages->error( get_messages('erro_login') );		
			redirect('login');

		}
	}

	/**
	 * Método para deslogar o usuário.
	 */
	public function logout() {

		$userdata = $this->session->all_userdata();

		// Excluímos todas as sessões.
		foreach( $userdata as $key=>$value ) {
			if ( $key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity' ) {
		    	$this->session->unset_userdata( $key );
			}
		}

		$this->session->sess_destroy();
		redirect('login');
	}

	/**
	 * Método para verificar se uma sessão está aberta.
	 */
	public function verificar_sessao() {

		if( isset( $this->session->auth )
			&& is_numeric( $this->session->id_pessoa )
			&& $this->session->auth === true ) {

			return true;
		}

		return false;
	}


}
