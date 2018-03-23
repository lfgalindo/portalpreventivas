
<?php

/**
 * Tela que exibirá a listagem de sites
 *
 * @category Site
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<div class="row">
	<div class="col-md-12">
		<div class="area">

			<h1 class="title-area">Sites</h1>

			<div class="botao_add">
				<div>
					<?php if( check_permission('cadastrar_sites')): ?>
						<a href="<?php echo base_url('/sites/cadastrar'); ?>" >
							<button class="btn-green" data-toggle="tooltip" data-placement="bottom" title="Cadastrar um site">Novo site</button>
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

			<div class="table-responsive">
				<table class="table listar">
					<thead>
						<tr>
							<th> NE ID </th>
							<th> END ID </th>
							<th> Tipo </th>
							<th> Cidade </th>
							<th> Ações </th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ( $sites as $site ): ?>
							<tr>
								<td><?php echo $site['ne_id']; ?></td>
								<td><?php echo $site['end_id']; ?></td>
								<td><?php echo $site['tipo_ne']; ?></td>
								<td><?php echo $site['cidade'] . '/' . $site['estado']; ?></td>
								<td>
									<a href="<?php echo base_url('/sites/visualizar/') . encrypt( $site['id'] ); ?>">
										<button class="visualizar btn-table" data-toggle="tooltip"  data-placement="bottom" title="Ver todos os dados">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</button>
									</a>

									<?php if( check_permission('editar_sites') ): ?>
										<a href="<?php echo base_url('/sites/editar/') . encrypt( $site['id'] ); ?>">
											<button class="editar btn-table" data-toggle="tooltip"  data-placement="bottom" title="Alterar dados">
												<i class="fa fa-pencil" aria-hidden="true"></i>
											</button>
										</a>
									<?php endif; ?>

									<?php if( check_permission('remover_sites') ): ?>
										<a href="<?php echo base_url('/sites/remover/') . encrypt( $site['id'] ); ?>">
											<button class="excluir btn-table" data-toggle="tooltip" data-placement="bottom" title="Remover site">
												<i class="fa fa-times" aria-hidden="true"></i>
											</button>
										</a>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			
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
			  text: 'Deseja realmente remover esse site?',
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