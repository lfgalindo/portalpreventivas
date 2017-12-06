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
		//$this->load->library("form_validation");

		//Helpers
		//$this->load->helper('paginacao_helper');

		$this->template->set('title', 'Usuários');

	}

	/**
	 * Página inicial.
	 */
	public function index() {

		$this->template->load('template.php', 'usuarios/index.php');


	}//Fim do método index

	//Método para inserir um novo registro no banco de dados
	public function cadastrar(){

		$usuario = new Usuario_Class();
		$usuario_model = new Usuario_Model();

		$usuario->setNome("Luiz");
		$usuario->setCPF(43191899812);
		$usuario->setLogin("lfelipe");
		$usuario->setSenha("senha");
		$usuario->setMatricula("123");
		$usuario->setTelefone('33421925');
		$usuario->setRemovido( 0 );

		$usuario_model->inserir( "usuarios", $usuario );
		

	}//Fim do método cadastrar

	//Método para editar um registro do banco
	public function editar( $id ){

		

	}//Fim do método editar

	//Método para remover um registro do banco
	public function remover( $id ){

	}//Fim do método remover

}//Fim da classe Servicos