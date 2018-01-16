<?php

/**
 * Helper para validar o acesso de um usuário
 * @author   Luiz Felipe Magalhães Galindo <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('check_permission') ) {

	function check_permission( $permissao, $redirect = null ) {

		$ci = &get_instance();

		$sessao = $ci->session->userdata('permissoes');

		if( ! is_array( $sessao ) || ! in_array( $permissao, $sessao ) ):
			
			if( is_null( $redirect ) )
				return false;

			$ci->flashmessages->error('Você não tem essa permissão de acesso!');
			redirect($redirect);

		endif;

		return true;
	}

}