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

			$supervisores[ $key ][ 'programadas' ] = 0;

			foreach ( $all_qtd as $qtd) {
				
				$supervisores[ $key ][ $qtd['status'] ] = $qtd['qtd'];
				$supervisores[ $key ][ 'programadas' ] = $supervisores[ $key ][ 'programadas' ] + $qtd['qtd'];

			}

			foreach ( $situacoes_preventivas as $cod => $situacao ) {
				
				if ( ! isset( $supervisores[ $key ][ $cod ] ) )
					$supervisores[ $key ][ $cod ] = 0;

			}


		}
		
		// Montar array para indentificar ao HighCharts os supervisores que aparecerão
		$nomes_supervisores = array();

		foreach ( $supervisores as $key => $supervisor )
			array_push( $nomes_supervisores, $supervisor['supervisor']);


		// Montar array para os dados serem exibidos
		$qtd_por_situacao = array();
		$qtd_geral = array();
		
		// Preventivas programadas
		$array = array();
		$array['name'] = 'Programadas';
		$array['data'] = array();

		$geral = array();
		$geral['name'] = 'Programadas';
		$geral['data'] = array();
		$soma_geral = 0;

		foreach ( $supervisores as $key => $supervisor ){
			array_push( $array['data'] , (int) $supervisor['programadas']);
			$soma_geral = $soma_geral + $supervisor['programadas'];
		}
		
		array_push( $geral['data'] , (int) $soma_geral);
		array_push( $qtd_geral, $geral);
		array_push( $qtd_por_situacao, $array);

		//Preventivas executadas
		$array = array();
		$array['name'] = 'Executadas';
		$array['data'] = array();

		$geral = array();
		$geral['name'] = 'Executadas';
		$geral['data'] = array();
		$soma_geral = 0;

		foreach ( $supervisores as $key => $supervisor ){
			array_push( $array['data'] , (int) $supervisor[2] + $supervisor[3] + $supervisor[4]);
			$soma_geral = $soma_geral + $supervisor[2] + $supervisor[3] + $supervisor[4];
		}

		array_push( $geral['data'] , (int) $soma_geral);
		array_push( $qtd_geral, $geral);
		array_push( $qtd_por_situacao, $array);

		//Preventivas com relatórios Entregues
		$array = array();
		$array['name'] = 'Relatórios Entregues (Aprovados)';
		$array['data'] = array();

		$geral = array();
		$geral['name'] = 'Relatórios Entregues (Aprovados)';
		$geral['data'] = array();
		$soma_geral = 0;

		foreach ( $supervisores as $key => $supervisor ){
			array_push( $array['data'] , (int) $supervisor[5]);
			$soma_geral = $soma_geral + $supervisor[5];
		}

		array_push( $geral['data'] , (int) $soma_geral);
		array_push( $qtd_geral, $geral);
		array_push( $qtd_por_situacao, $array);

		$dados['nomes_supervisores'] = $nomes_supervisores;
		$dados['qtd_por_situacao'] = $qtd_por_situacao;
		$dados['qtd_geral'] = $qtd_geral;

		$this->template->load('template.php', 'index-view.php', $dados);

	}

}
