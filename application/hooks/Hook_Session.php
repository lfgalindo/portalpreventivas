<?php

/**
 * Hook para atualizar a sessão atual logo após o construtor de um Controller.
 * @author Luiz Felipe <lfgalindo@live.com>
 */

class Hook_Session {

	public function atualizar_sessao() {

		$ci = &get_instance();

		if( $ci->not_hookable){ 

			$id_usuario 	= $ci->session->userdata('id_usuario') ? $ci->session->userdata('id_usuario') : false;
			$auth 	 		= $ci->session->userdata('auth')	   ? $ci->session->userdata('auth') 	  : false;

			//if( ! is_numeric( $this->session->id_usuario ) || $this->session->auth == false )
			//	redirect('logout');

			$ci->load->library('usuario_class');

			$ci->load->model('usuario_model');

			$usuario = new Usuario_CLass();

			$usuario->setID( $id_usuario );
			$usuario = $ci->usuario_model->selecionar( 'usuarios', $usuario );


			/**
			 * Juntamos todas as informações e atualizamos a session.
			 */
			$ci->session->set_userdata( array(
					'auth'				=> true,
					'permissoes'		=> unserialize( $usuario->getPermissoes() )
				)
			);

		}

		return true;

	}
}

?>