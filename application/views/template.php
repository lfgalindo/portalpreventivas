<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<html lang="pt-br">

	<head>

	    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	    <title><?php echo $title; ?></title>

	    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	    <link href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.css" rel="stylesheet">
	    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	    <link href="<?php echo base_url(); ?>assets/select2/css/select2.min.css" rel="stylesheet">
	    <link href="<?php echo base_url(); ?>assets/css/geral.css" rel="stylesheet">

	    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">

	    <script src="<?php echo base_url(); ?>assets/tether/js/tether.min.js"></script>
	    <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
    	<script src="<?php echo base_url(); ?>assets/mask/jquery_mask.js"></script>
	    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	    <script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>
	    <script src="<?php echo base_url(); ?>assets/select2/js/select2.min.js"></script>
	</head>

	<body>

		<div class="container-fluid" id="wrapper">

			<div class="row" id="row_pre_menu">
				<div class="col-md-8 col-md-offset-2" id="pre_menu">
					<div id="logo" class="nome_site">PORTAL DE PREVENTIVAS</div>
					<div id="menu">
						<?php echo $this->session->login; ?>
						<a href="<?php echo site_url('logout')?>" style="color:#fff; margin-left: 10px; font-size: 17px">
							<i class="fa fa-sign-out" aria-hidden="true"></i>
						</a>		
					</div>
				</div>
			</div>

			<div class="row" id="row_content_menu">
				<div class="col-md-8 col-md-offset-2" id="content_menu">
					<ul id="menu">
						<a href="<?php echo site_url('inicio'); ?>">
							<li><i class="fa fa-home" aria-hidden="true"></i>Início</li>
						</a>

						<?php if ( check_permission('visualizar_sites') ): ?>
							<a href="<?php echo site_url('sites'); ?>">
								<li><i class="fa fa-map-signs" aria-hidden="true"></i>Sites</li>
							</a>
						<?php endif; ?>

						<?php if ( check_permission('visualizar_preventivas') ): ?>
							<a href="<?php echo site_url('preventivas'); ?>">
								<li><i class="fa fa-file-text-o" aria-hidden="true"></i>Preventivas</li>
							</a>
						<?php endif; ?>

						<?php if ( check_permission('visualizar_usuarios') ): ?>
							<a href="<?php echo site_url('usuarios'); ?>">
								<li><i class="fa fa-user" aria-hidden="true"></i>Usuários</li>
							</a>
						<?php endif; ?>
						
						<?php if ( check_permission('visualizar_configuracoes') ): ?>
							<a href="<?php echo site_url('configuracoes'); ?>">
								<li><i class="fa fa-gear" aria-hidden="true"></i>Configurações</li>
							</a>
						<?php endif; ?>
					<ul>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8 col-md-offset-2" id="content_page">
					<?php echo $contents; ?>
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

			<div class="row footer">
				<h6>Desenvolvido por: Luiz Felipe - (14) 9 9850-7755</h6>
			</div>
		</div>
	</body>
</html>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
