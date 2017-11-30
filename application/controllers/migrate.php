<?php

/**
 * Controller para migrate.
 * @category Controller
 * @author Luiz Felipe <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{

    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE){

            echo 'Erro ' . $this->migration->error_string();

        } else {

            echo 'Migração realizada com sucesso';
            
        } 

    }

}
