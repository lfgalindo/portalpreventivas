
<?php

/**
 * Tela que exibirá o formulário para edição de configurações
 *
 * @category Configuração
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<?php echo form_open(); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="area">

				<h1 class="title-area">Editar configurações</h1>

				<?php

					foreach ( $configuracoes as $config ) {

						echo '<div class="row cadastro" style="margin-top: 20px;">';
						echo '<div class="col-md-4">' . $config['apelido'] . ':</div>';

						echo '<div class="col-md-4">'; 

						if ( $config['nome'] == 'qtd_pagina' ){

							echo form_input( array( 
											'type'  => 'text', 
											'name'  => $config['nome'],
											'value' => $config['valor'],
											'class' => 'cadastro'
								));

						}
						else if ( $config['nome'] == 'ext_permitidas' ) {

							$mimes = & get_mimes();

							$all_ext = array();

							foreach ( $mimes as $ext => $mime )
								$all_ext[$ext] = '.' . $ext;

							$selected = unserialize( $config['valor'] );

							echo form_dropdown('ext_permitidas', $all_ext, $selected , array( 'class' => 'ext_permitidas js-states form-control cadastro', 'multiple' => 'multiple' ) );


						}
						else if ( $config['nome'] == 'tamanho_arquivos' ) {

							echo form_input( array( 
											'type'  => 'text', 
											'name'  => $config['nome'],
											'value' => $config['valor'],
											'class' => 'cadastro'
								));
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

	$(".ext_permitidas").select2();

</script>