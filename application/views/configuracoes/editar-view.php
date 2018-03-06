
<?php

/**
 * Tela que exibirá o formulário para edição de configurações
 *
 * @category Configuração
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<?php echo form_open( null, array("id" => "form_cadastro") ); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="area">

				<h1 class="title-area">Editar configurações</h1>

				<?php

					foreach ( $configuracoes as $config ) {

						echo '<div class="row cadastro" style="margin-top: 20px;">';
						echo '<div class="col-md-4">' . $config['apelido'] . ':</div>';

						echo '<div class="col-md-8">'; 

						if ( $config['nome'] == 'qtd_pagina' ){

							echo form_input( array( 
											'type'  => 'text', 
											'name'  => $config['nome'],
											'value' => $config['valor']
								));

						}
						else if ( $config['nome'] == 'ext_permitidas' ) {

							echo $config['valor'];

						}
						else if ( $config['nome'] == 'tamanho_arquivos' ) {

							echo form_input( array( 
											'type'  => 'text', 
											'name'  => $config['nome'],
											'value' => $config['valor']
								));

							echo ' Kb';

						}

						echo '</div>';

						echo '</div>';

					}

				?>
				
				<input type="submit" class="btn-green" id="alterar" value="Salvar" data-toggle="tooltip" data-placement="bottom" title="Salvar alterações" />
			</div>
		</div>
	</div>

<?php echo form_close(); ?>

<script type="text/javascript">

</script>