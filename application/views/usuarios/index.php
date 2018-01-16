
<?php

/**
 * Tela que exibirá a listagem de usuários
 *
 * @category Usuario
 * @author Luiz Felipe <lfgalindo@live.com>
 */

//check_permission('visualizar_modelos', '/painel')

?>

<?php /**echo form_open( "", array('method' => 'GET' ) ); // Formulário para os inputs de busca ?>

<div class="page-wrapper">

	<div class="container-fluid">
		<div class="row">

			<?php

				echo '<div class="col-md-3">';

				echo form_label('Buscar:', 'buscar');
				echo form_input( array(
					'name' => 'search',
					'id' => 'search',
					'placeholder' => 'Digite aqui a sua busca...',
					'value' => $search_string
					)
				);

				echo '</div>';

				echo '<div class="col-md-9">';

				echo form_label('Quantidade por página:', 'quantidade');
				echo form_dropdown('quantidade', qtd_pagina( $this->session->qtd_pagina ), $this->session->qtd_pagina );

				echo '<input type="submit" value="Filtrar">';

				echo '</div>';
			?>
		</div>
	</div>
</div>

<?php echo form_close(); */?>

<p><b>Total:</b> <?php //echo $total_registros; ?> registros.</p>

	<?php //if( check_permission('cadastrar_modelos')): ?>
		<a href="<?php echo base_url('/usuarios/cadastrar'); ?>">
			<button class="green">Novo usuário</button>
		</a>
	<?php //endif; ?>

<?php //echo $paginacao; ?>

	<table class="table listar">
		<thead>
			<tr>
				<th> Nome </th>
				<th> Matrícula </th>
				<th> Telefone </th>
				<?php //if( check_permission('editar_modelos') ): ?>
					<th> Ações </th>
				<?php //endif; ?>
			</tr>
		</thead>

		<tbody>
			<?php foreach ( $usuarios as $usuario ): ?>
				<tr>
					<td><?php echo $usuario['nome']; ?></td>
					<td><?php echo $usuario['matricula']; ?></td>
					<td><?php echo $usuario['telefone']; ?></td>

					<?php //if( check_permission('clonar_modelos') || check_permission('editar_modelos') || check_permission('excluir_modelos') ): ?>
						<td>
							<?php //if( check_permission('editar_modelos') ): ?>
								<a href="<?php echo base_url('/painel/modelos/editar'); ?>">
									<button class="editar btn-table" data-toggle="tooltip" title="Editar">
										<i class="fa fa-pencil" aria-hidden="true"></i>
									</button>
								</a>
							<?php //endif; ?>

							<?php //if( check_permission('excluir_modelos') ): ?>
								<a href="<?php echo base_url('/painel/modelos/remover'); ?>">
									<button class="excluir btn-table" data-toggle="tooltip" title="Excluir">
										<i class="fa fa-times" aria-hidden="true"></i>
									</button>
								</a>
							<?php //endif; ?>
						</td>
					<?php //endif; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

<?php //echo $paginacao; ?>