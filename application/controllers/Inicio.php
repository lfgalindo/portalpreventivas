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


		$search_mes = $this->input->get('search_mes') ? $this->input->get('search_mes')	: date('Y-m');

		$dados['search_mes'] 		= $search_mes;

		$mes_ano = explode( "-", $search_mes );
		$mes 	 = $mes_ano[1];
		$ano 	 = $mes_ano[0];

		$data_inicio	= date('Y-m-d', strtotime( $ano . "-" . $mes . "-" . "01" ) );
		$data_fim 		= date('Y-m-t', strtotime( $ano . "-" . $mes . "-" . "01" ) );

		$supervisores = $this->preventiva_model->listar_supervisores_graficos( $data_inicio, $data_fim );

		$data['supervisores'] = $supervisores;

		$situacao = array();

		echo "<pre>";

		// Buscar quantidade de preventivas de cada situação
		foreach ( $supervisores as $supervisor ) {
			
			$qtd = $this->preventiva_model->qtd_preventivas_por_supervisor( $supervisor['id_supervisor'], $data_inicio, $data_fim );

			var_dump($qtd);

		}

		var_dump($supervisores); die();

		$this->template->load('template.php', 'index-view.php', $data);


	}

}
