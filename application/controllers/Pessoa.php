<?php

/**
 * Controller para pessoas.
 * @category Controller
 * @author Luiz Felipe Magalhães Galindo <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa extends CI_Controller {

	/**
	 * Método construtor.
	 */
	public function __construct() {
		
		parent::__construct();	

		//Models
		//$this->load->model('servicos_model');

		//Classes
		//$this->load->library('servicos_class');
		//$this->load->library("form_validation");

		//Helpers
		//$this->load->helper('paginacao_helper');

		$this->template->set('title', 'Pessoas');

	}

	/**
	 * Página inicial.
	 */
	public function index() {

		$this->template->load('template.php', 'usuarios/index.php');


	}//Fim do método index

	//Método para inserir um novo registro no banco de dados
	public function cadastrar(){

		

	}//Fim do método cadastrar

	//Método para editar um registro do banco
	public function editar( $id ){

		

	}//Fim do método editar

	//Método para remover um registro do banco
	public function remover( $id ){

	}//Fim do método remover

}//Fim da classe Servicos