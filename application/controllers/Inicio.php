<?php

/**
 * Classe responsável pela pagina inicial do sistema.
 *
 * @category Inicio
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Verifica se o usuário está logado.
		if( ! $this->session->auth ) {
			redirect("login");
		}

		// Algumas models que iremos utilizar.
		$this->load->model('usuario_model');

		$this->template->set('title', 'Início');

	}

	public function index() {

		
		$this->template->load('template.php', 'index-view.php');


	}

}
