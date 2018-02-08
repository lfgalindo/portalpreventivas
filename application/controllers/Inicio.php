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

		$situacao = array();

		$situacoes_preventivas = situacoes_preventivas();

		// Buscar quantidade de preventivas de cada situação
		foreach ( $supervisores as $key => $supervisor ) {
			
			$all_qtd = $this->preventiva_model->qtd_preventivas_por_supervisor( $supervisor['id_supervisor'], $data_inicio, $data_fim );

			foreach ( $all_qtd as $qtd) {
				
				 $supervisores[ $key ][ $qtd['status'] ] = $qtd['qtd'];

			}

			foreach ( $situacoes_preventivas as $cod => $situacao ) {
				
				if ( ! isset( $supervisores[ $key ][ $cod ] ) )
					$supervisores[ $key ][ $cod ] = 0;

			}


		}

		$qtd_por_situacao = array();
		$nomes_supervisores = array();

		foreach ( $situacoes_preventivas as $cod => $situacao ) {

			$array = array();

			$array['name'] = $situacao;
			$array['data'] = array();

				
			foreach ( $supervisores as $key => $supervisor ){

				array_push( $nomes_supervisores, $supervisor['supervisor']);
				array_push( $array['data'] , (int) $supervisor[$cod]);

			}

			array_push( $qtd_por_situacao, $array );

		}

		$dados['nomes_supervisores'] = $nomes_supervisores;
		$dados['qtd_por_situacao'] = $qtd_por_situacao;

		$this->template->load('template.php', 'index-view.php', $dados);


	}

}
