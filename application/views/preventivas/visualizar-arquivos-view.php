
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

			<h1 class="title-area">Visualizar dados do relatório</h1>

			<div class="row cadastro" style="margin-top: 20px;">
				<div class="col-md-3">Nome:</div>
				<div class="col-md-9"><?php echo $arquivo->getNome(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Tamanho:</div>
				<div class="col-md-9"><?php echo number_format( $arquivo->getTamanho(), 2, ',', '.') . " Kb"; ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Data de envio:</div>
				<div class="col-md-9"><?php echo date( "d/m/Y - H:i:s", strtotime( $arquivo->getDataEnvio() ) ); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Enviado por:</div>
				<div class="col-md-9"><?php echo $usuario_enviou->getNome(); ?></div>
			</div>

			<?php 

				$html = "";

				$situacao = "Em aprovação";

				if ( $arquivo->getAprovado() == "1" ){

					$situacao = "Aprovado em " . date( "d/m/Y - H:i:s", strtotime( $arquivo->getDataRecusadoAprovado() ) );

					$html .= '<div class="row cadastro">';
					$html .= '<div class="col-md-3">Aprovado por:</div>';
					$html .= '<div class="col-md-9">' . $usuario_aprovou->getNome() . '</div>';
					$html .= '</div>';
				}

				if ( $arquivo->getRecusado() == "1" ){


					$situacao = "Recusado em " . date( "d/m/Y - H:i:s", strtotime( $arquivo->getDataRecusadoAprovado() ) );

					$html .= '<div class="row cadastro">';
					$html .= '<div class="col-md-3">Motivo:</div>';
					$html .= '<div class="col-md-9">' . $arquivo->getMotivoRecusado() . '</div>';
					$html .= '</div>';

					$html .= '<div class="row cadastro">';
					$html .= '<div class="col-md-3">Recusado por:</div>';
					$html .= '<div class="col-md-9">' . $usuario_aprovou->getNome() . '</div>';
					$html .= '</div>';

				}
			?>	

			<div class="row cadastro">
				<div class="col-md-3">Situação:</div>
				<div class="col-md-9"><?php echo $situacao; ?></div>
			</div>

			<?php echo $html; ?>

			<div class="botao_add">
				<div>
					<a href="<?php echo base_url('arquivos/preventivas/' . $id_preventiva ); ?>" >
						<button class="btn-green" data-toggle="tooltip" data-placement="bottom" title="Voltar">Voltar</button>
					</a>	
				</div>
			</div>	

		</div>
	</div>
</div>
