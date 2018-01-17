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

			@import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

		body{
			background-color: #525262;
		    font-family: 'Raleway', sans-serif;
		}
		html, body{
			height: 100%;
		}
		.col-md-6{
			height: 100%;
		    display: flex;
		    align-items: center;
		    justify-content: center;
		}
		.form_login{
		    display: flex;
		    align-items: center;
		    flex-direction: column;
		}
		form{
			width: 100%;
			height: 70%;
			background-color: #eaeff2;
			border-radius: 5px;	
		}
		input[type='text'],
		input[type='password']{
			width: 100%;
			margin-bottom: 30px;
		}

		.btn-green{
		    background-color: #9fd037;
		    border: solid 2px #9fd037;
		    color: #fff;
		    border-radius: 3px;
		    padding: 3px 30px;
		}	

		.group_inputs{
 		   text-align: center;
 		   display: flex;
 		   flex-direction: column;
 		   justify-content: center;
 		   align-items: center;
		}

		h4{
			font-weight: bold;

		}

		.center{
			display: flex;
			justify-content: center;
			align-items: center;
		}

		div.alerts{
		    position: absolute;
		    top: 65px;
		    right: 15px;
		    z-index: 9999;
		    min-width: 20%;
		}


	</style>

	<body>

		<div class="container-fluid" style="height: 100%" id="wrapper">
			<div class="row"  style="height: 100%">
				<div class="col-md-6 col-md-offset-3">
					<?php echo form_open("login/auth"); ?>
						<div class='row center' style="height: 100%">
							<div class="form_login col-md-6 ofset-col-md-3">
								<div class='container-fluid'>

								<div class='row' style="margin-bottom: 25px;">
									<div class="col-md-12">
										<h4>Faça login para continuar</h4>	
									</div>
								</div>

								<?php

									// Exibe as mensagens de erro caso tenha.
									if( $this->flashmessages->hasMessages() ) {
									    echo '<div class="alerts">';
									    $this->flashmessages->display();
									    echo '</div>';
									}

								?>

								<div class='row'>
									<div class="group_inputs col-md-12">

										<?php echo form_input( array(
												"name" => "login",
												"id" => "login",
												"placeholder" => "Digite o login..."
											) ); ?>

										<?php echo form_password( array(
												"name" => "senha",
												"id" => "senha",
												"placeholder" => "**********"
											) ); ?>

									</div>
								</div>

								<div class='row'>
									<div class="col-md-12 center">

										<?php echo form_button( array(
												"content" => "Entrar",
												"type" => "submit",
												"class" => "btn-green",
											) ); ?>

									</div>
								</div>
								</div>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>

	</body>
</html>
