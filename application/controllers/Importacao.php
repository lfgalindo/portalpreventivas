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

		$arquivo = fopen ('./uploads/preventivas.csv', 'r');

		while( ! feof( $arquivo ) ){
			
			$linha = fgets($arquivo, 1024);
			
			$dados = explode(';', $linha);

			echo "<pre>";
			var_dump($dados);
			
			if ( ! empty( $linha ) ){

				$existe_site = false;
				$existe_usuario = false;
				
				if ( $this->site_model->existe_cadastro( 'ne_id', $dados[0] ) ){

					$site = new Site_Class();
					$site->setNeId( $dados[0] );

					$site = $this->site_model->selecionar_por_campo( $site, 'ne_id' );

					$existe_site = true;

				}

				if ( $this->usuario_model->existe_cadastro( 'nome', $dados[1] ) ){
	
					$usuario = new Usuario_Class();
					$usuario->setNome( $dados[1] );

					$usuario = $this->usuario_model->selecionar_por_campo( $usuario, 'nome' );
				
					$existe_usuario = true;

				}

				if ( $existe_site && $existe_usuario ){
					array_push( $incluir, array(
											"id_site" => $site->getID(),
											"id_supervisor" => $usuario->getID(),
											)
										);
				}

				if ( $existe_site && ! $existe_usuario ){
					array_push( $nao_tem_supervisor, array(
														"id_site" => $site->getID(),
														"supervisor" => $dados[1] ,
														)
													);
				}

				if ( ! $existe_site && $existe_usuario ){
					array_push( $nao_tem_site, array(
													"id_site" => $dados[0],
													"supervisor" => $usuario->getID() ,
													)
												);
				}

				if ( ! $existe_site && ! $existe_usuario ){
					array_push( $nao_tem_nenhum, array(
													"id_site" => $dados[0],
													"supervisor" => $dados[1],
													)
												);
				}

			}

		}

		fclose($arquivo);

		echo "<pre>";

		echo "Incluir: <br>";

		var_dump($incluir);

		echo "<br><br>Não incluir: <br>";

		var_dump($incluir);
		var_dump($nao_tem_supervisor);
		var_dump($nao_tem_site);
		var_dump($nao_tem_nenhum);

	
	}

}
