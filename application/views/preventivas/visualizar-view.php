
<?php

/**
 * Tela que exibirá os dados de preventivas
 *
 * @category Visualizar
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<div class="row">
	<div class="col-md-12">
		<div class="area">

			<h1 class="title-area">Visualizar dados da preventiva</h1>

			<div class="botao_add">
				<div>
					<?php if( check_permission('editar_preventivas') && $preventiva->getStatus() == "1"): ?>
						<a href="<?php echo base_url('/preventivas/editar/') . encrypt( $preventiva->getID() ); ?>" >
							<button class="btn-green" data-toggle="tooltip" data-placement="bottom" title="Editar essa preventiva">Editar dados</button>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="row cadastro" style="margin-top: 20px;">
				<div class="col-md-3">Segmento:</div>
				<div class="col-md-9"><?php echo tipos_preventivas($preventiva->getTipo()); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Site:</div>
				<div class="col-md-9"><?php echo $site->getNeID(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Tipo TOP:</div>
				<div class="col-md-9"><?php echo $site->getTipoTop(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">End ID:</div>
				<div class="col-md-9"><?php echo $site->getEndId(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Cidade:</div>
				<div class="col-md-9"><?php echo $site->getCidade() . "/" . $site->getEstado(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Programada:</div>
				<div class="col-md-9">
					<?php 
						setlocale(LC_TIME, 'pt_BR.utf-8', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese.utf-8');
									
						echo $preventiva->getProgramada() != "0000-00-00" ? strftime('%B/%Y', strtotime( $preventiva->getProgramada() ) ) : ""; 

					?>
				</div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Executada:</div>
				<div class="col-md-9"><?php echo $preventiva->getExecutada() == null ? "<span class='text_info'>Não executada até o momento</span>" : date('d/m/Y', strtotime( $preventiva->getExecutada() ) ); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Último relatório:</div>
				<div class="col-md-9"><?php echo $preventiva->getRelatorio()== null ? "<span class='text_info'>Nenhum relatório enviado até o momento</span>" : date('d/m/Y', strtotime( $preventiva->getRelatorio() ) ); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Status:</div>
				<div class="col-md-9"><b><?php echo situacoes_preventivas( $preventiva->getStatus() ); ?></b></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Técnico responsável:</div>
				<div class="col-md-9"><?php echo $tecnico->getNome(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Supervisor:</div>
				<div class="col-md-9"><?php echo $supervisor->getNome(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Cadastrada em:</div>
				<div class="col-md-9"><?php echo date('d/m/Y \à\s H:i:s', strtotime( $preventiva->getDataCadastro() ) ); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Cadastrada por:</div>
				<div class="col-md-9"><?php echo $usuario->getNome(); ?></div>
			</div>

		</div>
	</div>
</div>