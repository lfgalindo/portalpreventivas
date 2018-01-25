
<?php

/**
 * Tela que exibirá a listagem de preventivas
 *
 * @category Preventiva
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<div class="row">
	<div class="col-md-12">
		<div class="area">

			<h1 class="title-area">Preventivas</h1>

			<div class="botao_add">
				<div>
					<?php if( check_permission('cadastrar_preventivas')): ?>
						<a href="<?php echo base_url('/preventivas/cadastrar'); ?>" >
							<button class="btn-green" data-toggle="tooltip" data-placement="bottom" title="Cadastrar uma preventiva">Nova preventiva</button>
						</a>
					<?php endif; ?>
				</div>

					<div class="container-search">
						<?php 

							echo form_open( "", array('method' => 'GET' ) );

							echo form_input( array(
												'name' => 'search',
												'id' => 'search',
												'class' => 'cadastro',
												'placeholder' => 'Digite aqui para buscar...',
												'value' => $search_string
												)
											);

							echo form_input( array(
												'type' => 'submit',
												'class' => 'btn-green',
												'style' => 'margin-left: 5px;',
												'value' => 'Buscar'
												)
											);

							echo form_close(); 
						?>
					</div>

			</div>

			<table class="table listar">
				<thead>
					<tr>
						<th> Site </th>
						<th> Programada </th>
						<th> Situação </th>
						<th> Ações </th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ( $preventivas as $preventiva ): ?>
						<tr>
							<td><?php echo $preventiva['id_site']; ?></td>
							<td><?php echo $preventiva['programada']; ?></td>
							<td><?php echo $preventiva['status']; ?></td>
							<td>
								<a href="<?php echo base_url('/preventivas/visualizar/') . encrypt( $preventiva['id'] ); ?>">
									<button class="visualizar btn-table" data-toggle="tooltip"  data-placement="bottom" title="Ver todos os dados">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</button>
								</a>

								<?php if( check_permission('editar_preventivas') ): ?>
									<a href="<?php echo base_url('/preventivas/editar/') . encrypt( $preventiva['id'] ); ?>">
										<button class="editar btn-table" data-toggle="tooltip"  data-placement="bottom" title="Alterar dados">
											<i class="fa fa-pencil" aria-hidden="true"></i>
										</button>
									</a>
								<?php endif; ?>

								<?php if( check_permission('remover_preventivas') ): ?>
									<a href="<?php echo base_url('/preventivas/remover/') . encrypt( $preventiva['id'] ); ?>">
										<button class="excluir btn-table" data-toggle="tooltip" data-placement="bottom" title="Remover preventiva">
											<i class="fa fa-times" aria-hidden="true"></i>
										</button>
									</a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<div class="pagination">
				<?php echo $paginacao; ?>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	
	$(document).on('click', '.excluir' , function( e ){

			e.preventDefault();

			var link = $(this).parent().attr('href');

			swal({
			  title: 'Atenção!',
			  text: 'Deseja realmente remover essa preventiva?',
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#9fd037',
			  cancelButtonColor: '#e65858',
			  cancelButtonText: "Cancelar",
			  confirmButtonText: 'Sim',
	  		  reverseButtons: true
			}).then((result) => {
	 
			  if (result) {

			    window.location.href = link;

			  }

			});
		});

</script>