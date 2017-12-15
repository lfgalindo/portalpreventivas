<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<html lang="pt-br">

	<head>

	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	    <title>Login</title>

	    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	    <link href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.css" rel="stylesheet">
	    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	    <script src="<?php echo base_url(); ?>assets/tether/js/tether.min.js"></script>
	    <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
	    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	    <script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>
	</head>

	<style type="text/css">
		body{
			background-color: #eaeff2;
		}
		html, body, .container-fluid, .row, .col-md-4{
			height: 100%;
		}
		.col-md-4{
			height: 100%;
		    display: flex;
		    align-items: center;
		    justify-content: center;
		}
		.form_login{
			width: 100%;
		}
		form{
			
		}		

	</style>

	<body>

		<div class="container-fluid" id="wrapper">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="form_login">
						<?php

						// Exibe as mensagens de erro caso tenha.
						if( $this->flashmessages->hasMessages() ) {
						    echo '<div class="alerts">';
						    $this->flashmessages->display();
						    echo '</div>';
						}

						?>

						<?php echo form_open("login/auth"); ?>

						<p><?php echo form_input( array(
								"name" => "login",
								"id" => "login",
								"placeholder" => "Digite o login..."
							) ); ?></p>

						<p><?php echo form_password( array(
								"name" => "senha",
								"id" => "senha",
								"placeholder" => "**********"
							) ); ?></p>

						<p><?php echo form_button( array(
								"content" => "Acessar",
								"type" => "submit",
								"class" => "hvr-shutter-out-horizontal",
							) ); ?></p>

						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
