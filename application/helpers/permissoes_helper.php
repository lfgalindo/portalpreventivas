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

// Array com as permissões que serão usadas no sistema
if ( ! function_exists('todas_permissoes') ){

	function todas_permissoes(){

		$permissoes = array(
						// Permissões para usuários
						'usuarios' => array(
								'nome' => 'Usuários',
								'permissoes' => array(
									'visualizar_usuarios' 						=> 'Visualizar usuários',
									'cadastrar_usuarios'						=> 'Cadastrar usuários',
									'editar_usuarios'							=> 'Editar usuários',
									'remover_usuarios'							=> 'Remover usuários'
								),
								'requisitos' => array(
									'visualizar_usuarios' 						=> 'sem_requisito',
									'cadastrar_usuarios'						=> 'visualizar_usuarios',
									'editar_usuarios'							=> 'visualizar_usuarios',
									'remover_usuarios'							=> 'visualizar_usuarios'
								)
						),
						// Permissões para sites
						'sites' => array(
								'nome' => 'Sites',
								'permissoes' => array(
									'visualizar_sites' 						=> 'Visualizar sites',
									'cadastrar_sites'						=> 'Cadastrar sites',
									'editar_sites'							=> 'Editar sites',
									'remover_sites'							=> 'Remover sites'
								),
								'requisitos' => array(
									'visualizar_sites' 						=> 'sem_requisito',
									'cadastrar_sites'						=> 'visualizar_sites',
									'editar_sites'							=> 'visualizar_sites',
									'remover_sites'							=> 'visualizar_sites'
								)
						),
		);

		return $permissoes;

	}

}