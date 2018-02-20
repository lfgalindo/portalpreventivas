<?php

/**
 * Classe responsável por importar dados de um planilha CSV.
 *
 * @category Importação
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Importacao extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Verifica se o usuário está logado.
		if( ! $this->session->auth ) {
			redirect("login");
		}

		// Algumas models que iremos utilizar.
		$this->load->model('preventiva_model');
		$this->preventiva_model->setTable('preventivas');

		$this->load->model('site_model');
		$this->site_model->setTable('sites');

		$this->load->model('usuario_model');
		$this->usuario_model->setTable('usuarios');


		$this->load->library('site_class');
		$this->load->library('usuario_class');
		$this->load->library('preventiva_class');

		$this->template->set('title', 'Importar preventivas');

	}

	public function index() {

		$nao_tem_nenhum = array();
		$nao_tem_supervisor = array();
		$nao_tem_site = array();
		$incluir = array();

		$arquivo = fopen ('./uploads/zeladoria_marco.csv', 'r');

		while( ! feof( $arquivo ) ){
			
			$linha = fgets($arquivo, 1024);
			
			$dados = explode(';', $linha);
			
			if ( ! empty( $linha ) ){

				$existe_site = false;
				$existe_usuario = false;
				
				if ( $this->site_model->existe_cadastro( 'ne_id', $dados[0] ) ){

					$site = new Site_Class();
					$site->setNeId( $dados[0] );

					$site = $this->site_model->selecionar_por_campo( $site, 'ne_id', 'getNeId' );

					$existe_site = true;

				}

				if ( $this->usuario_model->existe_cadastro( 'nome', trim($dados[1]) ) ){
	
					$usuario = new Usuario_Class();
					$usuario->setNome( trim($dados[1]) );

					$usuario = $this->usuario_model->selecionar_por_campo( $usuario, 'nome', 'getNome' );
				
					$existe_usuario = true;

				}

				if ( $existe_site && $existe_usuario ){
					array_push( $incluir, array(
											"id_site" => $site->getID(),
											"site" 	  => $site->getNeId(),
											"id_supervisor" => $usuario->getID(),
											"supervisor" => $usuario->getNome(),
											)
										);
				}

				if ( $existe_site && ! $existe_usuario ){
					array_push( $nao_tem_supervisor, array(
														"site" 		=> $site->getNeId(),
														"supervisor" => $dados[1] ,
														)
													);
				}

				if ( ! $existe_site && $existe_usuario ){
					array_push( $nao_tem_site, array(
													"site" => $dados[0],
													"supervisor" => $usuario->getNome() ,
													)
												);
				}

				if ( ! $existe_site && ! $existe_usuario ){
					array_push( $nao_tem_nenhum, array(
													"site" => $dados[0],
													"supervisor" => $dados[1],
													)
												);
				}

			}

		}

		fclose($arquivo);

		echo '<link href="' . base_url() . 'assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">';


		$tipo_preventiva = 'zeladoria';
		$data_programada = '2018-03-01';
		$qtd_nao_importadas = count( $nao_tem_supervisor ) + count( $nao_tem_site ) + count( $nao_tem_nenhum );
		$qtd_importadas =  count( $incluir );


		echo '<table class="table table-striped">';
		echo '<tr>';
		echo '<th colspan="2" style="text-align:center"> Dados da importação </td>';
		

		echo '<tr>';
		echo '<th>Programada:</th>';
		echo '<td>' . nome_mes( date('m', strtotime( $data_programada)) ) . ' - ' . date('Y', strtotime($data_programada)) . '</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th>Tipo:</th>';
		echo '<td>' . tipos_preventivas( $tipo_preventiva ) . '</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th>Preventivas no excel:</th>';
		echo '<td>' . ($qtd_nao_importadas + $qtd_importadas) . '</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th>Preventivas que não foram importadas:</th>';
		echo '<td>' . $qtd_nao_importadas . '</td>';
		echo '</tr>';


		echo '<tr>';
		echo '<th>Preventivas importadas:</th>';
		echo '<td>' . $qtd_importadas . '</td>';
		echo '</tr>';

		echo '</table>';

		echo '<br><br><br>';

		if ( count($nao_tem_supervisor) > 0 ){

			echo '<table class="table table-striped">';
			echo '<tr>';
			echo '<th colspan="2" style="text-align:center"> Preventivas não importadas - Motivo: Não possui supervisor cadastrado </td>';
			
			echo '<tr>';
			echo '<th>Site</td>';
			echo '<th>Supervisor</td>';
			echo '</tr>';

			foreach ($nao_tem_supervisor as $preventiva) {

				echo '<tr>';
				echo '<td>' . $preventiva['site'] . '</td>';
				echo '<td>' . $preventiva['supervisor'] . '</td>';
				echo '</tr>';

			}

			echo '</table>';

			echo '<br><br><br>';

		}

		if ( count($nao_tem_site) > 0 ){

			echo '<table class="table table-striped">';
			echo '<tr>';
			echo '<th colspan="2" style="text-align:center"> Preventivas não importadas - Motivo: Não possui site cadastrado </td>';
			
			echo '<tr>';
			echo '<th>Site</td>';
			echo '<th>Supervisor</td>';
			echo '</tr>';

			foreach ($nao_tem_site as $preventiva) {

				echo '<tr>';
				echo '<td>' . $preventiva['site'] . '</td>';
				echo '<td>' . $preventiva['supervisor'] . '</td>';
				echo '</tr>';

			}

			echo '</table>';

			echo '<br><br><br>';

		}

		if ( count($nao_tem_nenhum) > 0 ){

			echo '<table class="table table-striped">';
			echo '<tr>';
			echo '<th colspan="2" style="text-align:center"> Preventivas não importadas - Motivo: Não possui site e supervisor cadastrados </td>';
			
			echo '<tr>';
			echo '<th>Site</td>';
			echo '<th>Supervisor</td>';
			echo '</tr>';

			foreach ($nao_tem_nenhum as $preventiva) {

				echo '<tr>';
				echo '<td>' . $preventiva['site'] . '</td>';
				echo '<td>' . $preventiva['supervisor'] . '</td>';
				echo '</tr>';

			}

			echo '</table>';

			echo '<br><br><br>';

		}

		echo '<table class="table table-striped">';
		echo '<tr>';
		echo '<th colspan="2" style="text-align:center"> Preventivas importadas </td>';
		
		echo '<tr>';
		echo '<th>Site</td>';
		echo '<th>Supervisor</td>';
		echo '</tr>';

		foreach ($incluir as $preventiva) {

			$preventiva_obj = new Preventiva_Class();

			$preventiva_obj->setTipo( 			$tipo_preventiva );
			$preventiva_obj->setDataCadastro( 	date("Y-m-d H:i:s") );
			$preventiva_obj->setProgramada( 	$data_programada );
			$preventiva_obj->setStatus( 		'1' );
			$preventiva_obj->setIDSite( 		$preventiva['id_site'] );
			$preventiva_obj->setIDTecnico( 		$preventiva['id_supervisor'] );
			$preventiva_obj->setIDSupervisor( 	$preventiva['id_supervisor'] );
			$preventiva_obj->setIDUsuario( 		'1' );

			if ( ! $this->preventiva_model->existe_import( $preventiva_obj ) )
				$this->preventiva_model->inserir( $preventiva_obj );

			echo '<tr>';
			echo '<td>' . $preventiva['site'] . '</td>';
			echo '<td>' . $preventiva['supervisor'] . '</td>';
			echo '</tr>';

		}

		echo '</table>';
	}

}
