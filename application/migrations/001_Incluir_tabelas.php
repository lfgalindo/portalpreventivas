<?php

/**
 * Classe para definição do banco de dados de acordo com as libraries.
 *
 * @category Migration
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Incluir_tabelas extends CI_Migration {

    // Array com todas as Classes e tabelas do sistema
    private $tabelas = array(
                        "Usuario_Class"     => "usuarios",
                        "Site_Class"        => "sites",
                        "Arquivo_Class"     => "arquivos",
                        "Preventiva_Class"  => "preventivas",
                        );


    public function __construct() {

        foreach ( $this->tabelas as $classe => $nome_tabela ){

            $classe = strtolower( $classe );

            $this->load->library( $classe );

        }

    }       

    public function up() {

        //$this->down();

        $attributes = array('ENGINE' => 'InnoDB');

        /** Criação das tabelas de acordo com a array. */
        foreach ( $this->tabelas as $classe => $nome_tabela ){

            $objeto = new $classe();

            $this->dbforge->add_field( $objeto->schema() );
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table($nome_tabela, false, $attributes );

        }

    }

    public function down() {
        
        //drop_fk( 'usuarios', 'id_perfil' );

        foreach ( $this->tabelas as $nome_tabela ){

            $this->dbforge->drop_table( $nome_tabela );

        }

    }
    
}