
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

<div class="row">
	<div class="col-md-12">
		<div class="area">

			<h1 class="title-area">Usuários</h1>

			<div class="botao_add">
				<?php //if( check_permission('cadastrar_modelos')): ?>
					<a href="<?php echo base_url('/usuarios/cadastrar'); ?>">
						<button class="btn-green" data-toggle="tooltip" data-placement="bottom" title="Cadastrar um usuário">Novo usuário</button>
					</a>
				<?php //endif; ?>
			</div>

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
											<button class="editar btn-table" data-toggle="tooltip"  data-placement="bottom" title="Editar">
												<i class="fa fa-pencil" aria-hidden="true"></i>
											</button>
										</a>
									<?php //endif; ?>

									<?php //if( check_permission('excluir_modelos') ): ?>
										<a href="<?php echo base_url('/painel/modelos/remover'); ?>">
											<button class="excluir btn-table" data-toggle="tooltip" data-placement="bottom" title="Excluir">
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
		</div>
<?php //echo $paginacao; ?>
	</div>
</div>