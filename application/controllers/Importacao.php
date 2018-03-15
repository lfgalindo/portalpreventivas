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

		$this->load->model('arquivo_model');
		$this->arquivo_model->setTable('arquivos');

		$this->load->library('site_class');
		$this->load->library('usuario_class');
		$this->load->library('preventiva_class');

		$this->template->set('title', 'Importar preventivas');

	}

	public function index() {

		$nao_tem_tecnico = array();
		$nao_tem_supervisor = array();
		$nao_tem_site = array();
		$incluir = array();

		$arquivo = fopen ('./uploads/estrutural_marco.csv', 'r');

		while( ! feof( $arquivo ) ){
			
			$linha = fgets($arquivo, 1024);
			
			$dados = explode(';', $linha);
			
			if ( ! empty( $linha ) ){

				$existe_site = false;
				$existe_supervisor = false;
				$existe_tecnico = false;
				
				if ( $this->site_model->existe_cadastro( 'ne_id', $dados[0] ) ){

					$site = new Site_Class();
					$site->setNeId( $dados[0] );

					$site = $this->site_model->selecionar_por_campo( $site, 'ne_id', 'getNeId' );

					$existe_site = true;

				}

				if ( $this->usuario_model->existe_cadastro( 'nome', trim($dados[1]) ) ){
	
					$supervisor = new Usuario_Class();
					$supervisor->setNome( trim($dados[1]) );

					$supervisor = $this->usuario_model->selecionar_por_campo( $supervisor, 'nome', 'getNome' );
				
					$existe_supervisor = true;

				}

				if ( $this->usuario_model->existe_cadastro( 'nome', trim($dados[2]) ) ){
	
					$tecnico = new Usuario_Class();
					$tecnico->setNome( trim($dados[2]) );

					$tecnico = $this->usuario_model->selecionar_por_campo( $tecnico, 'nome', 'getNome' );
				
					$existe_tecnico = true;

				}

				if ( $existe_site && $existe_supervisor && $existe_tecnico ){
					array_push( $incluir, array(
											"id_site" 		=> $site->getID(),
											"site" 	  		=> $site->getNeId(),
											"id_supervisor" => $supervisor->getID(),
											"supervisor" 	=> $supervisor->getNome(),
											"id_tecnico" 	=> $tecnico->getID(),
											"tecnico" 		=> $tecnico->getNome(),
											)
										);
				}


				if ( ! $existe_site ){
					array_push( $nao_tem_site, array(
													"site" 			=> $dados[0],
													"supervisor" 	=> $dados[1],
													"tecnico" 		=> $dados[2]
													)
												);
				}
				else if ( ! $existe_supervisor ){
					array_push( $nao_tem_supervisor, array(
														"site" 			=> $dados[0],
														"supervisor" 	=> $dados[1],
														"tecnico" 		=> $dados[2]
														)
													);
				}
				else if ( ! $existe_tecnico ){
					array_push( $nao_tem_tecnico, array(
													"site" 			=> $dados[0],
													"supervisor"	=> $dados[1],
													"tecnico" 		=> $dados[2]
													)
												);
				}

			}

		}

		fclose($arquivo);

		echo '<link href="' . base_url() . 'assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">';


		$tipo_preventiva = 'estrutural';
		$data_programada = '2018-03-01';
		$qtd_nao_importadas = count( $nao_tem_supervisor ) + count( $nao_tem_site ) + count( $nao_tem_tecnico );
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
			echo '<th colspan="3" style="text-align:center"> Preventivas não importadas - Motivo: Não possui supervisor cadastrado </td>';
			
			echo '<tr>';
			echo '<th>Site</td>';
			echo '<th>Supervisor</td>';
			echo '<th>Técnico</td>';
			echo '</tr>';

			foreach ($nao_tem_supervisor as $preventiva) {

				echo '<tr>';
				echo '<td>' . $preventiva['site'] . '</td>';
				echo '<td>' . $preventiva['supervisor'] . '</td>';
				echo '<td>' . $preventiva['tecnico'] . '</td>';
				echo '</tr>';

			}

			echo '</table>';

			echo '<br><br><br>';

		}

		if ( count($nao_tem_site) > 0 ){

			echo '<table class="table table-striped">';
			echo '<tr>';
			echo '<th colspan="3" style="text-align:center"> Preventivas não importadas - Motivo: Não possui site cadastrado </td>';
			
			echo '<tr>';
			echo '<th>Site</td>';
			echo '<th>Supervisor</td>';
			echo '<th>Técnico</td>';
			echo '</tr>';

			foreach ($nao_tem_site as $preventiva) {

				echo '<tr>';
				echo '<td>' . $preventiva['site'] . '</td>';
				echo '<td>' . $preventiva['supervisor'] . '</td>';
				echo '<td>' . $preventiva['tecnico'] . '</td>';
				echo '</tr>';

			}

			echo '</table>';

			echo '<br><br><br>';

		}

		if ( count($nao_tem_tecnico) > 0 ){

			echo '<table class="table table-striped">';
			echo '<tr>';
			echo '<th colspan="3" style="text-align:center"> Preventivas não importadas - Motivo: Não possui técnico cadastrado </td>';
			
			echo '<tr>';
			echo '<th>Site</td>';
			echo '<th>Supervisor</td>';
			echo '<th>Técnico</td>';
			echo '</tr>';

			foreach ($nao_tem_tecnico as $preventiva) {

				echo '<tr>';
				echo '<td>' . $preventiva['site'] . '</td>';
				echo '<td>' . $preventiva['supervisor'] . '</td>';
				echo '<td>' . $preventiva['tecnico'] . '</td>';
				echo '</tr>';

			}

			echo '</table>';

			echo '<br><br><br>';

		}

		echo '<table class="table table-striped">';
		echo '<tr>';
		echo '<th colspan="3" style="text-align:center"> Preventivas importadas </td>';
		
		echo '<tr>';
		echo '<th>Site</td>';
		echo '<th>Supervisor</td>';
		echo '<th>Técnico</td>';
		echo '</tr>';

		foreach ($incluir as $preventiva) {

			$preventiva_obj = new Preventiva_Class();

			$preventiva_obj->setTipo( 			$tipo_preventiva );
			$preventiva_obj->setDataCadastro( 	date("Y-m-d H:i:s") );
			$preventiva_obj->setProgramada( 	$data_programada );
			$preventiva_obj->setStatus( 		'1' );
			$preventiva_obj->setIDSite( 		$preventiva['id_site'] );
			$preventiva_obj->setIDTecnico( 		$preventiva['id_tecnico'] );
			$preventiva_obj->setIDSupervisor( 	$preventiva['id_supervisor'] );
			$preventiva_obj->setIDUsuario( 		'1' );

			if ( ! $this->preventiva_model->existe_import( $preventiva_obj ) )
				$this->preventiva_model->inserir( $preventiva_obj );

			echo '<tr>';
			echo '<td>' . $preventiva['site'] . '</td>';
			echo '<td>' . $preventiva['supervisor'] . '</td>';
			echo '<td>' . $preventiva['tecnico'] . '</td>';
			echo '</tr>';

		}

		echo '</table>';
	}

	public function tipo_top_end_id() {

		$arquivo = fopen ('./uploads/tipo_top-end_id.csv', 'r');

		$cont = 0;

		while( ! feof( $arquivo ) && $cont < 10 ){
			
			//$cont++;

			$linha = fgets($arquivo, 1024);
			
			$dados = explode(';', $linha);
			
			if ( ! empty( $linha ) ){
				
				if ( $this->site_model->existe_cadastro( 'ne_id', $dados[0] ) ){

					$site = new Site_Class();
					$site->setNeId( $dados[0] );

					$site = $this->site_model->selecionar_por_campo( $site, 'ne_id', 'getNeId' );

					$tipo_top = trim($dados[2]) == 'TOP' ? 'TOP' : 'NÃO TOP';

					$site->setTipoTop( 	$tipo_top );
					$site->setEndId( 	$dados[1] );

					$this->site_model->atualizar( $site );

				}

			}

		}

		fclose($arquivo);
	}

	public function novos_campos_e_sites() {

		$arquivo = fopen ('./uploads/novos_campos_e_sites.csv', 'r');

		$cont = 0;

		while( ! feof( $arquivo ) && $cont < 25 ){
			
			//$cont++;

			$linha = fgets($arquivo, 1024);
			
			$dados = explode(';', $linha);
			
			if ( ! empty( $linha ) ){

				$site = new Site_Class();
				
				if ( $this->site_model->existe_cadastro( 'ne_id', $dados[5] ) ){

					$site->setNeId( utf8_encode($dados[5]) );

					$site = $this->site_model->selecionar_por_campo( $site, 'ne_id', 'getNeId' );

					$site->setCoSite( 			utf8_encode($dados[6]));
					$site->setCoSiteEmpresa( 	utf8_encode($dados[9]));
					$site->setCoSiteUmts( 		utf8_encode($dados[10]));
					$site->setTipoBts(			utf8_encode($dados[13]));
					$site->setLatitude(			utf8_encode($dados[20]));
					$site->setLongitude( 		utf8_encode($dados[21]));

					$this->site_model->atualizar( $site );

				}
				else{

					$site->setIDTim(			utf8_encode($dados[0]));
					$site->setOperadora(		utf8_encode($dados[1]));
					$site->setRede(				utf8_encode($dados[2]));
					$site->setTipoNe(			utf8_encode($dados[3]));
					$site->setFornecedor(		utf8_encode($dados[4]));
			    	$site->setNeId(				utf8_encode($dados[5]));
			    	$site->setTipoTop(			utf8_encode($dados[8]));
			    	$site->setEndId(			utf8_encode($dados[7]));
					$site->setRestricaoAcesso(	utf8_encode($dados[11]));
					$site->setObservacoes(		utf8_encode($dados[12]));
					$site->setCoSite( 			utf8_encode($dados[6]));
					$site->setCoSiteEmpresa( 	utf8_encode($dados[9]));
					$site->setCoSiteUmts( 		utf8_encode($dados[10]));
					$site->setTipoBts(			utf8_encode($dados[13]));
					$site->setLatitude(			utf8_encode($dados[20]));
					$site->setLongitude( 		utf8_encode($dados[21]));
					$site->setEstado(			utf8_encode($dados[14]));
					$site->setCidade(			utf8_encode($dados[15]));
					$site->setDDD(				utf8_encode($dados[16]));
					$site->setEndereco(			utf8_encode($dados[17]));
					$site->setBairro(			utf8_encode($dados[18]));
					$site->setCm(				utf8_encode($dados[19]));

					$this->site_model->inserir( $site );

				}

			}

		}

		fclose($arquivo);
	}

	public function nova_estrutura_uploads() {

		$all_files = $this->arquivo_model->listar_tudo();

		foreach ( $all_files as $file_bd ){

			$file = './uploads/' . $file_bd['raw'] . $file_bd['formato'];

			echo file_exists( $file );

			if( $file_bd['recusado'] != "1" && file_exists( $file ) ){

				echo 'Entrou';

				$ano_envio = date( 'Y', strtotime( $file_bd['data_envio'] ) );
				$mes_envio = date( 'm', strtotime( $file_bd['data_envio'] ) );

				if ( ! file_exists( './uploads/' . $ano_envio . '-' . $mes_envio . '/' ) )
					mkdir( './uploads/' . $ano_envio . '-' . $mes_envio . '/' );

				copy( $file, './uploads/' . $ano_envio . '-' . $mes_envio . '/' . $file_bd['raw'] . $file_bd['formato']);

			}

		}

		echo "Concluído";

	}

}