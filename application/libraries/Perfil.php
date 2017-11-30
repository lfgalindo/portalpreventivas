<?php

/**
 * Classe que define os campos e seus métodos get e set para um objeto Perfil.
 *
 * @category Perfil
 * @author Luiz Felipe <lfgalindo@live.com>
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil {

	/**
	 * Atributos de um Perfil
	 * @var int		$id 			Código do perfil.
	 * @var string 	$nome 			Nome do perfil.
	 * @var string 	$permissao		Permissões do perfil.
	 */

	private $id;
	private $nome;
	private $permissao;

	/**
	 * Método que define os campos da tabela de perfis no banco de dados.
	 * @return array
	*/

	public function schema(){

		return array(
              'id' => array(
                'type' => 'BIGINT',
				'unique' => true,
                'unsigned' => true,
                'auto_increment' => true
              ),
              'nome' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
              ),
              'permissao' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
              )
           );

	} /** Fim do método schema*/


	/**
	 * Método para retornar o objeto em um array.
	 * @access public
	 * @param object $perfil
	 */
	public function to_array( $perfil ) {

		return array(
			'id'		 	=> $perfil->getID(),
			'nome' 			=> $perfil->getNome(),
			'permissao' 	=> $perfil->getPermissao(),
		);

	}

	/** Gets e Sets dos atributos */
	public function getID(){
		return $this->id;
	}

	public function setID($id){
		$this->id = $id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getPermissao(){
		return $this->permissao;
	}

	public function setPermissao($permissao){
		$this->permissao = $permissao;
	}
	/** Fim do Sets e Gets */
}

?>