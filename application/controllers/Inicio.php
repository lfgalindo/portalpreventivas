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
		$this->load->model('preventiva_model');
		$this->preventiva_model->setTable('preventivas');

		$this->template->set('title', 'Início');

	}

	public function index() {


		$supervisores = $this->preventiva_model->listar_supervisores_graficos("1","2");

		
		echo "<pre>";

		var_dump($supervisores);die();

		
		$this->template->load('template.php', 'index-view.php');


	}

}
