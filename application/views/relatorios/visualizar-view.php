
<?php

/**
 * Tela que exibirá os dados do arquivo enviado
 *
 * @category Visualizar
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<div class="row">
	<div class="col-md-12">
		<div class="area">

			<h1 class="title-area">Visualizar dados relatório</h1>

			<div class="row cadastro" style="margin-top: 20px;">
				<div class="col-md-3">Nome:</div>
				<div class="col-md-9"><?php echo $arquivo->getNome(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Nome:</div>
				<div class="col-md-9"><?php echo $arquivo->getNome(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Tamanho:</div>
				<div class="col-md-9"><?php echo number_format( $arquivo->getTamanho(), 2, ',', '.') . "Kb"; ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Data de envio:</div>
				<div class="col-md-9"><?php echo date( "d/m/Y - H:i:s", strtotime( $arquivo->getDataEnvio() ) ); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Enviado por:</div>
				<div class="col-md-9"><?php echo $arquivo->getIDUsuario(); ?></div>
			</div>

			<?php 

				$situacao = "Em aprovação";

				if ( $arquivo->getAprovado() == "1" ){

					$situacao = "Aprovado em " . date( "d/m/Y - H:i:s", strtotime( $arquivo->getDataRecusadoAprovado() ) );

					echo '<div class="row cadastro">';
					echo '<div class="col-md-3">Aprovado por:</div>';
					echo '<div class="col-md-9">' . $arquivo->getIDUsuarioRecusadoAprovado() . '</div>';
					echo '</div>';
				}

				if ( $arquivo->getRecusado() == "1" ){

					$situacao = "Recusado em " . date( "d/m/Y - H:i:s", strtotime( $arquivo->getDataRecusadoAprovado() ) );

					echo '<div class="row cadastro">';
					echo '<div class="col-md-3">Motivo:</div>';
					echo '<div class="col-md-9">' . $arquivo->getMotivoRecusado() . '</div>';
					echo '</div>';

					echo '<div class="row cadastro">';
					echo '<div class="col-md-3">Recusado por:</div>';
					echo '<div class="col-md-9">' . $arquivo->getIDUsuarioRecusadoAprovado() . '</div>';
					echo '</div>';


				}

			?>	
		</div>
	</div>
</div>