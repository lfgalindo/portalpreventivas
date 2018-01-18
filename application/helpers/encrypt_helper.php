<?php

	/**
	 * Helper para esconder as IDs da URL
	 * @author   Luiz Felipe Magalhães Galindo <lfgalindo@live.com>
	 */

	defined('BASEPATH') OR exit('No direct script access allowed');

	if ( ! function_exists('encrypt') ) {

		function encrypt( $number ) {

		    $new_number = bcmul( $number, "39248293889798794986471896423" );

		    $vetor = str_split( $new_number );

		    $characters = 'qwertyuiopASDFGHJKLQWERTYUIOPasdfghjkMNBVCXzxcvbnm';

		    $char = str_split( $characters );

		    $encrypt = "";

		    foreach ($vetor as $num) {
		    	$encrypt .= $num . $char[ rand(0, count($char) - 1)];
		    }

		    return $encrypt;

		}

	}

	if ( ! function_exists('decrypt') ) {

		function decrypt( $string ) {

			$decrypt = preg_replace("/[^0-9]/", "", $string);

			$decrypt = bcdiv( $decrypt, "39248293889798794986471896423" );	

		    return $decrypt;
		    
		}

	}

?>