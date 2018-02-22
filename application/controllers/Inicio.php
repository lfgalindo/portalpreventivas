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
		$search_supervisor = $this->input->get('search_supervisor') ? $this->input->get('search_supervisor') : '0';

		$dados['search_mes'] = $search_mes;
		$dados['search_supervisor'] = $search_supervisor;

		$mes_ano = explode( "-", $search_mes );
		$mes 	 = $mes_ano[1];
		$ano 	 = $mes_ano[0];

		$data_inicio	= date('Y-m-d', strtotime( $ano . "-" . $mes . "-" . "01" ) );
		$data_fim 		= date('Y-m-t', strtotime( $ano . "-" . $mes . "-" . "01" ) );

		$supervisores = $this->preventiva_model->listar_supervisores_graficos( $data_inicio, $data_fim );

		$select_supervisores['0'] = 'Todos os supervisores';

		foreach ( $supervisores as $supervisor)
			$select_supervisores[ $supervisor['id_supervisor'] ] = $supervisor['supervisor'];

		$dados['select_supervisores'] = $select_supervisores;

		$situacoes_preventivas = situacoes_preventivas();

		if ( $search_supervisor == "0"){

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

			/**
			 *
			 * Gráficos de preventivas por tipos
			 *
			 */

			foreach ( tipos_preventivas() as $tipo => $nome ){

				$supervisores_tipo[$tipo] = $this->preventiva_model->listar_supervisores_graficos( $data_inicio, $data_fim, $tipo );

				// Buscar quantidade de preventivas de cada situação
				foreach ( $supervisores_tipo[$tipo] as $key => $supervisor ) {
					
					$all_qtd = $this->preventiva_model->qtd_preventivas_por_supervisor( $supervisor['id_supervisor'], $data_inicio, $data_fim, $tipo );

					$supervisores_tipo[$tipo][ $key ][ 'programadas' ] = 0;

					foreach ( $all_qtd as $qtd) {
						
						$supervisores_tipo[$tipo][ $key ][ $qtd['status'] ] = $qtd['qtd'];
						$supervisores_tipo[$tipo][ $key ][ 'programadas' ] = $supervisores_tipo[$tipo][ $key ][ 'programadas' ] + $qtd['qtd'];

					}

					foreach ( $situacoes_preventivas as $cod => $situacao ) {
						
						if ( ! isset( $supervisores_tipo[$tipo][ $key ][ $cod ] ) )
							$supervisores_tipo[$tipo][ $key ][ $cod ] = 0;

					}


				}
				
				// Montar array para indentificar ao HighCharts os supervisores que aparecerão
				$nomes_supervisores_tipo[$tipo] = array();

				foreach ( $supervisores_tipo[$tipo] as $key => $supervisor )
					array_push( $nomes_supervisores_tipo[$tipo], $supervisor['supervisor']);


				// Montar array para os dados serem exibidos
				$qtd_por_situacao_tipo[$tipo] = array();
				
				// Preventivas programadas
				$array = array();
				$array['name'] = 'Programadas';
				$array['data'] = array();

				foreach ( $supervisores_tipo[$tipo] as $key => $supervisor )
					array_push( $array['data'] , (int) $supervisor['programadas']);

				array_push( $qtd_por_situacao_tipo[$tipo], $array);

				//Preventivas executadas
				$array = array();
				$array['name'] = 'Executadas';
				$array['data'] = array();

				foreach ( $supervisores_tipo[$tipo] as $key => $supervisor )
					array_push( $array['data'] , (int) $supervisor[2] + $supervisor[3] + $supervisor[4]);

				array_push( $qtd_por_situacao_tipo[$tipo], $array);

				//Preventivas com relatórios Entregues
				$array = array();
				$array['name'] = 'Relatórios Entregues (Aprovados)';
				$array['data'] = array();

				foreach ( $supervisores_tipo[$tipo] as $key => $supervisor )
					array_push( $array['data'] , (int) $supervisor[5]);

				array_push( $qtd_por_situacao_tipo[$tipo], $array);

				$dados['nomes_supervisores_tipo'] = $nomes_supervisores_tipo;
				$dados['qtd_por_situacao_tipo'] = $qtd_por_situacao_tipo;

			}

		}
		else{

			// Caso o usuário tenho filtrado por algum supervisor
			$situacoes_preventivas = situacoes_preventivas();

			foreach ( tipos_preventivas() as $tipo => $nome ){

				$tecnicos_tipo[$tipo] = $this->preventiva_model->listar_tecnicos_graficos( $search_supervisor, $data_inicio, $data_fim, $tipo );

				// Buscar quantidade de preventivas de cada situação
				foreach ( $tecnicos_tipo[$tipo] as $key => $tecnico ) {

					$all_qtd = $this->preventiva_model->qtd_preventivas_por_tecnico( $search_supervisor, $tecnico['id_tecnico'], $data_inicio, $data_fim, $tipo );
					
					$tecnicos_tipo[$tipo][ $key ][ 'programadas' ] = 0;
					

					foreach ( $all_qtd as $qtd) {
						
						$tecnicos_tipo[$tipo][ $key ][ $qtd['status'] ] = $qtd['qtd'];
						$tecnicos_tipo[$tipo][ $key ][ 'programadas' ] = $tecnicos_tipo[$tipo][ $key ][ 'programadas' ] + $qtd['qtd'];

					}

					foreach ( $situacoes_preventivas as $cod => $situacao ) {
						
						if ( ! isset( $tecnicos_tipo[$tipo][ $key ][ $cod ] ) )
							$tecnicos_tipo[$tipo][ $key ][ $cod ] = 0;

					}

				}
				
				// Montar array para indentificar ao HighCharts os tecnicos que aparecerão
				$nomes_tecnicos_tipo[$tipo] = array();

				foreach ( $tecnicos_tipo[$tipo] as $key => $tecnico )
					array_push( $nomes_tecnicos_tipo[$tipo], $tecnico['tecnico']);

				// Montar array para os dados serem exibidos
				$qtd_por_situacao_tipo[$tipo] = array();
				
				// Preventivas programadas
				$array = array();
				$array['name'] = 'Programadas';
				$array['data'] = array();

				foreach ( $tecnicos_tipo[$tipo] as $key => $tecnico )
					array_push( $array['data'] , (int) $tecnico['programadas']);

				array_push( $qtd_por_situacao_tipo[$tipo], $array);

				//Preventivas executadas
				$array = array();
				$array['name'] = 'Executadas';
				$array['data'] = array();

				foreach ( $tecnicos_tipo[$tipo] as $key => $tecnico )
					array_push( $array['data'] , (int) $tecnico[2] + $tecnico[3] + $tecnico[4]);

				array_push( $qtd_por_situacao_tipo[$tipo], $array);

				//Preventivas com relatórios Entregues
				$array = array();
				$array['name'] = 'Relatórios Entregues (Aprovados)';
				$array['data'] = array();

				foreach ( $tecnicos_tipo[$tipo] as $key => $tecnico )
					array_push( $array['data'] , (int) $tecnico[5]);

				array_push( $qtd_por_situacao_tipo[$tipo], $array);

				$dados['nomes_tecnicos_tipo'] = $nomes_tecnicos_tipo;
				$dados['qtd_por_situacao_tipo'] = $qtd_por_situacao_tipo;

			}


		}

		$this->template->load('template.php', 'index-view.php', $dados);

	}

}
