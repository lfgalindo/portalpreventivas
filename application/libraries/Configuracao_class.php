<?php

/**
 * Classe que define os campos e seus métodos get e set para um objeto Configuração.
 *
 * @category Configuracao
 * @author Luiz Felipe <lfgalindo@live.com>
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracao_Class {

	private $id;
	private $nome;
	private $apelido;
	private $valor;

	/**
	 * Método que define os campos da tabela de sites no banco de dados.
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
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'apelido' => array(
                'type' => 'VARCHAR',
                'null'	=> TRUE,
                'constraint' => '255',
              ),
              'valor' => array(
                'type' => 'TEXT'
              )
           );

	} /** Fim do método schema*/


	/**
	 * Método para retornar o objeto em um array.
	 * @access public
	 * @param object $configuracao
	 */
	public function to_array( $configuracao ) {

		return array(
			'id'		 		=> $configuracao->getID(),
			'nome' 				=> $configuracao->getNome(),
			'apelido'			=> $configuracao->getApelido(),
			'valor'				=> $configuracao->getValor()
		);

	}

	/**
	 * Método para retornar um array em um objeto.
	 * @access public
	 * @param array $configuracao
	 */
	public function to_object( $array, $configuracao ) {

		$configuracao->setID( 		$array['id'] );
		$configuracao->setNome(		$array['nome']);
		$configuracao->setApelido(	$array['apelido']);
		$configuracao->setValor(	$array['valor']);

		return $configuracao;

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

	public function getApelido(){
		return $this->apelido;
	}

	public function setApelido($apelido){
		$this->apelido = $apelido;
	}

	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}

	/** Fim do Sets e Gets */

}

?>