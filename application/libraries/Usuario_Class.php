<?php

/**
 * Classe que define os campos e seus métodos get e set para um objeto Usuario.
 *
 * @category Usuário
 * @author Luiz Felipe <lfgalindo@live.com>
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Class {

	/**
	 * Atributos de um Usuário
	 * @var int		$id   			Código do usuario.
	 * @var string 	$nome 			Nome do usuário.
	 * @var int 	$cpf 			CPF do usuário.
	 * @var string 	$login	 		Login do usuário.
	 * @var string 	$senha			Senha do usuário.
	 * @var string 	$matricula		Matrícula TEL do usuário.
	 * @var int 	$telefone		Telefone do usuário.
	 * @var int 	$removido		Se usuário foi removido.
	 */

	private $id;
	private $nome;
	private $cpf;
	private $login;
	private $senha;
	private $matricula;
	private $telefone;
	private $removido;

	/**
	 * Método que define os campos da tabela de usuários no banco de dados.
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
              'cpf' => array(
                'type' => 'INT',
                'null' => true
              ),
              'login' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
              ),
              'senha' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
              ),
              'matricula' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
              ),
              'telefone' => array(
                'type' => 'INT',
                'null' => true
              ),
              'removido' => array(
                'type' => 'INT',
                'null' => true
              )
           );

	} /** Fim do método schema*/


	/**
	 * Método para retornar o objeto em um array.
	 * @access public
	 * @param object $usuario
	 */
	public function to_array( $usuario ) {

		return array(
			'id' 			=> $usuario->getID(),
			'nome' 			=> $usuario->getNome(),
			'cpf' 			=> $usuario->getCPF(),
			'login' 		=> $usuario->getLogin(),
			'senha' 		=> $usuario->getSenha(),
			'matricula' 	=> $usuario->getMatricula(),
			'telefone' 		=> $usuario->getTelefone(),
			'removido' 		=> $usuario->getRemovido()
		);

	}

	/**
	 * Método para retornar um array em um objeto.
	 * @access public
	 * @param array $usuario
	 */
	public function to_object( $array, $usuario ) {

		$usuario->setID( 		$array['id'] );
		$usuario->setNome(		$array['nome']);
		$usuario->setCPF(		$array['cpf']);
		$usuario->setLogin(		$array['login']);
		$usuario->setSenha(		$array['senha']);
		$usuario->setMatricula(	$array['matricula']);
		$usuario->setTelefone(	$array['telefone']);
		$usuario->setRemovido(	$array['removido']);

		return $usuario;

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

	public function getCPF(){
		return $this->cpf;
	}

	public function setCPF($cpf){
		$this->cpf = $cpf;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getMatricula(){
		return $this->matricula;
	}

	public function setMatricula($matricula){
		$this->matricula = $matricula;
	}

	public function getTelefone(){
		return $this->telefone;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}

	public function getRemovido(){
		return $this->removido;
	}

	public function setRemovido($removido){
		$this->removido = $removido;
	}
	/** Fim do Sets e Gets */
}

?>