
<?php

/**
 * Tela que exibirá a listagem de configurações
 *
 * @category Configuração
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<div class="row">
	<div class="col-md-12">
		<div class="area">
			<h1 class="title-area">Configurações do sistema</h1>

			<div class="botao_add">
				<div>
					<?php if( check_permission('alterar_configuracoes')): ?>
						<a href="<?php echo base_url('/configuracoes/editar'); ?>" >
							<button class="btn-green" data-toggle="tooltip" data-placement="bottom" title="Editar configurações">Editar</button>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<?php

				foreach ( $configuracoes as $config ) {

					echo '<div class="row cadastro" style="margin-top: 20px;">';
					echo '<div class="col-md-4">' . $config['apelido'] . ':</div>';
					echo '<div class="col-md-8">' . $config['valor'] . '</div>';
					echo '</div>';

				}

			?>
		</div>
	</div>
</div>